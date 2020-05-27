<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;
class Log extends Model
{
	protected $table = 'logs';

    protected $primaryKey = 'id';

    protected $fillable = [
        "user", "ip", "os", "browser", "browser_detail", "action", "table", "data",
    ];

    public static function get_agent()
    {
    	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$browser_name = 'Unknown';
		$platform = 'Unknown';
		$version = $ub = "";

		//First get the platform?
		if (preg_match('/linux/i', $user_agent)) 
		{
			$platform = 'linux';
		}
		else if(preg_match('/macintosh|mac os x/i', $user_agent)) 
		{
			$platform = 'mac';
		}
		else if(preg_match('/windows|win32/i', $user_agent)) 
		{
			$platform = 'windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if((preg_match('/MSIE/i',$user_agent) || preg_match('/Trident\/7.0; rv:11.0/i',$user_agent)) && !preg_match('/Opera/i',$user_agent))
		{
			$browser_name = 'Internet Explorer';
			$ub = "MSIE";
		}
		else if(preg_match('/Firefox/i',$user_agent))
		{
			$browser_name = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		else if(preg_match('/Chrome/i',$user_agent))
		{
			$browser_name = 'Google Chrome';
			$ub = "Chrome";
		}
		else if(preg_match('/Safari/i',$user_agent))
		{
			$browser_name = 'Apple Safari';
			$ub = "Safari";
		}
		else if(preg_match('/Opera/i',$user_agent))
		{
			$browser_name = 'Opera';
			$ub = "Opera";
		}
		else if(preg_match('/Netscape/i',$user_agent))
		{
			$browser_name = 'Netscape';
			$ub = "Netscape";
		}

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $user_agent, $matches)) 
		{
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) 
		{
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($user_agent,"Version") < strripos($user_agent,$ub))
			{
				$version = $matches['version'][0];
			}
			else 
			{
				$version = isset($matches['version'][1]) ? $matches['version'][1] : '';
			}
		}
		else 
		{
			$version = $matches['version'][0];
		}

		// check if we have a number
		if ($version == null || $version == "")
		{
			$version = "Unknown";
		}

		return array(
			'name'		=> $browser_name,
			'version'	=> $version,
			'platform'	=> $platform,
			'detail'	=> $user_agent
		);
    }

    public static function write_log($table,$data,$action = NULL)
    {

    	$agent = Log::get_agent();

    	DB::table('logs')->insert([

    		'user' => (Auth::user()->first())['name'],
    		'ip'   => Request::ip(),
    		'os'   => $agent['platform'],	
    		'browser'   => $agent['name'],	
    		'browser_detail'   => $agent['detail'],	
    		'action'   => $action ?? Request::method(),	
    		'table'   => $table,	
    		'data'   => json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
    		'created_at'   => now()

    	]);

    	return true;
    }
}
