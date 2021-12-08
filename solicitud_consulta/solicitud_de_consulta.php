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
    <link rel="stylesheet" href="style_consulta.css">
    <title>Lorem Medicina - Consulta</title>
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
                    <a class="nav-link active" aria-current="page" href="#">Solicitud de Consulta</a>
                    <a class="nav-link" href="../PROCESOS/regresar.php">Regresar</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <h2 class="main-title">Solicitud de Consulta:</h2>
        <hr>
        <div class="main-form">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="form-grid-wrapper">
                    <div class="grid-item">
                        Nombre del paciente: <br>
                        <input type="text" name="nombre_paciente" require>
                    </div>
                    <div class="grid-item">
                        Apellido del paciente: <br>
                        <input type="text" name="apellido_paciente" require>
                    </div>
                    <div class="grid-item">
                        Cedula: <br>
                        <input type="text" name="cedula_paciente" require>
                    </div>
                    <div class="grid-item">
                        Correo: <br>
                        <input type="email" name="correo_paciente" require>
                    </div>
                    <div class="grid-item">
                        Fecha: <br>
                        <input type="datetime-local" name="fecha" require>
                    </div>
                    <div class="grid-item">
                        Solicitud para examen de: <br>
                        <select name="select-tipo-examen">
                            <option value="#">--Seleccionar--</option>
                            <option value="Examen de sangre">Examen de sangre</option>
                            <option value="Hemograma Completo">Hemograma Completo</option>
                            <option value="Heces por parásito">Heces por parásito</option>
                            <option value="Sangre Oculta">Sangre Oculta</option>
                            <option value="Perfil renal">Perfil renal</option>
                            <option value="Nitrógeno de urea">Nitrógeno de urea</option>
                            <option value="Perfil lipídico">Perfil lipídico</option>
                            <option value="Colesterol">Colesterol</option>
                            <option value="LDL">LDL</option>
                            <option value="HDL">HDL</option>
                        </select>
                    </div>
                    <div class="grid-item">
                        <input type="submit" name="insertar" value="insertar" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php
    if(isset($_POST['insertar']) && $_POST['insertar'] == 'insertar'){
        $nombre_paciente = $_POST['nombre_paciente'];
        $apellido_paciente = $_POST['apellido_paciente'];
        $cedula_paciente = $_POST['cedula_paciente'];
        $correo_paciente = $_POST['correo_paciente'];
        $solicitud_diag = $_POST['select-tipo-examen'];
        $nombre_empleado = $_SESSION['nombre'];
        $apellido_empleado = $_SESSION['apellido'];
        $fecha_atencion = $_POST['fecha'];

        if (isset($_POST['nombre_paciente']) && 
        isset($_POST['apellido_paciente']) && 
        isset($_POST['cedula_paciente']) && 
        isset($_POST['correo_paciente']) && 
        !empty($_POST['nombre_paciente']) && 
        !empty($_POST['apellido_paciente']) && 
        !empty($_POST['cedula_paciente']) && 
        !empty($_POST['correo_paciente'])){
            $ssql = 
            "INSERT 
            INTO datos_paciente (id, 
            nombre_paciente, 
            apellido_paciente, 
            cedula_paciente, 
            correo_paciente, 
            nombre_enfermero, 
            apellido_atencion, 
            fecha_enfermero, 
            solicitud_diagnostico, 
            nombre_medico, apellido_medico, fecha_diagnostico, resultado_diagnostico, atendido_e, atendido_m) 
            VALUES (NULL, 
            '$nombre_paciente', 
            '$apellido_paciente', 
            '$cedula_paciente', 
            '$correo_paciente', 
            '$nombre_empleado', 
            '$apellido_empleado', 
            '$fecha_atencion', 
            '$solicitud_diag',
            NULL, NULL, NULL, NULL, 'atendido', 'desactivado');";

            $ssql_ejecutar = mysqli_query($mysqli, $ssql) or die ('Error: ' . mysqli_error($mysqli));
            
            if($ssql_ejecutar){
                echo '<script>alert("Se han enviado los datos.")</script>';
            } else {
                echo '<script>alert("Algo está mal!")</script>';
            }

        } else {
            echo '<script>alert("Faltan datos...")</script>';
        }
    }
    ?>
</body>
</html>