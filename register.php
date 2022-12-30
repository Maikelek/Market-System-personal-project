<?php
session_start();

include './backend/config.php';

if(isset($_SESSION["user"])){
    header("Location: ./profil.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Registrácia</title>
</head>
<body>

    <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
                <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrácia</p>

                    <form class="mx-1 mx-md-4" action="./backend/registerValidator.php" method="POST">

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" class="form-control" name="mcNick" placeholder="MichaelAverage"/>
                            <label class="form-label" >Minecraft Nick</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" class="form-control" name="discordName" placeholder="Pouzivatel#4454" />
                            <label class="form-label">Discord Meno</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                            <input type="password" name="pass" class="form-control" placeholder="Minimálme 8 znakov"/>
                            <label class="form-label">Heslo</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div class="form-outline flex-fill mb-0">
                            <input type="password" name="passRepeat" class="form-control"/>
                            <label class="form-label">Zopakuj heslo</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-5">
                            <label class="form-check-label">
                            Máš účet? <a href="index.php">Prihlás sa</a>
                            </label>
                        </div>

                        <?php include('./components/alertSuccess.php')?>
                        <?php include('./components/alertDanger.php')?>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button name="register" class="btn btn-primary btn-lg">Registruj sa</button>
                        </div>

                    </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                    <img src="https://cdn.discordapp.com/attachments/943853451694194779/1058050220551852192/479393.jpg"
                    class="img-fluid shadow p-3 mb-5 rounded" alt="Sample image">

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