<?php

use App\Models\WebsiteSetting;

function website_setting($type){
    $setting = WebsiteSetting::first();
    if(!$setting){
        return 'Website setting is required';
    }
    return $setting->$type;
}
