<?php

namespace App\_SL;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Utils {

    public static function getModelByTableName($tableName) {
        $folderName = 'App\\Models';
        $name =  $folderName . '\\' . Str::studly(strtolower(STR::singular($tableName)));

        $clearStr = str_replace('"', "", $name);
        $_class = new $clearStr();
        return $_class;
    }

    public static function isAvaibleLang($lang): bool
    {
        $locales = array_flip(config('app.locales'));
        foreach ($locales as $local) {
            if($lang == $local) {
                return true;
            }
        }
        return false;
    }

    public static function setLang($lang = null): string {
        if($lang == null) {
            $langPrefer = \request()->getPreferredLanguage(array_flip(config('app.locales')));
        }
        else {
            // check if request lang is correct and avaible
            if (!Utils::isAvaibleLang($lang)) {
                $langPrefer = \request()->getPreferredLanguage(array_flip(config('app.locales')));
            }
            else {
                $langPrefer = $lang;
            }
        }

        Session::put('lang', $langPrefer);
        \App::setLocale($langPrefer);
        return $langPrefer;
    }
}
