<?php

namespace App\Controllers;

use App\View;
use App\Model;
use App\Request;
use App\Controller;
use App\DB;

    class UserController extends Controller implements View,Model{

        public function __construct(Request $request){
            parent::__construct($request);
        }

        public function login(){
            $dataview=['title'=>'Login'];
            $this->render($dataview,'login');
        }

        public function register(){
            
            $dataview=['title'=>'Register'];
            $this->render($dataview,'register');
        }

    }