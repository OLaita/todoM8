<?php

namespace App\Controllers;

use App\View;
use App\Model;
use App\Request;
use App\Controller;
use App\DB;
use App\Session;

    class TaskController extends Controller implements View,Model{

        public function __construct(Request $request, Session $session){
            parent::__construct($request, $session);
        }

        function showTaskNow(){

            $db = DB::singleton();

            $userID = $_SESSION['userId'];
    
            $select = $db->prepare("SELECT * FROM tareas_hoy where user=:user");
            $select->execute(array(':user' => $userID));
            $result = $select->rowCount();
            $row = $select->fetchAll(\PDO::FETCH_ASSOC);
    
            if($result > 0){
    
            $result = $db->query('SELECT * FROM tareas_hoy where user='.$userID.'');
    
            echo "<table class='table'>";
    
            echo "<thead class='bg-dark'>";
            echo "<tr class='text-light'>";

                echo "<td>Descripcion</td>";
                echo "<td>Fecha</td>";
                echo "<td>Opciones</td>";

            echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
            
            $i = 0;
                
            foreach($result as $row){
            $k = $i;
            $_SESSION['id'.$i] = $row['id'];
                echo "<tr>";

                    echo "<td class='w-25'>".$row['description']."</td>";
                    echo "<td class='w-25'>".$row['due_date']."</td>";
                        
                    if($row['completed'] == 0){
                        echo "<td>
                        <button class='btn' type='submit' name='ed[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                        <img src='".BASE."public/Imagenes/editar.svg'alt='Submit' width='48' height='48'>
                        </button>
                        <button class='btn' type='submit' name='ck[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                        <img src='".BASE."public/Imagenes/basura.svg'alt='Submit' width='48' height='48'>
                        </button>
                        <button class='btn' type='submit' name='sub[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                        <img src='".BASE."public/Imagenes/mas.svg' alt='Submit' width='48' height='48'>
                        </button>
                        <a href='#demo".$k."' data-toggle='collapse' class='btn ' name='' value='".$_SESSION['id'.$i]."'>
                        <img src='".BASE."public/Imagenes/flecha-hacia-abajo.svg' alt='' width='48' height='48'>
                        </a></td>";
                    }                        
                echo "</tr>";
                
                $select2 = $db->prepare("SELECT * FROM task_item where task=:task");
                $select2->execute(array(':task' => $_SESSION['id'.$i]));
                $result3 = $select2->rowCount();
                $i2 = 0;
                echo "<td id='demo".$k."' class='collapse'><table class'table table-striped'>";
                if($result3 > 0){
                    foreach($select2 as $row){
                        $_SESSION['task'.$i2] = $row['id'];
                        echo "<tr class='row'>";
                            echo "<td><div id='demo".$k."' class='collapse'>".$row['description']."</div></td>";
                            echo "</tr>";
                            echo "<tr class='row'>";
                            echo "<td class='col-xl-12'><div id='demo".$k."' class='collapse'>
                                <button class='btn' type='submit' name='eds[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                    <img src='".BASE."public/Imagenes/editar.svg' alt='Submit' width='48' height='48'>
                                </button>
                                <button class='btn' type='submit' name='cks[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                    <img src='".BASE."public/Imagenes/basura.svg' alt='Submit' width='48' height='48'>
                                </button></div></td>";
                        echo "</tr>";
                        $i2++;
                    }

                }else{
                    echo "<tr><td><div id='demo".$k."' class='collapse'>No hay subtareas</div></td></tr>";
                }
                echo "</table></td>";
                $i++;
            }
            echo "</tbody>";

            echo "</table>";
    
            }else{
                echo "<p class='text-center'>No tienes tareas programadas para hoy</p>";
            }
            
            
        }

        function showTaskBien(){

            $db = DB::singleton();

            $userID = $_SESSION['userId'];
    
            $select = $db->prepare("SELECT * FROM tareas_bien where user=:user");
            $select->execute(array(':user' => $userID));
            $result = $select->rowCount();
            $row = $select->fetchAll(\PDO::FETCH_ASSOC);
    
            if($result > 0){
    
                $result = $db->query('SELECT * FROM tareas_bien where user='.$userID.'');
    
                echo "<table class='table'>";
    
                echo "<thead class='bg-dark'>";
                echo "<tr class='text-light'>";
    
                    echo "<td>Descripcion</td>";
                    echo "<td>Fecha</td>";
                    echo "<td>Opciones</td>";
    
                echo "</tr>";
                echo "</thead>";
    
                echo "<tbody>";
                
                $i = 0;
                    
                foreach($result as $row){
                $k = $i;
                $_SESSION['id'.$i] = $row['id'];
                    echo "<tr>";
    
                        echo "<td class='w-25'>".$row['description']."</td>";
                        echo "<td class='w-25'>".$row['due_date']."</td>";
                            
                        if($row['completed'] == 0){
                            echo "<td>
                            <button class='btn' type='submit' name='ed[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/editar.svg'alt='Submit' width='48' height='48'>
                            </button>
                            <button class='btn' type='submit' name='ck[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/basura.svg'alt='Submit' width='48' height='48'>
                            </button>
                            <button class='btn' type='submit' name='sub[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/mas.svg' alt='Submit' width='48' height='48'>
                            </button>
                            <a href='#demo1".$k."' data-toggle='collapse' class='btn ' name='' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/flecha-hacia-abajo.svg' alt='' width='48' height='48'>
                            </a></td>";
                        }                        
                    echo "</tr>";
                    
                    $select2 = $db->prepare("SELECT * FROM task_item where task=:task");
                    $select2->execute(array(':task' => $_SESSION['id'.$i]));
                    $result3 = $select2->rowCount();
                    $i2 = 0;
                    echo "<td id='demo1".$k."' class='collapse'><table class'table table-striped'>";
                    if($result3 > 0){
                        foreach($select2 as $row){
                            $_SESSION['task'.$i2] = $row['id'];
                            echo "<tr class='row'>";
                                echo "<td><div id='demo1".$k."' class='collapse'>".$row['description']."</div></td>";
                                echo "</tr>";
                                echo "<tr class='row'>";
                                echo "<td class='col-xl-12'><div id='demo1".$k."' class='collapse'>
                                    <button class='btn' type='submit' name='eds[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                        <img src='".BASE."public/Imagenes/editar.svg' alt='Submit' width='48' height='48'>
                                    </button>
                                    <button class='btn' type='submit' name='cks[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                        <img src='".BASE."public/Imagenes/basura.svg' alt='Submit' width='48' height='48'>
                                    </button></div></td>";
                            echo "</tr>";
                            $i2++;
                        }

                    }else{
                        echo "<tr><td><div id='demo1".$k."' class='collapse'>No hay subtareas</div></td></tr>";
                    }
                    echo "</table></td>";

                    $i++;
                }
                echo "</tbody>";
    
                echo "</table>";
    
            }else{
                echo "<p class='text-center'>No tienes tareas programadas para otros dias</p>";
            }
    
            
        }


        function showTaskret(){

            $db = DB::singleton();

            $userID = $_SESSION['userId'];
    
            $select = $db->prepare("SELECT * FROM tareas_retrasadas where user=:user");
            $select->execute(array(':user' => $userID));
            $result = $select->rowCount();
            //$row = $select->fetchAll(PDO::FETCH_ASSOC);
    
            if($result > 0){
    
                $result2 = $db->query('SELECT * FROM tareas_retrasadas where user='.$userID.'');
    
                echo "<table class='table'>";
    
                echo "<thead class='bg-dark'>";
                echo "<tr class='text-light'>";
    
                    echo "<td>Descripcion</td>";
                    echo "<td>Fecha</td>";
                    echo "<td>Opciones</td>";
    
                echo "</tr>";
                echo "</thead>";
    
                echo "<tbody>";
                
                $i = 0;
                    
                foreach($result2 as $row){
                $k = $i;
                $_SESSION['id'.$i] = $row['id'];
                    echo "<tr>";
    
                        echo "<td class='w-25'>".$row['description']."</td>";
                        echo "<td class='w-25'>".$row['due_date']."</td>";
                            
                        if($row['completed'] == 0){
                            echo "<td>
                            <button class='btn' type='submit' name='ed[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/editar.svg'alt='Submit' width='48' height='48'>
                            </button>
                            <button class='btn' type='submit' name='ck[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/basura.svg'alt='Submit' width='48' height='48'>
                            </button>
                            <button class='btn' type='submit' name='sub[<?=$k?>]' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/mas.svg' alt='Submit' width='48' height='48'>
                            </button>
                            <a href='#demo2".$k."' data-toggle='collapse' class='btn ' name='' value='".$_SESSION['id'.$i]."'>
                            <img src='".BASE."public/Imagenes/flecha-hacia-abajo.svg' alt='' width='48' height='48'>
                            </a></td>";
                        }                        
                    echo "</tr>";
                    
                    $select2 = $db->prepare("SELECT * FROM task_item where task=:task");
                    $select2->execute(array(':task' => $_SESSION['id'.$i]));
                    $result3 = $select2->rowCount();
                    $i2 = 0;
                    echo "<td id='demo2".$k."' class='collapse'><table class'table table-striped'>";
                    if($result3 > 0){
                        foreach($select2 as $row){
                            $_SESSION['task'.$i2] = $row['id'];
                            echo "<tr class='row'>";
                                echo "<td><div id='demo2".$k."' class='collapse'>".$row['description']."</div></td>";
                                echo "</tr>";
                                echo "<tr class='row'>";
                                echo "<td class='col-xl-12'><div id='demo2".$k."' class='collapse'>
                                    <button class='btn' type='submit' name='eds[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                        <img src='".BASE."public/Imagenes/editar.svg' alt='Submit' width='48' height='48'>
                                    </button>
                                    <button class='btn' type='submit' name='cks[<?=$i2?>]' value='".$_SESSION['task'.$i2]."'>
                                        <img src='".BASE."public/Imagenes/basura.svg' alt='Submit' width='48' height='48'>
                                    </button></div></td>";
                            echo "</tr>";
                            $i2++;
                        }

                    }else{
                        echo "<tr><td><div id='demo2".$k."' class='collapse'>No hay subtareas</div></td></tr>";
                    }
                    echo "</table></td>";
                    $i++;
                }
                echo "</tbody>";
    
                echo "</table>";
    
            }else{
                echo "<p class='text-center'>No tienes tareas retrasadas</p>";
            }
            
        }

        function newTask(){
            $db = DB::singleton();
            $description = filter_input(INPUT_POST, "description");
            $date = filter_input(INPUT_POST, "date");

            $userID = $_SESSION['userId'];
            $fecha = date("Y-m-d", strtotime($date));

            $stmt = $db->prepare("INSERT INTO task (description, user, due_date, completed)
                    VALUES (:description,:user,:due_date,:completed)");

            if($stmt->execute([':description'=>$description, ':user'=>$userID,
                ':due_date'=>$fecha, ':completed'=>0]) ){
                header('Location: '.BASE.'index/allTask');
            }else{
                header('Location: '.BASE.'index/newTask');
            }
        }

        function addSubTask(){
            $db = DB::singleton();
            $description = filter_input(INPUT_POST, "description");
        
            $stmt = $db->prepare("INSERT INTO task_item (description, completed, task) VALUES (:description,0,:task)");
        
            if($stmt->execute([':description'=>$description, ':task'=>$_SESSION['idTask']]) ){
                header('Location: '.BASE.'index/allTask');
            }
        }

        function deleteItems($db, $deleteId){
            $command3 = $db->prepare("DELETE FROM task WHERE id=:id");
            $command4 = $db->prepare("DELETE FROM task_item WHERE task=:task");
            try{
                $command3->execute([':id'=>$deleteId]);
                $command4->execute([':task'=>$deleteId]);
            }catch(PDOException $e){
                die($e->getMessage());
            }
    
        }

        function deleteSubItems($db, $deleteId){
            $command4 = $db->prepare("DELETE FROM task_item WHERE id=:task");
            try{
                $command4->execute([':task'=>$deleteId]);
            }catch(PDOException $e){
                die($e->getMessage());
            }
    
        }

        function updateTask(){

            $db = DB::singleton();

            $nTask = filter_input(INPUT_POST, "tn");
            $dTask = filter_input(INPUT_POST, "dt");
            $idTask = $_SESSION['idTask'];

            if(isset($nTask) && isset($dTask)){
                if(isset($nTask)){
                    $nTask = $_SESSION['nTask'];
                }
                $command3 = $db->prepare("UPDATE task SET description=:description, due_date=:due_date WHERE id=:id");
                try{
                    $command3->execute([':description'=>$nTask, ':due_date'=>$dTask, ':id'=>$idTask]);
                    header('Location: '.BASE.'index/allTask');
                }catch(PDOException $e){
                    die($e->getMessage());
                }
            }else{
                header('Location: '.BASE.'index/udTask');
            }

        }

        function updateSubTask(){

            $db = DB::singleton();

            $nTask = filter_input(INPUT_POST, "tn");
            $idsTask = $_SESSION['idSubTask'];

            if(isset($nTask)){
                $command3 = $db->prepare("UPDATE task_item SET description=:description WHERE id=:id");
                try{
                    $command3->execute([':description'=>$nTask, ':id'=>$idsTask]);
                    header('Location: '.BASE.'index/allTask');
                }catch(PDOException $e){
                    die($e->getMessage());
                }
            }else{
                header('Location: '.BASE.'index/udSubTask');
            }

        }

        function actions(){
            $db = DB::singleton();
            if(isset($_POST['ck'])) {
                foreach ($_POST['ck'] as $key => $value) {
                    self::deleteItems($db, $value);
                    header('Location: '.BASE.'index/allTask');
                }
            }
        
            if(isset($_POST['ed'])) {        
                foreach ($_POST['ed'] as $key => $value) {
                    $_SESSION['idTask'] = $value;
                    $result = $db->query('SELECT * FROM task where id='.$_SESSION['idTask'].'');
                    foreach($result as $row){
                        $_SESSION['nTask'] = $row['description'];
                        $_SESSION['dTask'] = $row['due_date'];
                    }

                    header('Location: '.BASE.'index/udTask');
                }
            }

            if(isset($_POST['sub'])) {
                foreach ($_POST['sub'] as $key => $value) {
                    $_SESSION['idTask'] = $value;
                    header('Location: '.BASE.'index/newSubTask');
                }
            }

            // SUBTAREAS

            if(isset($_POST['eds'])) {
                foreach ($_POST['eds'] as $key => $value) {
                    $_SESSION['idSubTask'] = $value;
                    $result = $db->query('SELECT * FROM task_item where id='.$_SESSION['idSubTask'].'');
                    foreach($result as $row){
                        $_SESSION['nSubTask'] = $row['description'];
                    }
                    header('Location: '.BASE.'index/udSubTask');
                }
            }

            if(isset($_POST['cks'])) {
                foreach ($_POST['cks'] as $key => $value) {
                    self::deleteSubItems($db, $value);
                    header('Location: '.BASE.'index/allTask');
                }
            }
        }


    }