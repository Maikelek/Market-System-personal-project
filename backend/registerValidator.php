<?php
    session_start();
    include 'config.php';

    if(isset($_POST["register"])){
        $mcNick = $_POST["mcNick"];
        $discordName = $_POST["discordName"];
        $pass = $_POST["pass"];
        $passRepeat = $_POST["passRepeat"];


        $userExists = mysqli_query($conn, "SELECT * FROM users WHERE mcNick = '$mcNick' OR discordName = '$discordName'");
        if(mysqli_num_rows($userExists) > 0){
            $_SESSION['messageDanger'] = "Používateľské údaje už existujú!";
            header("Location: ../register.php");
            exit(0);
        }

        if (!$mcNick || !$discordName || !$pass || !$passRepeat){
            $_SESSION['messageDanger'] = "Je potrebné vyplniť všetky polia";
            header("Location: ../register.php");
            exit(0);
        }

        if (strpos($discordName, '#') == false) {
            $_SESSION['messageDanger'] = "Zadaj platné Discord meno";
            header("Location: ../register.php");
            exit(0);
        }

        if (strlen($pass) <= 7) {
            $_SESSION['messageDanger'] = "Heslo musí mať minimálne 8 znakov";
            header("Location: ../register.php");
            exit(0);
        }

        if ($pass !== $passRepeat) {
            $_SESSION['messageDanger'] = "Hesla sa nezhoduju";
            header("Location: ../register.php");
            exit(0);
        } else {
            $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
            $query = "INSERT INTO users ( mcNick, discordName, pass) VALUES ('$mcNick', '$discordName', '$hashedPass')";
            $result = mysqli_query($conn, $query);

            $_SESSION['messageSucess'] = "Zaregistroval si sa";
            header("Location: ../index.php");
            exit(0);
        }
    }
?>
