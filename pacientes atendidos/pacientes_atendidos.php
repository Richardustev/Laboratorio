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
    <link rel="stylesheet" href="style_pacientes.css">
    <title>Lorem Medicina - Pacientes Atendidos</title>
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
                    <a class="nav-link active" aria-current="page" href="#">Pacientes atendidos</a>
                    <a class="nav-link" href="../PROCESOS/regresar.php">Regresar</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <h2 class="main-title">
            Pacientes atendidos.
        </h2>
        <hr>

        <?php
            $ssql_datos = "SELECT * FROM datos_paciente WHERE atendido_e = 'desactivado' AND atendido_m = 'desactivado'";
            $result = mysqli_query($mysqli, $ssql_datos);
            while($mostrar = mysqli_fetch_array($result)){
            ?>
        <div class="tabla-de-datos">
            <h2>Datos del paciente:</h2>
                <div class="tabla-de-datos">
                <table>
                    <tr>
                        <td><b>Nombre del Paciente:</b></td>
                        <td><b>Apellido del Paciente:</b></td>
                        <td><b>Cedula del Paciente:</b></td>
                        <td><b>Correo del Paciente:</b></td>
                        <td><b>Nombre del Empleado:</b></td>
                        <td><b>Apellido del Empleado:</b></td>
                        <td><b>Fecha de atencion:</b></td>
                        <td><b>Examen requerido:</b></td>
                        <td><b>nombre del medico:</b></td>
                        <td><b>Apellido del medico:</b></td>
                        <td><b>Diagnostico:</b></td>
                        <td><b>Fecha Diag:</b></td>
                    </tr>
                    <tr>                            
                        <td><?php echo $mostrar['nombre_paciente'] ?></td>                            
                        <td><?php echo $mostrar['apellido_paciente'] ?></td>                           
                        <td><?php echo $mostrar['cedula_paciente'] ?></td>                            
                        <td><?php echo $mostrar['correo_paciente'] ?></td>
                        <td><?php echo $mostrar['nombre_enfermero'] ?></td>
                        <td><?php echo $mostrar['apellido_atencion'] ?></td>
                        <td><?php echo $mostrar['fecha_enfermero'] ?></td>
                        <td><?php echo $mostrar['solicitud_diagnostico'] ?></td>
                        <td><?php echo $mostrar['nombre_medico'] ?></td>
                        <td><?php echo $mostrar['apellido_medico'] ?></td>
                        <td><?php echo $mostrar['resultado_diagnostico'] ?></td>
                        <td><?php echo $mostrar['fecha_diagnostico'] ?></td>
                    </tr>
                </table>
        </div>
        <?php 
        }
        ?>
    </main>
</body>
</html>