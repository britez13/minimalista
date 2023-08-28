<?php
    Class App 
    {
        private $controller = "home";
        private $method = "index";
        private $params = [];

        public function __construct()
        {
           $url = $this->splitURL();


           /// Why is this working (since I am not requiring show function explicitly here) !!!!!
        //    show($url[0]);

        //    if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php" ))
           if(file_exists("../app/controllers/". strtolower($url[0]) .".php"))
           {
                $this->controller = strtolower($url[0]);
                unset($url[0]);
           }

           require("../app/controllers/" . $this->controller . ".php");
           $this->controller = new $this->controller;

           if( isset($url[1] )) 
           {
                if(method_exists($this->controller, $url[1]))
                {
                    $this->method = $url[1];
                    unset($url[1]);
                }
           }

           // Run the class and method
           $this->params = array_values($url);
           call_user_func_array([$this->controller, $this->method], $this->params);

        }

        private function splitURL() 
        {
            // show(isset($_GET['url']));
            // $url = isset($_GET['url']) ? $_GET['url'] : "home" ;

            $url = isset($_GET['url']) ? $_GET['url'] : "home";
            return explode("/", filter_var(trim($url, "/" ), FILTER_SANITIZE_URL));
        }
    }