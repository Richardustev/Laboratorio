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
    <link rel="stylesheet" href="style_diagnostico.css">
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
                    <a class="nav-link active" aria-current="page" href="#">Realizar diagnóstico</a>
                    <a class="nav-link" href="../PROCESOS/regresar.php">Regresar</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <h2 class="main-title">Seleccione un paciente</h2>
        <hr>
        <div class="paciente-select">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <select name="paciente">
                    <option value="#">Paciente</option>
                    <?php
                    $ssql_select = mysqli_query($mysqli, "SELECT id, nombre_paciente, atendido_e from datos_paciente");
                        while($datos = mysqli_fetch_array($ssql_select)){
                            ?>
                                <option value="<?php if($datos['atendido_e'] == 'atendido'){echo $datos['id'];} ?>"> <?php if($datos['atendido_e'] == 'atendido'){echo $datos['nombre_paciente'];} ?> </option>"
                            <?php
                        }
                    ?>
                </select>
                <input type="submit" name="buscar" value="Buscar" class="btn btn-success">
            </form>
        </div>
        <hr>
        <?php
        if(isset($_POST['buscar']) && $_POST['buscar'] == 'Buscar'){
            $paciente = $_POST['paciente'];

            $ssql_datos = "SELECT * FROM datos_paciente WHERE id = $paciente";
            $result = mysqli_query($mysqli, $ssql_datos);
            while($mostrar = mysqli_fetch_array($result)){
                ?>
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
                        </tr>
                    </table>
                </div>

                <div class="datos-medico">
                    <h2>Ingresar los siguientes datos:</h2>
                    <form action="../PROCESOS/update_diagnostico.php" method="POST">
                        <input type="text" style="display: none;" name="id_paciente" value="<?php echo $mostrar['id']; ?>">
                        <input type="text" style="display: none;" name="correo_paciente" value="<?php echo $mostrar['nombre_paciente']; ?>">

                        <div class="datos-medico-grid-wrapper">
                            <div class="grid-item">
                                Nombre del médico: <br>
                                <input type="text" name="nombre_medico" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                            </div>
                            <div class="grid-item">
                                Apellido del médico: <br>
                                <input type="text" name="apellido_medico" value="<?php echo $_SESSION['apellido'] ?>" disabled>
                            </div>
                            <div class="grid-item">
                                Diagnostico: <br>
                                <textarea name="diagnostico" cols="30" rows="3" require></textarea><br>
                            </div>
                            <div class="grid-item">
                                Fecha del diagnostico: <br>
                                <input type="datetime-local" name="fecha_diagnostico" min="2021-12-07T00:00">
                            </div>
                        </div>
                        
                        <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
                    </form>
                </div>
            <?php
                }
        }?>    
    </main>
    </body>
</html>