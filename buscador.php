<?php
  require "library.php";

  // range:valuesRange,ciudad:ciudad,ciudadId:ciudadId,tipo:tipo,tipoId:tipoId}
  // Get all the POST filter variables
  $rangePrice = $_POST['range'];
  $city = $_POST['ciudad'];
  $cityId = $_POST['ciudadId'];
  $tipo = $_POST['tipo'];
  $tipoId = $_POST['tipoId'];

  // Array already in JSON Format
  $array = show_by_filters($city,$cityId,$tipo,$tipoId, $rangePrice);

  //echo "Los datos del Ciudad ".$city." ".$tipo." han sido almacenados exitosamente";
  header('Content-Type: application/json');
  // Echo the JSON Values after applying the filters
  echo $array;

  //echo json_encode($array);

 ?>
