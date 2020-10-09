<?php

  require "library.php";

  header('Content-Type: application/json');

  $all = readRealEstate();


  echo json_encode($all);

 ?>
