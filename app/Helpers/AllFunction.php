<?php

    function base_url($url='')
    {
        return env('URL_SLUG','').$url;
    }

    function static_url($url=null)
    {
        if(request()->server('SERVER_NAME') == '127.0.0.1'){
            $static_url = "";
        }else{
            $static_url = "";
        }
        $static_url .= $url;
        return url($static_url);
    }