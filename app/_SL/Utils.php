<?php

namespace App\_SL;

use Illuminate\Support\Str;

class Utils {
    public static function  getModelByTablename($tableName) {
        $folderName = 'App\\Models';
        $name =  $folderName . '\\' . Str::studly(strtolower(STR::singular($tableName)));

        $clearStr = str_replace('"', "", $name);
        $_class = new $clearStr();
        return $_class;
    }
}
