<?php
require '../PROCESOS/connect.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_home_medico.css">
    <title>Lorem Medicina - Medico</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../IMG/logo.png" alt="logo" width="70px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Saludos, <?php echo $_SESSION['nombre'] ?></a>
                    <a class="nav-link" href="../index.php">Cerrar sesion</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="main-grid-wrapper">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../IMG/card1.webp" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Solicitud de consulta.</p>
                    <a href="../solicitud_consulta/solicitud_de_consulta.php" class="btn btn-primary">Ir al sitio</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../IMG/card2.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Pacientes Atendidos.</p>
                    <a href="../pacientes atendidos/pacientes_atendidos.php" class="btn btn-primary">Ir al sitio</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>