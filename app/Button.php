<?php

namespace App;
use URL;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    	public static function Detail($id)
		{
			$url = URL::full();
			echo "<button type=\"submit\" class='btn btn-sm btn-secondary'>";
			echo 	"<i class='fas fa-info-circle'></i>&nbsp;".trans('action.detail');
			echo "</a>";
		}

		public static function Deleting($id)
		{
			// $url = URL::full();
			echo "<button type='submit' class='btn btn-sm btn-danger btn-delete dropdown-item'>";
			echo 	"<i class='fas fa-trash-alt'></i>&nbsp;".trans('action.delete');
			echo "</button>";
		}

		public static function Edit($id)
		{
			echo "<button type=\"submit\" class='btn btn-sm btn-success dropdown-item' formtarget='_blank'>";
			echo "<i class='fas fa-pencil-alt'></i>&nbsp;" . trans('action.edit');
			echo "</button>";
		}

		public static function Create()
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-primary' href='{$url}/create'>";
			echo 	"<i class='fas fa-plus'></i>&nbsp;".trans('action.create');
			echo "</a>";
		}

        public static function Import()
        {
            $url = URL::full();
            echo "<a class='btn btn-sm btn-primary' href='{$url}/import'>";
            echo    "<i class='fas fa-plus'></i>&nbsp;".trans('action.import');
            echo "</a>";
        }

		public static function Reset()
		{
			echo "<p class='text-right'>";
			echo	"<a class='btn btn-sm btn-reset btn-danger' href='reset.php'>";
			echo		"<i class='fas fa-undo-alt'></i>&nbsp;".trans('action.reset');
			echo 	"</a>";
			echo "</p>";
		}

		public static function To($url=false,$to, $txt, $query="", $class="btn-secondary", $fas="list-ol", $confirm=false)
		{
			$url = $url?URL::full():'';
			if ($confirm == true) {
				$confirm = 'onclick="return confirm(\'確認刪除?\')"';
			}
			if ($url) {
				echo "<a class='btn btn-sm {$class}' href='{$url}/{$to}/{$query}' {$confirm}>";
			}
			else{
				echo "<a class='btn btn-sm {$class}' href='{$to}/{$query}' {$confirm}>";
			}
			echo 	"<i class='fas fa-{$fas}'></i>&nbsp;{$txt}";
			echo "</a>";
		}

		public static function GoBack($url = "#")
		{
			$current_url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			$target_url = ($url) ? $url: URL::previous();

			echo "<a class='btn btn-sm btn-warning' href='{$target_url}'>";
			echo 	"<i class='fas fa-arrow-left'></i> ".trans('action.previous');
			echo "</a>";
		}
}
