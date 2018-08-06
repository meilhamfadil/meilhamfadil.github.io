<?php

if(!function_exists("assets_url")){

    function assets_url($url){
        $CI = & get_instance();
        $base = $CI->config->item("assets");
        return base_url($base . "/" . $url);
    }

}

if(!function_exists("file_url")){

    function file_url(){
        $CI = & get_instance();
        $base = $CI->config->item("file");
        return base_url($base . "/" . $url);
    }

}