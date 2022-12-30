<?php
    session_start();
    include 'config.php';

    if(isset($_SESSION["user"])){
        $userID = $_SESSION["user"];
    } 
    

    if(isset($_POST["sale"])){
        $item = $_POST["item"];
        $count = $_POST["count"];
        $price = $_POST["price"];

        if (!$item || !$count || !$price){
            $_SESSION['messageDanger'] = "Je potrebné vyplniť všetky polia";
            header("Location: ../market.php");
            exit(0);
        }

        if ( $count >= 1000 || $price >= 1000) {
            $_SESSION['messageDanger'] = "Počet alebo cena nesmie presahovať 999";
            header("Location: ../market.php");
            exit(0);
        }

        $query = "INSERT INTO market ( userID, item, count, price) VALUES ('$userID', '$item', '$count', '$price')";
        $result = mysqli_query($conn, $query);

        $_SESSION['messageSucess'] = "Pridal si predmet";
        header("Location: ../market.php");
        exit(0);

    }
?>