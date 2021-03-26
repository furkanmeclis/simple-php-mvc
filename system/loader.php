<?php

    function load($dir){
        $helperDir = __DIR__ ."/".$dir;
        if ($dh = opendir($helperDir)) {
            while ($file = readdir($dh)) {
                if (is_file($helperDir.'/'.$file)) {
                    require $helperDir.'/'.$file;
                }
            }
        }	
    }
    require realpath(".")."/system/advanced/404/404.php";
    load("advanced");
    new ErrorHandler();
    load("class");
    load('router');
    $_route = new Router();
    
    
    $_route->add("tunahan/{all}","welcome@index","get");
    $_route->run();
   
  