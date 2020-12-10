<?php

namespace App;

    final class Session {

        protected $id;

        public function __construct(){

            $status = session_status();

            if($status == PHP_SESSION_DISABLED){
                throw new \LogicException('Session are disabled');
            }

            if($status == PHP_SESSION_NONE){
                session_start();
                $this->id = session_id();
            }

        }

        public function get($key){
            if(array_key_exists($key, $_SESSION)){
                return $_SESSION[$key];
            }
            return null;
        }

        public function set ($key, $value){
            $_SESSION[$key] = $value;
        }

        public function delete($key){
            if(array_key_exists($key, $_SESSION)){
                unset($_SESSION[$key]);
                session_destroy();
                return true;
            }
            return false;
        }

        public function exists($key){
            return array_key_exists($key, $_SESSION);
        }

    }