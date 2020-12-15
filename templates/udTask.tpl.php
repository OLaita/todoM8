<?php

    include 'base.tpl.php';

    $dia = intval(substr($_SESSION['dTask'], 8));
    $mes = intval(substr($_SESSION['dTask'], 5,-3)); 
    $año = intval(substr($_SESSION['dTask'], 0,-6));


?>

    <main>
    
        <article>
            <h2>Editar Tarea</h2>
        </article>
    
    </main>


    <div class="container">
    
    
    <form class="d-flex justify-content-cente align-items-center flex-column" action="<?= BASE ?>task/updateTask" method="post">

    <div class="col-md-6 text-center form-group">
            <label for="name">Task Name:</label>
            <input type="text" class="form-control text-center" placeholder="<?php echo $_SESSION['nTask']; ?>" id="name" name="tn">
        </div>
        <div class="col-md-6 text-center form-group">
            <label for="date">Fecha:</label>
            <input type="date" class="form-control text-center" value="<?php echo date("Y-m-d", mktime(0, 0, 0,$mes, $dia, $año)); ?>" id="date" name="dt">
        </div>
        <button type="submit" name="cambio" class="btn btn-primary">Submit</button>
    

    </form>

    
    
    </div>


<?php

include 'footer.tpl.php';

?>