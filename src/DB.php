<?php

namespace App;

    class DB extends \PDO{

        static $instance;
        protected $config;

        static function singleton(){
            if(!(self::$instance instanceof self)){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct(){/*
            $config = $this->loadConf();
            // determinar env pro o dev
            $strdbconf = 'dbconf_'.$this->env();
            $dbconf = (array)$config->$strdbconf;
            $dsn = $dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
            $usr = $dbconf['dbuser'];
            $pwd = $dbconf['dbpass'];
            parent::__construct($dsn,$usr,$pwd);*/
            parent::__construct(DSN,USR,PWD);
        }

        private function env(){
            $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);
            if($ipAddress == '127.0.0.1'){
                return 'dev';
            }else{
                return 'pro';
            }
        }

        private function loadConf(){
            $file = "config.json";
            $jsonStr = file_get_contents($file);
            $arrayJson = json_decode($jsonStr);
            return $arrayJson;
        }

    }