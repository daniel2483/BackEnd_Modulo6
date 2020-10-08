<?php

  require "library.php";

  $all = readRealEstate();

  echo json_encode($all);

 ?>
