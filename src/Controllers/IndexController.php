<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;

    final class IndexController extends Controller{

        public function __construct(Request $request, Session $session){
            parent::__construct($request, $session);            
        }

        public function index(){
            $db = $this->getDB();
            $dataview=['title'=>'Todo'];
            $this->render($dataview);

        }

        public function login(){
            $dataview=['title'=>'Login'];
            $this->render($dataview,'login');
        }

        public function register(){
            $dataview=['title'=>'Register'];
            $this->render($dataview,'register');
        }

        public function allTask(){
            $dataview=['title'=>'allTask'];
            $this->render($dataview,'allTask');
        }

        public function newSubTask(){
            $dataview=['title'=>'newSubTask'];
            $this->render($dataview,'newSubTask');
        }

        public function profile(){
            $dataview=['title'=>'profile'];
            $this->render($dataview,'profile');
        }

        public function newTask(){
            $dataview=['title'=>'newTask'];
            $this->render($dataview,'newTask');
        }

        public function udTask(){
            $dataview=['title'=>'udTask'];
            $this->render($dataview,'udTask');
        }

        public function udSubTask(){
            $dataview=['title'=>'udSubTask'];
            $this->render($dataview,'udSubTask');
        }

    }