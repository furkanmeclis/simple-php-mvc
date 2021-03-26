<?php

class Input
{
    public function post($name,$clean=false)
    {
        if(isset($_POST[$name])){
        if ($clean) {
            
            return strip_tags(trim($_POST[$name]));
            
        }else{
            return $_POST[$name];
        }
    }else{
        $rt = new Hata();
        echo $rt->popup_error('Böyle Bir Değer Bulunamadı <b>$_POST["'.$name.'"]</b>');
        
    }
    }
    public function get($name,$clean=false)
    {
        if(isset($_GET[$name])){
        if ($clean) {
            return strip_tags(trim($_GET[$name]));
        }else{
            return $_GET[$name];
        }
    }else{
        $rt = new Hata();
        echo $rt->popup_error('Böyle Bir Değer Bulunamadı <b>$_GET["'.$name.'"]</b>');
        
    }
    }
}
