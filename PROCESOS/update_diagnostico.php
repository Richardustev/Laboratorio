<?php
require 'connect.php';
session_start();

if(isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar'){
    $id_paciente = $_POST['id_paciente'];
    $correo_paciente = $_POST['correo_paciente'];
    $nombre_medico = $_SESSION['nombre'];
    $apellido_medico = $_SESSION['apellido'];
    $diagnostico = $_POST['diagnostico'];
    $fecha_diagnostico = $_POST['fecha_diagnostico'];


    if(isset($nombre_medico) && 
    isset($apellido_medico) && 
    isset($diagnostico) && 
    isset($fecha_diagnostico) && 
    !empty($nombre_medico) && 
    !empty($apellido_medico) && 
    !empty($diagnostico) &&
    !empty($fecha_diagnostico)){
        $ssql_update_paciente = "UPDATE 
                                datos_paciente SET 
                                nombre_medico = '$nombre_medico', 
                                apellido_medico = '$apellido_medico', 
                                fecha_diagnostico = '$fecha_diagnostico', 
                                resultado_diagnostico = '$diagnostico', 
                                atendido_e = 'desactivado',
                                atendido_m = 'atendido' WHERE datos_paciente.id = $id_paciente;";
        
        $ssql_update_ejecutar = mysqli_query($mysqli, $ssql_update_paciente);

        if($ssql_update_ejecutar){
            echo 'actualizado con exito';
            header('location:mail.php');

        } else {
            echo '<script>alert("Error al actualizar los datos");
            location.href = "../diagnostico/realizar_diagnostico.php"</script>';
        }

    }
}

?>