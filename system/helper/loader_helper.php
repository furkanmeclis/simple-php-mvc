<?php

function get_image($name,$op=false,$class=null)
{
    $r = base_url()."assets/images/$name";
    $t = realpath(".")."/assets/images/$name";
    if ($op) {
        if (file_exists($t)) {         
            
                return "<img src='$r' class='$class'>";
            
        }else{
            $tr = new Hata();
            echo $tr->popup_error("Resim Bulunamadı<br>Dosya Yolu : <b>$t</b>");
        }
    }else{
        return $r;
    }

}
function get_js($name,$op=false)
{
    $r = base_url()."assets/js/$name";
    $t = realpath(".")."/assets/js/$name";
    if ($op) {
        if (file_exists($t)) {         
            
                return "<script src='$r'></script>";
            
        }else{
            $tr = new Hata();
            echo $tr->popup_error("Javascript Dosyası Bulunamadı<br>Dosya Yolu : <b>$t</b>");
        }
    }else{
        return $r;
    }

}
function get_css($name,$op=false)
{
    $r = base_url()."assets/css/$name";
    $t = realpath(".")."/assets/css/$name";
    if ($op) {
        if (file_exists($t)) {         
            
                return "<link rel='stylesheet' href='$r'>";
            
        }else{
            $tr = new Hata();
            echo $tr->popup_error("Css Dosyası Bulunamadı<br>Dosya Yolu : <b>$r</b>");
        }
    }else{
        return $r;
    }

}