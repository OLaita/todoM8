<?php

    include 'base.tpl.php';
    echo $_SESSION['idSubTask'];


?>

    <main>
    
        <article>
            <h2>Editar Tarea</h2>
        </article>
    
    </main>


    <div class="container">
    
    
    <form class="d-flex justify-content-cente align-items-center flex-column" action="<?= BASE ?>task/updateSubTask" method="post">

    <div class="col-md-6 text-center form-group">
            <label for="name">Subtask Name:</label>
            <input type="text" class="form-control text-center" placeholder="<?php echo $_SESSION['nSubTask']; ?>" id="name" name="tn">
        </div>
        <button type="submit" name="cambioSub" class="btn btn-primary">Submit</button>
    

    </form>

    
    
    </div>


<?php

include 'footer.tpl.php';

?>