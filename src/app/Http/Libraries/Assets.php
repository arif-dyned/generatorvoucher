<?php 

namespace App\Http\Libraries;

class Assets {
	public static function load($type, $assets)
	{
		$data = [];
		if ($type == "css") {
			$css_assets = \Config::get('assets.css');
			foreach ($assets as $key => $value) {
				$data[] = $css_assets[$value];	
			}
		} else {
			$js_assets = \Config::get('assets.js');
			foreach ($assets as $key => $value) {
				$data[] = $js_assets[$value];	
			}
		}

		return $data;
	}

	public static function add($data, $type, $assets){
		$data = $data;
		if ($type == "css") {
			$css_assets = \Config::get('assets.css');
			foreach ($assets as $key => $value) {
				$data[] = $css_assets[$value];	
			}
		} else {
			$js_assets = \Config::get('assets.js');
			foreach ($assets as $key => $value) {
				$data[] = $js_assets[$value];	
			}
		}
		
		return $data;
	}
}