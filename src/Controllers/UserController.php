<?php

namespace App\Controllers;

use App\View;
use App\Model;
use App\Request;
use App\Controller;
use App\DB;
use App\Session;

    class UserController extends Controller implements View,Model{

        public function __construct(Request $request, Session $session){
            parent::__construct($request, $session);
        }

        function logout(){
            session_destroy();
            $_COOKIE['name'] == "";
            $_COOKIE['passwd'] == "";
            header('Location: /');
        }

        function insertItems($db,$email,$user,$pass){

            $stmt = $db->prepare("INSERT INTO users (email, uname, passw, role) VALUES (:email,:uname,:passw, 2)");
    
            if($stmt->execute([':email'=>$email, ':uname'=>$user, ':passw'=>$pass]) ){
                $mostrar = setcookie("mostrar", "USUARIO REGISTRADO");
                header('Location: '.BASE.'index/login');
            }
    
        }

        function buscarUsuarios($db, $email, $user, $pass){

            $reg = filter_input(INPUT_POST, "reg");
            $save = filter_input(INPUT_POST, "save");
    
            $select = $db->prepare("SELECT * FROM users WHERE uname=:uname LIMIT 1");
            $select->execute(array(':uname' => $user));
            $result = $select->rowCount();
            $row = $select->fetchAll(\PDO::FETCH_ASSOC);
            if ($result > 0) {
                if(isset($reg)){
                    setcookie("regis", "USUARIO EXISTENTE",time()+60,'/');
                    header('Location: '.BASE.'user/register');
                    echo "registro";
                }else{
                    $usuario = $row[0];
                    $passV = password_verify($pass, $usuario['passw']);
                    if($passV){
                        setcookie("mostrar", "SESION INICIADA");
                        $_SESSION["userId"] = $usuario['id'];
                        $_SESSION["userLogged"] = $usuario['uname'];
                        header('Location: '.BASE.'index/allTask');
                    }else{
                        header('Location: '.BASE.'index/login');
                        setcookie("mostrar","Usuario o contraseña equivocados",time()+60,'/');
                    }
                }
                
            }else {
                if(isset($reg)){
                    $passH = password_hash($pass, PASSWORD_BCRYPT, ["cost"=>4]);
                    self::insertItems($db, $email, $user, $passH);
                    echo "Hola";
                }else{
                    setcookie("mostrar", "NO EXISTE EL USUARIO",time()+60,'/');
                    header('Location: '.BASE.'index/login');
                    echo "login";
                }
                    
            }
    
        }

        public function login_register(){

            $db = DB::singleton();
            
            $correo = filter_input(INPUT_POST, "correo");
            $correo = $correo."@correo.com";
            $name = filter_input(INPUT_POST, "name");
            $pass = filter_input(INPUT_POST, "pass");
            $pass2 = filter_input(INPUT_POST, "pass2");

            $save = filter_input(INPUT_POST, "save");
            $reg = filter_input(INPUT_POST, "reg");

            if(isset($_COOKIE["name"]) && isset($_COOKIE["passwd"])){
                $name = $_COOKIE["name"];
                $pass = $_COOKIE["passwd"];
            }

            if($name != null && $pass != null){

                if(isset($reg)){
                    if($pass == $pass2){
                        $this->buscarUsuarios($db, $correo, $name, $pass);
                    }else{
                        setcookie("mostrar", "Las contraseñas no coinciden");
                        header('Location: '.BASE.'user/register');
                    }
                }else{
                    if(isset($save)){
                        setcookie("name", $name,time()+60,'/');
                        $passH = password_hash($pass, PASSWORD_BCRYPT, ["cost"=>4]);
                        setcookie("passwd", $passH,time()+60,'/');
                    }
                    self::buscarUsuarios($db, $correo, $name, $pass);
                }
            
            }else{
                $mostrar = setcookie("mostrar", "El usuario o contraseña vacios");
                header('Location: '.BASE.'user/login');
            }
        }

        function deleteUser(){

            $db = DB::singleton();

            $id = $_SESSION['userId'];

            $delU = $db->prepare("DELETE FROM users WHERE id=:id LIMIT 1");
            $delU->execute(array(':id' => $id));

            $result = $db->prepare('SELECT * FROM task where user=:id');
            $result->execute(array('id' => $id));

            foreach($result as $row){
                $_SESSION['idT'] = $row['id'];
            }

            $delT = $db->prepare("DELETE FROM task WHERE user=:id LIMIT 1");
            $delT->execute(array(':id' => $id));

            $delT = $db->prepare("DELETE FROM task_item WHERE task=:idTask LIMIT 1");
            $delT->execute(array(':idTask' => $_SESSION['idT']));

            header('Location: '.BASE.'');
        }
        

    }