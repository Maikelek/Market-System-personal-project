<?php
    session_start();
    include 'config.php';

    if(isset($_POST["login"])){
        $mcNick = $_POST["mcNick"];
        $pass = $_POST["pass"];


        if (!$mcNick || !$pass){
            $_SESSION['messageDanger'] = "Je potrebné vyplniť všetky polia";
            header("Location: ../login.php");
            exit(0);
        }

        $query = "SELECT * FROM users WHERE mcNick = '$mcNick'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        $userID = $data['id'];
        $passDB = $data['pass'];

        if(mysqli_num_rows($result) > 0) {
            if (password_verify($pass, $passDB)) {
               $_SESSION['user'] = $userID;
               header("Location: ../profil.php");
            } else { 
               $_SESSION['messageDanger'] = "Zlé heslo!";
               header("Location: ../index.php");
               exit(0);
            }

        } else {
            $_SESSION['messageDanger'] = "Používateľ neexistuje";
            header("Location: ../index.php");
            exit(0);
        }
    }
?>