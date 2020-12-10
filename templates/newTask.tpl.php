<?php

    include 'base.tpl.php';


?>

    <main>
    
        <article>
            <h2>Nueva tarea</h2>
        </article>
        <h3><?php echo $_SESSION['userLogged']; ?></h3>
    
    </main>

    

    <div>
    
    <h4>Crear tarea</h4>

    <form class="d-flex justify-content-cente align-items-center flex-column" action="/task/newTask" method="post">
        <div class="col-md-6 text-center form-group">
            <label for="name">Descripcion:</label>
            <input type="text" class="form-control text-center" placeholder="Enter description" id="description" name="description">
        </div>
        <div class="col-md-6 text-center form-group">
            <label for="pwd">Fecha:</label>
            <input type="date" class="form-control text-center" id="date" value="<?php echo date("Y-m-d");?>" name="date">
        </div>
        <button type="submit" name="newTask" class="btn btn-primary">Submit</button>

    </form>
    
    
    </div>


<?php

include 'footer.tpl.php';

?>