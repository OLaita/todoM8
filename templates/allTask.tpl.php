<?php

    include 'base.tpl.php';

    use App\Controllers\TaskController;


?>

    <main>
    
        <article>
            <h2>Todas las tareas</h2>
        </article>
        <h3><?php echo $_SESSION['userLogged']; ?></h3>
    
    </main>


    <div class="container">
    
    
    <form class="" action="/task/actions" method="post">
    <h4 class="text-center">Tareas para hoy</h4>
    
    <?php
    
    TaskController::showTaskNow();

    ?>
    
    </form>

    <form class="" action="/task/actions" method="post">
    <h4 class="text-center">Tareas para otros dias</h4>

    <?php

    TaskController::showTaskBien();

    ?>

    </form>

    <form class="" action="/task/actions" method="post">
    <h4 class="text-center">Tareas Retrasadas</h4>

    <?php

    TaskController::showTaskret();

    ?>

    </form>



<?php

include 'footer.tpl.php';

?>