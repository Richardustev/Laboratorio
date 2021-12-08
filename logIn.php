<?php 
include './PROCESOS/connect.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style-login.css">
    <title>Lorem Medicina - LogIn</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./IMG/logo.png" alt="logo" width="70px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Ingreso de usuarios</a>
                    <a class="nav-link" aria-current="page" href="index.php">Regresar</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="main-login-container">
            <h2><b>Ingrese sus datos</b></h2>
            <hr>
            <div class="main-grid-wrapper">
                <div class="main-form">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        Correo: <br>
                        <input type="email" name="correo" placeholder="loremMedicina@correo.com" require><br><br>
                        contraseña: <br>
                        <input type="password" name="pass" placeholder="contraseña" require><br><br>

                        <input type="submit" name="ingresar" value="ingresar" class="btn btn-primary">
                    </form>
                </div>

                <div class="main-image">
                    <img src="./IMG/login-aside.jpg" alt="login">
                </div>
            </div>  
        </div>
    </main>

    <?php
        if(isset($_POST['ingresar']) && $_POST['ingresar'] == 'ingresar'){
            $correo = $_POST['correo'];
            $pass = $_POST['pass'];
            if (isset($_POST['correo']) && isset($_POST['pass']) && !empty($_POST['correo']) && !empty($_POST['pass'])){

                session_start();
                $ssql = "SELECT * FROM personal WHERE correo='$correo' AND pass='$pass';";
                $ssql_ejecutar = mysqli_query($mysqli, $ssql) or die ('Error: ' . mysqli_error($mysqli));
                $ssql_login_array = mysqli_fetch_array($ssql_ejecutar);
                $ssql_num = mysqli_num_rows($ssql_ejecutar);

                if($ssql_num > 0){
                    echo '<script>alert("Bienvenido.")</script>';
                    $_SESSION['id'] = $ssql_login_array['id'];
                    $_SESSION['nombre'] = $ssql_login_array['nombre'];
                    $_SESSION['apellido'] = $ssql_login_array['apellido'];
                    $_SESSION['cedula'] = $ssql_login_array['cedula'];
                    $_SESSION['rango'] = $ssql_login_array['rango'];

                    if ($_SESSION['rango'] == '1') {
                        header('location:./home/home_medico.php');
                    } elseif($_SESSION['rango'] == '0'){
                        header('location:./home/home_enfermero.php');
                    }

                } else {
                    echo '<script>alert("Usted no está registrado.")</script>';
                }
            } else {
                echo '<script>alert("Los datos pedidos, son requeridos.")</script>';
            }    

        }
    ?>
</body>
</html>