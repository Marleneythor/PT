<?php 

 $mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
 $response = array('mensaje' => $mensaje);
 echo json_encode($response);
 
 ?>