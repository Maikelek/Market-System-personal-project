<?php
session_start();
include './backend/config.php';

if(isset($_SESSION["user"])){
    $id = $_SESSION["user"];
    $result = mysqli_query($conn, "SELECT * FROM users");
    $data = mysqli_fetch_assoc($result);
} else {
  $mcNick = null;
  header("Location: ./index.php");
}

$sql = "SELECT * FROM `market`";
$resultMarket = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Trhovisko</title>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a href="https://github.com/maikelek" class="navbar-brand">Serveris</a>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="market.php" class="nav-link active">Trhovisko</a>
                </li>
                <li class="nav-item">
                    <a href="profil.php" class="nav-link">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="./backend/logout.php" class="nav-link">Odhlás sa</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="card container mt-5 p-4">

        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h2 class="card-title">Predávaj!</h2>
                <div class="card-text mt-3">
                    Stačí len vyplniť tento formulár a každý bude vedieť o veciach, ktoré predávaš
                </div>
            </div>
        </div>

        <form class="row text-center" action="./backend/marketLogic.php" method="POST">
            <div class="col">
                <input type="text" name="item" class="form-control shadow p-2 bg-body rounded" placeholder="Pumpkin"/>
                <label class="form-label mt-2">Predmet</label>
            </div>
            <div class="col">
                <input type="number" name="count" class="form-control shadow p-2 bg-body rounded" placeholder="64"/>
                <label class="form-label mt-2">Počet predmetov</label>
            </div>
            <div class="col">
                <input type="number" name="price" class="form-control shadow p-2 bg-body rounded" placeholder="5"/>
                <label class="form-label mt-2">Cena v diamantoch</label>
            </div>

            <?php include('./components/alertSuccess.php')?>
            <?php include('./components/alertDanger.php')?>

            <div class="d-flex justify-content-center">
                <button name="sale" class="btn btn-primary mt-3">Pridaj predmet</button>
            </div>
        </form>
    </div>

    <div class="container">

        <div class="card shadow p-3 mt-5 bg-body rounded">
            <div class="card-body">
                <h2 class="card-title">Trhovisko</h2>
                <div class="card-text mt-3">
                    Tu si vieš pozrieť kto čo predáva a rezervovať si daný predmet.
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap">

        <?php foreach ($resultMarket as $data): ?> 
        
        <div class="card mt-5 m-2" style="width: 18rem;">
            <div class="card-body">

                <h5 class="card-title"><?= $data['item']?></h5>

                <?php
                      $sellerID = $data['userID'];
                      $sql = "SELECT mcNick FROM `users` WHERE id=$sellerID";
                      $resultNames = mysqli_query($conn, $sql); 
                      $name = mysqli_fetch_assoc($resultNames); 
                      
                      
                ?>
                
                <h6 class="card-subtitle mb-2 text-muted"><?= $name['mcNick']?></h6>
                <div class="row">
                    <h6 class="col card-subtitle mb-2 text-muted">Cena: <?= $data['price']?> dia</h6>
                    <h6 class="col card-subtitle mb-2 text-muted">Počet: <?= $data['count']?></h6>
                </div>
                <p class="card-text">Ak máš záujem môžeš si tento predmet rezervovať.</p>
                <?php
                    if ($id == $sellerID) {

                        if($data['reservedBy'] == 0){
                            include "./components/removeButton.php";
                        } else {
                            $reserverID = $data['reservedBy'];
                            $sql = "SELECT mcNick FROM `users` WHERE id=$reserverID";
                            $resultReserver = mysqli_query($conn, $sql); 
                            $nameReserver = mysqli_fetch_assoc($resultReserver); 
                            $nameReserver = $nameReserver['mcNick'];
                            include "./components/removeButton.php";
                            echo "<h6 class='card-subtitle mb-2 mt-2 text-muted'>Rezervovane: $nameReserver</h6>";
                        }

                    } else {
                        if($data['reservedBy'] == 0){
                            include "./components/reserveButton.php";
                        } else {
                            $reserverID = $data['reservedBy'];
                            $sql = "SELECT mcNick FROM `users` WHERE id=$reserverID";
                            $resultReserver = mysqli_query($conn, $sql); 
                            $nameReserver = mysqli_fetch_assoc($resultReserver); 
                            $nameReserver = $nameReserver['mcNick'];
                            echo "<h6 class='card-subtitle mb-2 mt-2 text-muted'>Rezervovane: $nameReserver</h6>";
                        }
                    }
                ?>

            </div>
        </div>

        <?php endforeach ?> 

        </div>      
    
</body>
</html>