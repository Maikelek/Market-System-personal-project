<?php
session_start();

if(isset($_SESSION["user"])){
    session_start();
    unset($_SESSION);
    session_destroy();
}
header("Location: ../index.php");

?>