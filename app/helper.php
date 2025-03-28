<?php


use Illuminate\Support\Facades\DB;


if(!function_exists('format_date')){
    function format_date($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date);
    }
}
if(!function_exists('format_datetime')){
    function format_datetime($datetime){
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('d/M/Y H:i:s');
    }
}

if (!function_exists('get_option')) {
    function get_option($name, $default = null)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('name', $name)->get();
            if (!$setting->isEmpty()) {
                return $setting[0]->value;
            }
		}
		
        return $default;
    }
}