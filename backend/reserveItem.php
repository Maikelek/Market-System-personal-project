<?php

include 'config.php';;

if(isset($_POST['reserve']))
{
    $itemID = mysqli_real_escape_string($conn, $_POST['reserve']);
    $userID = $_POST["userID"];

    $query = "UPDATE market SET reservedBy='$userID' WHERE itemID='$itemID'";
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