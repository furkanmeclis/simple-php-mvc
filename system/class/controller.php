<?php
if (defined("DATABASE")) {
    require realpath(".")."/system/library/database.php";
}
if (defined("SESSION")) {
    require realpath(".")."/system/library/session.php";
}
if (defined("EMAIL")) {
    require realpath(".")."/system/library/email.php";
}
if (defined("COOKIE")) {
    require realpath(".")."/system/library/cookie.php";
}

if (defined("CSRF")) {
    require realpath(".")."/system/library/csrf.php";
}
if (defined("FILE_UPLOADER")) {
    require realpath(".")."/system/library/file.php";
}
if (defined("VALIDATOR")) {
    require realpath(".")."/system/library/validation.php";
}

require realpath(".")."/system/library/input.php";
class Loader 
{
    
    public function view($name, $data = [])
    {

        $f = realpath(".") . '/app/view/' . strtolower($name) . '.php';
        if (file_exists($f)) {
        extract($data);
        require $f;
        }else {
            $rt = new Hata();
            
            echo $rt->popup_error("Dosya Bulunamadı<br>Dosya Yolu : <b>$f</b>");
        }
    }
    public function model($name){
        $f = realpath(".")."/app/model/".strtolower($name).".php";
        if (file_exists($f)) {
            require $f;
            $n = ucfirst($name);
            return new $n();
        }else {
            $rt = new Hata();
            
            echo $rt->popup_error("Dosya Bulunamadı<br>Dosya Yolu : <b>$f</b>");
            
            
        }
       
    }
    public function helper($name)
    {
        $f = realpath(".")."/system/helper/".strtolower($name)."_helper.php";
        $b = realpath(".")."/app/helper/".strtolower($name)."_helper.php";
        if (file_exists($f)) {
            require $f;
        }elseif(file_exists($b)){
            require $b;
        }else {
            $rt = new Hata();
            
            echo $rt->popup_error("Dosya Bulunamadı<br>Dosya Yolu : <b>$b</b>");
            
            
        }
    }
    
    

}
 

class Controller {
    public $load;
    public $db;
    public $session;
    public $email;
    public $cookie;
    public $csrf;
    public $file;
    public $validation;
    public $input;
    
    public $uri;

    public function __construct(){
        if (defined("DATABASE")) {
            $this->db = new Database(HOSTNAME,DBNAME,USERNAME,PASSWORD,CHARSET);
        }else{
            $rt = new Hata();
            
            $this->db = $rt->popup_error("Database Sınıfı Tanımlı Değil");
        }

        if (defined("VALIDATOR")) {
            $this->validation = new ValidFluent($_POST);
        }else{
            $rt = new Hata();
            
            $this->validation = $rt->popup_error("Validation Sınıfı Tanımlı Değil");
        }

        if (defined("SESSION")) {
           
            $this->session = new Session();
        }else{
            $rt = new Hata();
            
            $this->session = $rt->popup_error("Session Sınıfı Tanımlı Değil");
        }
        
        if (defined("EMAIL")) {
           
            $this->email = new Email(EMAIL_HOST,EMAIL_PORT,EMAIL_SECURE,EMAIL_USER,EMAIL_PASS);
        }else{
            $rt = new Hata();
            
            $this->email =  $rt->popup_error("Email Sınıfı Tanımlı Değil");
        }

        if (defined("FILE_UPLOADER")) {
           
           $this->file = new FileUploader();
        }else{
            $rt = new Hata();
            
            $this->file =  $rt->popup_error("Dosya Yükleme Sınıfı Tanımlı Değil");
        }

        if (defined("CSRF")) {
           
            $this->csrf = new CSRF(true);
        }else{
            $rt = new Hata();
            
            $this->csrf = $rt->popup_error("CSRF Sınıfı Tanımlı Değil");
        }
       

        if (defined("COOKIE")) {
           
            $this->cookie = new Cookie();
        }else{
            $rt = new Hata();
            
            $this->cookie = $rt->popup_error("Cookie Sınıfı Tanımlı Değil");
        }
        
        $this->input = new Input();
        $this->load = new Loader();
        $this->uri = new UriClass();
    }
     
}
class UriClass{
    public function segment($number)
    {
        if(is_int($number)){
            $url = $_GET["uri"];
            $url = explode("/",$url);
            $number = ($number == 0) ? 1 : $number;
            $number = ($number - 1);
            $sonuc = isset($url[$number]) ? $url[$number] : "null";
            return $sonuc;
        }else{
            $rt = new Hata();
            echo $rt->popup_error("Sadece Sayı Girebilirsiniz");
        }
    }
}