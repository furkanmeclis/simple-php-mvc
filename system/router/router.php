<?php


    class Router extends Hata
    {
        public $controller = 'welcome';
        public $method = 'index';
        public $route = [];
        
        

        public function get_url()
        {
            $url = isset($_GET["uri"]) ? $_GET["uri"] : $this->controller."/".$this->method;
            return $url;
        }

        public function add($url,$callback,$method)
        {
            

            $patterns = [
                '{url}' => '([0-9a-zA-Z]+)',
                '{id}' => '([0-9]+)',
                "{all}" => '(.*)',
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
            $this->route[$url] = array(
                "url" => $url,
                "callback" => $callback,
                "method" => strtoupper($method),
                
            );
        }

        public function run()
        {
           $main_url = $this->get_url();
           $url_kontrol = explode('/',$main_url);
            $i = 0;
           foreach ($this->route as $key => $value) {
            if (preg_match('@^' . $key . '$@', $main_url,$parame)) {
                $i = 1;
                $xnc = $value;
                $parameters = $parame;
            }
           }
           
           if ($i == 1) {
              $array = $xnc;
              
              $method = explode('|',$array["method"]);
              $callback = $array["callback"];
              $url = $array["url"]; 

              if (in_array($_SERVER["REQUEST_METHOD"], $method)) {
                
                //if (preg_match('@^' . $url . '$@', $main_url, $parameters)) {

                    unset($parameters[0]);
                    $controller_name = explode("@",$callback);
                    $file_name = realpath(".")."/app/controller/".strtolower($controller_name[0]).".php";
                    if (file_exists($file_name)) {
                        require $file_name;
                        if (method_exists($controller_name[0],$controller_name[1])){
                            call_user_func_array([new $controller_name[0],$controller_name[1]],$parameters);
                        }else {
                            echo $this->hata_error("?","Method Bulunamad??","<b>'".$controller_name[0]."'</b> Adl?? S??n??fta <b>'".$controller_name[1]."'</b> Adl?? Method Bulunamad??<br>Dosya Yolu : <b>$file_name</b>");
                        }
                       
                    }else{
                        //todo 404 no file
                        echo $this->hata_error("404","Dosya Bulunamad??","Dosya Yolu : <b>$file_name</b>");
                    }


               // }else{
                     
                     //echo $this->hata_error("404","E??le??me Olmad??","Ne yaz??kki girdi??iniz link yap??s?? gitmek istedi??iniz sayfa ile uyu??muyor");
                    
                 //}
              }else{
                echo $this->hata_error("!","Yanl???? ??stek Metodu","Bu sayfaya eri??meye ??al????t??????n??z methoda eri??im hakk?? yok<br>Bu sayfaya yaln??zca ??u methodlar ile eri??ebilirsiniz<br><b><code>".$array["method"]."</code></b>");
              }
           }else{

            $xc = $url_kontrol[0];
            if (isset($url_kontrol[1])) {
                $bc = $url_kontrol[1];
            }else{
                $bc = $this->method;
            }
            
            unset($url_kontrol[0]);
            unset($url_kontrol[1]);

            $file_name = realpath(".")."/app/controller/".strtolower($xc).".php";
            if (file_exists($file_name)) {
                require $file_name;
                if(method_exists($xc , $bc)){
                    call_user_func_array([new $xc,$bc],$url_kontrol);
                }else{
                    //TODO 404
                    echo $this->hata_error("?","Method Bulunamad??","<b>'".$xc."'</b> Adl?? S??n??fta <b>'".$bc."'</b> Adl?? Method Bulunamad??<br>Dosya Yolu : <b>$file_name</b>");
                       
                }
                
            }else{
                //todo 404 no file
                echo $this->hata_error("404","Dosya Bulunamad??","Dosya Yolu : <b>$file_name</b>");
                  
            }

           }
        }

    }
    