# Simple Php MVC

Php projelerinizde kullanabileceğiniz kullanımı basit bir yapı.
## Ayarlar
/app/config/ Dizinindeki Dosyalara Gözatalım <br>
- **Config.php**<br>
    - Base Url 
    Sitenizde Yönlendirmelerde,Dosya Çağırmada vs. Kolaylık Sağlayan **Base_url**'i Ayarlamak İçin Config Dosyasında Alttaki Seçeneği Düzenleyin
    ```php
    $config["base_url"] = "https://domain.com/";
    ``` 
    - Otamatik Helper Yükleyici Buraya Sitenizin Bütün Her Yerinde Kullandığınız Helper Dosyalarını Ekleyebilirsiniz Bu Sayede Fazla Koddan Kurtulmuş Oluyorsunuz.
    Otomatik Yüklenmesiniz İstediğiniz PHP Dosyalarını /app/helper/ Dizinine Ekleyin.**Dikkat !** Dosya İsmi **example_helper.php** Biçiminde Olmalıdır Ve Otomatik Yüklenirken Sadece **example**
    Şeklinde Eklenmelidir Aksi Halde Dosya Yüklenmez.
    Mevcut Helperler<br>
         - Loader Helper Yüklemek İçin **loader**
         - String Helper Yüklemek İçin **string**
         - Text Helper Yüklemek İçin **text**
         
    ```php
    $autoload["helpers"] = array("example");
    ```
    - Kütüphaneler
      Yüklenmesini İstediğiniz Kütüphaneleri Ekleyebilirsiniz<br>
      Mevcut Kütüphaneler<br>
         - Database Yüklemek İçin **database**
         - Session Yüklemek İçin **session**
         - Email Yüklemek İçin **email**
         - Cookie Yüklemek İçin **cookie**
         - CSRF Yüklemek İçin **csrf**
         - File Uploader Yüklemek İçin **file**
         - Form Validation Yüklemek İçin **validation**
         - Zip Yüklemek İçin **zip**

   ```php
   $autoload["libraries"] = array();
   ```
- **database.php**<br>
    Veri Tabanı Ayarlarınızı Ekleyin
    ```php
    <?php

    $database = array(
        "database_host" => "localhost",
        "database_name" => "users",
        "database_user" => "johndoe",
        "user_password" => "123456",
        "charset"       => "utf8mb4"
    );
    ```
- **email.php**<br>
      SMTP Ayarlarınızı Ekleyin
    ```php
    <?php

    $email = array(
        "smtp_host"   => "smtp.gmail.com",
        "smtp_port"   => "587",
        "smtp_secure" => "tls",
        "smtp_user"   => example@gmail.com",
        "smtp_pass"   => "12345678",
    );
    ```
- **routes.php**<br>
    Özel Yönlendirmelerinizi Ekleyin Ayrıntılı Bilgi İçin Router(Yönlendirici) Adlı Başlığı İnceleyin
## Url Yapısı
   domain.com/controller_name/method_name/parameter_1/parameter_2/parameter_3/...
Özel Yönlendirmeler İçin Router(Yönlendirici) Adlı Başlığı İnceleyin

## Router(Yönlendirici)
**/app/config/** Dizini Altında Bulunan **routes.php** Dosyasında Yönlendirmelerimizi Tanımlıyoruz<br>
```php
<?php

$router->add("/users/{id}","user@ekle","GET|POST");
```
**$router->add()** Adlı Fonksiyona 3 Tane Parametre Gönderiyoruz
- Url =
    Parametre Almak İçin ***{all},{number}*** Şeklinde Ekleme Yapabilirsiniz
- Callback = **controller@method** Biçiminde Url Eşleştiğinde Çalışmasını İstediğiniz Controllerı Ekleyebilirsiniz
- Request_Method = Hangi Methodlarda İşlem Çalışmasını İstiyorsanız O Methodları **GET|POST** Şeklinde Ekleyin

## Controller

Controller Dosyası Oluşturmak İçin Ana Dizinde Bulunan **app/controller/** dizinini açıp bir php dosyası oluşturun.<br>
example.php 
```php
<?php

class Example extends Controller
{
    public function index()
    {
    // App/view/ Dizini Altında Bir php dosyası Çağırdık
     $this->load->view("welcome");
    }
   
}
```
Helper Yüklemek İçin<br>
```php
$this->load->helper("helpername");  // app/helper/helpername_helper.php
```
Model Yüklemek İçin
```php
$model = $this->load->model("modelname"); // app/model/modelname.php
$model->function();
```
View Yüklemek İçin<br>
```php
$params = array(
          "kısa" => "burun"
          );
$this->load->view("viewname",$params);
```
## Model 
Model Dosyalarınızı **/app/model/** Dizini Altına Ekleyin<br>
Örnek
```php
<?php

class Modelname extends Model{
    public function index($a){
    return $a;
    }
}
```
Controller Dosyasındaki Fonksiyonlar Burdada Geçerli
## View
View Dosyalarınız **/app/view/** Dizini Altına Ekleyin.View Dosyalarınızda Controller Fonksiyonlarını Kullanabilirsiniz.Controller'dan Gelen Parametreleri Şu Şekilde Kullanabilirsiniz<br>
Controller
```php
$params = array(
          "kısa" => "burun"
          );
$this->load->view("viewname",$params);
```
View
```php
echo $kısa; //burun
```
## Yapılacaklar
- [x] Genel Kullanım Rehberi Oluşturulacak
- [ ] Helperler İçin Bir Kullanım Rehberi Oluşturulacak
- [ ] Kütüphaneler İçin Bir Kullanım Rehberi Oluşturulacak






