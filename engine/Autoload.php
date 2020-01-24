<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className) {

        $fileName = str_replace("\\", "/", $className);
        $fileName = str_replace("app", "", $fileName);
        $fileName = "..{$fileName}.php";

        if (file_exists($fileName)) {
            include $fileName;
        }

    }
}