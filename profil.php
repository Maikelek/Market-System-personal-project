<?php
session_start();
include './backend/config.php';

if(isset($_SESSION["user"])){
    $id = $_SESSION["user"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $data = mysqli_fetch_assoc($result);
} else {
  $mcNick = null;
  header("Location: ./index.php");
}

$sql = "SELECT COUNT(userID) AS sells FROM market WHERE userID=$id";
$resultSells = mysqli_query($conn, $sql);
$sells = mysqli_fetch_assoc($resultSells); 

$sql = "SELECT COUNT(reservedBy) AS reserves FROM market WHERE reservedBy=$id";
$resultreserves = mysqli_query($conn, $sql);
$reserves = mysqli_fetch_assoc($resultreserves); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Profil</title>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a href="https://github.com/maikelek" class="navbar-brand">Serveris</a>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="market.php" class="nav-link">Trhovisko</a>
                </li>
                <li class="nav-item">
                    <a href="profil.php" class="nav-link active">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="./backend/logout.php" class="nav-link">Odhlás sa</a>
                </li>
            </ul>
        </div>
    </nav>

<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-4">

        <div class="card" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="https://cdn.discordapp.com/attachments/943853451694194779/1058049578181591200/Minecraft-Logo-PNG10.png"
                class="img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2"><?= $data['mcNick']?></h4>
            <p class="text-muted mb-4"><?= $data['discordName']?><span class="mx-2">
            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5"><?=$sells['sells']?></p>
                <p class="text-muted mb-0">Predmety na trhovisku</p>
              </div>
              <div>
                <p class="mb-2 h5"><?=$reserves['reserves']?></p>
                <p class="text-muted mb-0">Počet rezervovaných predmetov</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

   
    
</body>
</html>