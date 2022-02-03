<?php 
    session_start();
    if(isset($_COOKIE['LOG'])||isset($_SESSION['LOG']))
    {
    unset($_SESSION['LOG']);
    unset($_SESSION['UD']);
    unset($_SESSION['UP']);
    session_destroy();
    setcookie ("UD","",time()-3600,"/");
    setcookie ("LOG","",time()-3600,"/");
    header("location:index.php");
    }
    ?>