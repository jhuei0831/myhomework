<?php

namespace App\Http\Controllers;

use App\Config;
use App\Log;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        return view('manage.config.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $config = Config::where('id',$id)->first();
        return view(('manage.config.edit'),compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $config = Config::where('id',$id)->first();

        $data = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'font_family' => ['required', 'string', 'max:255'],
            'font_size' => ['required', 'string', 'max:255'],
            'font_weight' => ['required', 'string', 'max:255'],
            'background_color' => ['nullable','string', 'max:255'],
            'background' => ['image','mimes:jpeg,png,jpg,gif', 'max:2048'],
            'navbar_bcolor' => ['string', 'max:255'],
            'navbar_wcolor' => ['string', 'max:255'],
            'navbar_size' => ['string', 'max:255'],
            'background' => ['nullable'],
            'is_open' => ['required'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->has('background')) {
                // Get image file
                $image = $request->file('background');
                // Make a image name based on user name and current timestamp
                $name = 'background';
                // Define folder path
                $folder = '/uploads/images/';
                // Make a file path where image will be stored [ folder path + file name + file extension]
                // $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                $filePath = $name. '.' . $image->getClientOriginalExtension();
                // Upload image
                $this->uploadOne($image, $folder, 'public', $name);
                // Set user profile image path in database to filePath
                $config->background = $filePath;
            }
            else {
                $config->$key = strip_tags(clean($data[$key]));
            }
        }

        // 寫入log
        Log::write_log('configs',$config);
        $config->save();
        return back()->with('success','修改網站成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }

    public function delete_background($id)
    {
        $config = DB::table('configs')->where('id',$id)->first();

        $this->deleteOne('/uploads/images/', 'public', $config->background);
        // 寫入log
        Log::write_log('configs',$config->background,'刪除背景');

        DB::table('configs')->where('id',$id)->update(['background'=>NULL]);

        return back()->with('success','刪除背景圖案成功 !');
    }
}
