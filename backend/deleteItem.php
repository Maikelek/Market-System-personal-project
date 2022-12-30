<?php

include 'config.php';;

if(isset($_POST['remove']))
{
    $id = mysqli_real_escape_string($conn, $_POST['remove']);

    $query = "DELETE FROM market WHERE itemID='$id' ";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        header("Location: ../market.php");
        exit(0);
    }
    else
    {
        header("Location: ../market.php");
        exit(0);
    }
}

?>