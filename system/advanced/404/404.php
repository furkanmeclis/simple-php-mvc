<?php
class Hata
{
    public function hata_error($error_code,$error_head,$error_message)
    {
        require realpath(".")."/system/advanced/404/404_folder/index.php";
    }
    public function popup_error($error_message)
    {
        return '<div style="padding: 20px;background-color: #aaa;margin-bottom: 15px;font-family:system-ui;font-size:14px">
        
        '.$error_message.'
      </div>';
    }
}
