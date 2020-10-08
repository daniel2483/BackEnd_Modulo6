<?php

  // Function to read the data file JSON return the array of the data
  function readRealEstate(){
    $readingFile = "./data-1.json";
    $file = fopen($readingFile,"r");
    //$response["contenido"] = fread($file,filesize("./".$titulo));
    //$response["titulo"] = $titulo;
    $fileRead = fread($file,filesize($readingFile));
    $arrayRealEstate = json_decode($fileRead,true);
    //echo $arrayUsers;
    //echo json_encode($response);
    fclose($file);
    return $arrayRealEstate;
  }

  // Function used to get the filter list Ciudad and Tipo
  function get_filter_list($filter){
    // Read JSON data --> $filter values and create an array
    $arrayRealEstate = readRealEstate();
    $length = sizeof($arrayRealEstate);
    $array_output = array();

    //print "El tamaño del array es: ".$length." \n";
    //print $arrayRealEstate[1]['Ciudad'];
    for ($i=0; $i<$length; $i++){
      //print $arrayRealEstate[$i][$filter]."<br>";
      array_push($array_output,$arrayRealEstate[$i][$filter]);
    }

    // Remove array duplicates
    $array_output = array_unique($array_output);
    $array_output = array_values($array_output);

    // For testing purposes
    //$length = sizeof($array_output);
    //for ($i=0; $i<$length; $i++){
    //  print $array_output[$i]."<br>";
    //}

    return $array_output;

  }

  function show_by_filters($city, $tipo, $min_value, $max_value){

  }

  //get_filter_list("Ciudad");

 ?>
