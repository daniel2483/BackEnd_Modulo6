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

  function show_by_filters($city,$cityId,$tipo,$tipoId, $rangePrice){

    // Split the range values in min and max values Prices
    $rangePriceArray = explode (";", $rangePrice);
    $minValue = $rangePriceArray[0];
    $maxValue = $rangePriceArray[1];

    // Read The JSON Data
    $arrayRealEstate = readRealEstate();
    // Get the size of the original array
    $length = sizeof($arrayRealEstate);
    $array_output = array();
    $counter = 0;

    // Check the array
    for ($i=0; $i<$length; $i++){
      //print $arrayRealEstate[$i][$filter]."<br>";
      // For prices should remove '$' and ',' character in prices
      $valuePrice = str_replace('$', '', $arrayRealEstate[$i]['Precio']);
      $valuePriceProcess = str_replace(',', '', $valuePrice);
      //$valuePrice = str_replace(',', '', $minValue);

      //echo $i." Tipo:".$arrayRealEstate[$i]['Tipo']." Min: ".$minValue." Max: ".$maxValue."<br>";

      if($cityId == "none" && $tipoId !="none"){
          // Filter only by Tipo and Range value
          if($arrayRealEstate[$i]['Tipo'] == $tipo
              && ((int)$valuePriceProcess >= (int)$minValue) && (int)$valuePriceProcess <= (int)$maxValue)
              {
                // For testing purposes
                //echo (int)$valuePriceProcess.">=".(int)$minValue."&&".(int)$valuePriceProcess."<=".(int)$minValue."<br>";
                //echo $i." Tipo: ".$arrayRealEstate[$i]['Tipo']." Ciudad: ".$arrayRealEstate[$i]['Ciudad']." Direccion: ".$arrayRealEstate[$i]['Direccion']." Price: ".$arrayRealEstate[$i]['Precio']."<br>";
                $myObj = array('Id' => $counter + 1,
                              'Direccion' => $arrayRealEstate[$i]['Direccion'],
                              'Ciudad' => $arrayRealEstate[$i]['Ciudad'],
                              'Telefono' => $arrayRealEstate[$i]['Telefono'],
                              'Codigo_Postal' => $arrayRealEstate[$i]['Codigo_Postal'],
                              'Tipo' => $arrayRealEstate[$i]['Tipo'],
                              'Precio' => $arrayRealEstate[$i]['Precio']);

                array_push($array_output,$myObj);
                $counter++;
              }
      }

      if($cityId != "none" && $tipoId =="none"){
          // Filter only by City and Range value
          if($arrayRealEstate[$i]['Ciudad'] == $city
            && ((int)$valuePriceProcess >= (int)$minValue) && (int)$valuePriceProcess <= (int)$maxValue)
            {
              // For testing purposes
              //echo (int)$valuePriceProcess.">=".(int)$minValue."&&".(int)$valuePriceProcess."<=".(int)$minValue."<br>";
              //echo $i." Tipo: ".$arrayRealEstate[$i]['Tipo']." Ciudad: ".$arrayRealEstate[$i]['Ciudad']." Direccion: ".$arrayRealEstate[$i]['Direccion']." Price: ".$arrayRealEstate[$i]['Precio']."<br>";
              $myObj = array('Id' => $counter + 1,
                            'Direccion' => $arrayRealEstate[$i]['Direccion'],
                            'Ciudad' => $arrayRealEstate[$i]['Ciudad'],
                            'Telefono' => $arrayRealEstate[$i]['Telefono'],
                            'Codigo_Postal' => $arrayRealEstate[$i]['Codigo_Postal'],
                            'Tipo' => $arrayRealEstate[$i]['Tipo'],
                            'Precio' => $arrayRealEstate[$i]['Precio']);

              array_push($array_output,$myObj);

              $counter++;
            }
      }

      if($cityId == "none" && $tipoId =="none"){
          // Filter only by Range value
          if ((int)$valuePriceProcess >= (int)$minValue && (int)$valuePriceProcess <= (int)$maxValue)
            {
              // For testing purposes
              //echo (int)$valuePriceProcess.">=".(int)$minValue."&&".(int)$valuePriceProcess."<=".(int)$minValue."<br>";
              //echo $i." Tipo: ".$arrayRealEstate[$i]['Tipo']." Ciudad: ".$arrayRealEstate[$i]['Ciudad']." Direccion: ".$arrayRealEstate[$i]['Direccion']." Price: ".$arrayRealEstate[$i]['Precio']."<br>";
              $myObj = array('Id' => $counter + 1,
                            'Direccion' => $arrayRealEstate[$i]['Direccion'],
                            'Ciudad' => $arrayRealEstate[$i]['Ciudad'],
                            'Telefono' => $arrayRealEstate[$i]['Telefono'],
                            'Codigo_Postal' => $arrayRealEstate[$i]['Codigo_Postal'],
                            'Tipo' => $arrayRealEstate[$i]['Tipo'],
                            'Precio' => $arrayRealEstate[$i]['Precio']);



              array_push($array_output,$myObj);
              $counter++;
            }
      }

      // If the values aren't none then use the 3 filters
      if($cityId != "none" && $tipoId !="none"){
        if($arrayRealEstate[$i]['Tipo'] == $tipo
            && $arrayRealEstate[$i]['Ciudad'] == $city
            && ((int)$valuePriceProcess >= (int)$minValue) && (int)$valuePriceProcess <= (int)$maxValue)
            {
              // For testing purposes
              //echo (int)$valuePriceProcess.">=".(int)$minValue."&&".(int)$valuePriceProcess."<=".(int)$minValue."<br>";
              //echo $i." Tipo: ".$arrayRealEstate[$i]['Tipo']." Ciudad: ".$arrayRealEstate[$i]['Ciudad']." Direccion: ".$arrayRealEstate[$i]['Direccion']." Price: ".$arrayRealEstate[$i]['Precio']."<br>";

              array_push($array_output,array(
                                       'Id' => $counter + 1,
                                       'Direccion' => $arrayRealEstate[$i]['Direccion'],
                                       'Ciudad' => $arrayRealEstate[$i]['Ciudad'],
                                       'Telefono' => $arrayRealEstate[$i]['Telefono'],
                                       'Codigo_Postal' => $arrayRealEstate[$i]['Codigo_Postal'],
                                       'Tipo' => $arrayRealEstate[$i]['Tipo'],
                                       'Precio' => $arrayRealEstate[$i]['Precio']));
              $counter++;
            }
      }
    }

    return json_encode($array_output);
    //return $array_output;
  }



  // Testing functions
  //get_filter_list("Ciudad");
  //$array = show_by_filters('Miami','none', 'Casa','none','25000;100000');
  //echo sizeof($array)."<br><br>";
  //echo json_encode($array);
  //echo $array[0]['Id']."<br>";
  //echo $array[0]['Tipo']."<br>";
  //echo $array[0]['Ciudad']."<br>";
  //echo $array[0]['Telefono']."<br>";
  //echo $array[0]['Codigo_Postal']."<br>";
  //echo $array[0]['Direccion']."<br>";
  //echo $array[0]['Precio']."<br>";

 ?>
