<?php

    include 'base.tpl.php';


?>

    <main>
    
        <article>
            <h2>Todas las tareas</h2>
        </article>
        <h3><?php echo $_SESSION['userLogged']; ?></h3>
    
    </main>

    

    <div>
    
    <h4>Crear subtarea</h4>

    <form class="d-flex justify-content-cente align-items-center flex-column" action="<?= BASE ?>task/addSubTask" method="post">
        <div class="col-md-6 text-center form-group">
            <label for="name">Descripcion:</label>
            <input type="text" class="form-control text-center" placeholder="Enter description" id="description" name="description">
        </div>
        <button type="submit" name="newSubTask" class="btn btn-primary">Submit</button>

    </form>
    
    
    </div>


<?php

include 'footer.tpl.php';

?>