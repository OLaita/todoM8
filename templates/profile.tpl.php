<?php

    include 'base.tpl.php';


?>

    <main>
    
        <article>
            <h2>PROFILE</h2>
        </article>
    
    </main>

    <h3><?php echo $_SESSION['userLogged']; ?></h3>

    <form action="/user/deleteUser" method="post">
    
    <input class="btn btn-danger" type="submit" value="Borrar usuario">
    
    </form>


<?php

include 'footer.tpl.php';

?>