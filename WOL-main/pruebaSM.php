<?php
// errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Fin
//Conexión
require ".db/dbs.php";



//CAMBIAR
  $query = "select FLAG FROM DBTEST.BITACORA_PRUEBA WHERE (extract(day from FECHA_INSERT) = DAY( current_date()));";
  $select1 = $db->query($query);

  //solicita fecha para insertar
  $queryAyer = "SELECT * FROM DBTEST.`fechaHoy-1`;";
  $fechaAyer = $db->query($queryAyer);

  while($row = $select1->fetch_assoc()) {
      $flagToDay = $row['FLAG'];
    }
    if(!isset($flagToDay)){
      $flagToDay = 'Variable name is not set';
    } 
    if ($flagToDay > 0){
      $flagToDayTrue = true;
    }else{
      $flagToDayTrue = false;
    }


  if($flagToDayTrue != true){
    $StartDay = $fechaAyer;
    $EndDay = $fechaAyer;
    // Lectura de apis



//CAMBIAR
    $url =  "https://api.supermetrics.com/enterprise/v2/query/data/json?json=%7B%22ds_id%22%3A%22FA%22%2C%22ds_accounts%22%3A%22list.all_accounts%22%2C%22ds_user%22%3A%22135849212472962%22%2C%22start_date%22%3A%22".$StartDay."%22%2C%22end_date%22%3A%22".$EndDay."%22%2C%22fields%22%3A%22profile%2Cadcampaign_name%2Ccampaign_start_date%2Ccampaign_end_date%2Ccampaignstatus%2Ccampaignobjective%2Ccampaignbuyingtype%2Ccampaign_daily_budget%2Ccampaign_lifetime_budget%2Ccampaign_budget_remaining%2Ccampaign_start_time%2Ccampaign_end_time%2Cadset_name%2CDate%2Creach%2CFrequency%2Cimpressions%2CSocialReach%2Cactionvalue%2CROAS%2Ccost_per_lead_form%2Ccost_per_store_visit%2Ccost%2Ccost_usd%2CCPP%2CCPM%2CCPA%2Coutbound_clicks%2Caction_link_click%2Coutbound_CTR%2CCPOC%2Caction_like%2Cnew_messaging_conversations%2Ccost_per_new_messaging_conversation%2Cvideo_15_sec_watched_actions%2Cvideo_p75_watched_actions%2Ccost_per_thruplay%2Cestimated_ad_recall_rate%2Caction_app_install%2Caction_app_use%2Ccost_per_app_install%2Comni_add_to_cart_shared_item%2Comni_purchase_shared_item%2Caction_post_engagement%2CActions%2Caction_video_view%2Coffsite_conversions_fb_pixel_lead%2Coffsite_conversions_fb_pixel_purchase%2Coffsite_conversions_fb_pixel_add_to_cart%2Caction_mobile_app_install%2Consite_conversion.lead_grouped%2Cvideo_p100_watched_actions%22%2C%22settings%22%3A%7B%22blanks_to_zero%22%3Atrue%2C%22action_report_time%22%3A%22conversion%22%2C%22allow_sum_unique%22%3Atrue%7D%2C%22max_rows%22%3A1000000%2C%22api_key%22%3A%22api_6Zu872pqQTdMha8EG9t1_q3OLImELChXyMwTpl5HYyl_IOQEtVnWv8GFmRML4vTGjlDe_dBkRh0P9A9R2hYlYqwxCCVHoyj04K%22%7D";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      
    $resp = curl_exec($curl);
    curl_close($curl);
    $jsomp =  json_decode ($resp, true);
    $json_pretty = json_encode($jsomp, JSON_PRETTY_PRINT);


  //  Datos del User
  $mi_ip = $_SERVER["REMOTE_ADDR"];
  $mi_host = $_SERVER["HTTP_HOST"];
  


//CAMBIAR
    //Crea el archivo JSON
    $myfile = fopen("FB_DIARIO_CAMPANA.json", "w") or die("Error archivo");
    $txt = $json_pretty;
    fwrite($myfile, $txt);
    fclose($myfile);


//CAMBIAR
    //Leemos el archivo creado
    $JsonParser = file_get_contents("FB_DIARIO_CAMPANA.json");
    $jsomp2 =  json_decode ($JsonParser, true);
    $valorMax = count($jsomp2["data"], COUNT_RECURSIVE);
    $valorMaximoJson = (count($jsomp2["data"]));
    $valorNetoTotal = $valorMaximoJson - 2;
    var_dump($valorNetoTotal);
    echo "Fecha insertada".$EndDay;

    $id_1 = 0;


  //CAMBIAR    
    //inserta bandera en bitacora
            //Conección
            $servername = "dbwol.crgpm7pxclx2.us-east-2.rds.amazonaws.com";
            $database = "DBTEST";
            $username = "autuser";
            $password = "Pinoccio..11";
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);



//CAMBIAR

    $insert_bitacora = "INSERT INTO `DBTEST`.`BITACORA_PRUEBA` (`FLAG`, `FB_DIARIO_CAMPANA_JSON`) VALUES ('1', 'FB_DIARIO_CAMPANA');";
    if (mysqli_query($conn, $insert_bitacora)){
      echo "<br>"; echo "New record created successfully SM".$id_1;
      } else {
      echo "Error: " . $insert_bitacora . "<br>" . mysqli_error($conn);
      }
  //Fin inserta bandera en bitacora
    
    while($id_1 <= $valorNetoTotal){
      $id_1++;
      foreach ($jsomp2["data"][$id_1] as $value1) {
          $dato0=$jsomp2["data"][$id_1]["0"];
          $dato1=$jsomp2["data"][$id_1]["1"];
          $dato2=$jsomp2["data"][$id_1]["2"];
          $dato3=$jsomp2["data"][$id_1]["3"];
          $dato4=$jsomp2["data"][$id_1]["4"];
          $dato5=$jsomp2["data"][$id_1]["5"];
          $dato6=$jsomp2["data"][$id_1]["6"];
          $dato7=$jsomp2["data"][$id_1]["7"];
          $dato8=$jsomp2["data"][$id_1]["8"];
          $dato9=$jsomp2["data"][$id_1]["9"];
          //fotmato de fecha AAAA-MM-DDT00:00:00-0000 dato10 y dato11
          $dato10Fecha=$jsomp2["data"][$id_1]["10"];
          $dato10= date("Y-m-d H:i:s", strtotime($dato10Fecha));
          $dato11Fecha=$jsomp2["data"][$id_1]["11"];
          $dato11= date("Y-m-d H:i:s", strtotime($dato11Fecha));
          $dato12=$jsomp2["data"][$id_1]["12"];
          $dato13=$jsomp2["data"][$id_1]["13"];
          $dato14=$jsomp2["data"][$id_1]["14"];
          $dato15=$jsomp2["data"][$id_1]["15"];
          $dato16=$jsomp2["data"][$id_1]["16"];
          $dato17=$jsomp2["data"][$id_1]["17"];
          $dato18=$jsomp2["data"][$id_1]["18"];
          $dato19=$jsomp2["data"][$id_1]["19"];
          $dato20=$jsomp2["data"][$id_1]["20"];
          $dato21=$jsomp2["data"][$id_1]["21"];
          $dato22=$jsomp2["data"][$id_1]["22"];
          $dato23=$jsomp2["data"][$id_1]["23"];
          $dato24=$jsomp2["data"][$id_1]["24"];
          $dato25=$jsomp2["data"][$id_1]["25"];
          $dato26=$jsomp2["data"][$id_1]["26"];
          $dato27=$jsomp2["data"][$id_1]["27"];
          $dato28=$jsomp2["data"][$id_1]["28"];
          $dato29=$jsomp2["data"][$id_1]["29"];
          $dato30=$jsomp2["data"][$id_1]["30"];
          $dato31=$jsomp2["data"][$id_1]["31"];
          $dato32=$jsomp2["data"][$id_1]["32"];
          $dato33=$jsomp2["data"][$id_1]["33"];
          $dato34=$jsomp2["data"][$id_1]["34"];
          $dato35=$jsomp2["data"][$id_1]["35"];
          $dato36=$jsomp2["data"][$id_1]["36"];
          $dato37=$jsomp2["data"][$id_1]["37"];
          $dato38=$jsomp2["data"][$id_1]["38"];
          $dato39=$jsomp2["data"][$id_1]["39"];
          $dato40=$jsomp2["data"][$id_1]["40"];
          $dato41=$jsomp2["data"][$id_1]["41"];
          $dato42=$jsomp2["data"][$id_1]["42"];
          $dato43=$jsomp2["data"][$id_1]["43"];
          $dato44=$jsomp2["data"][$id_1]["44"];
          $dato45=$jsomp2["data"][$id_1]["45"];
          $dato46=$jsomp2["data"][$id_1]["46"];
          $dato47=$jsomp2["data"][$id_1]["47"];
          $dato48=$jsomp2["data"][$id_1]["48"];
          $dato49=$jsomp2["data"][$id_1]["49"];
          $dato50=$jsomp2["data"][$id_1]["50"];
          $dato51=$jsomp2["data"][$id_1]["51"];
      }

//CAMBIAR
       // INSERT DE LOS DATOS
        //Conección
        $servername = "dbwol.crgpm7pxclx2.us-east-2.rds.amazonaws.com";
        $database = "DBTEST";
        $username = "autuser";
        $password = "Pinoccio..11";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
        }
        //require './db.php';
        //echo "Connected successfully";


         $sql = " INSERT INTO `DBTEST`.`FB_CAMPANA` (`Account`, `Campaign name`, `Campaign start date`, `Campaign end date`, `Campaign status`,
           `Campaign objective`, `Campaign buying type`, `Campaign daily budget`, `Campaign lifetime budget`, `Campaign budget remaining`,
            `Campaign start time`, `Campaign end time`, `Ad set name`, `Date`, `Reach`, 
            `Frequency`, `Impressions`, `Social reach (deprecated)`, `Total action value`, `Return on ad spend (ROAS)`, 
            `Cost per lead (form)`, `Cost per store visit`, `Cost`, `Cost (USD)`, `Cost per 1000 people reached`, 
            `CPM (cost per 1000 impressions)`, `Cost per action (CPA)`, `Outbound clicks`, `Link clicks`, `Outbound CTR`, 
            `Cost per outbound click`, `Page likes`, `New messaging conversations`, `Cost per new messaging conversation`, `15-second video views (Deprecated)`, 
            `Video watches at 75%`, `Cost per ThruPlay`, `Estimated ad recall lift rate (%)`, `Desktop app installs`, `Desktop app uses`, 
            `Cost per app install`, `Omni adds to cart (shared item)`, `Omni purchase (shared item)`, `Post engagements`, `Actions`, 
            `Three-second video views`, `Website leads`, `Website purchases`, `Website adds to cart`, `Mobile app installs`, 
            `On-Facebook leads`, `Video watches at 100%`)
          VALUES ('$dato0' ,'$dato1' ,'$dato2' ,'$dato3' ,'$dato4' ,
          '$dato5'  ,'$dato6'   ,'$dato7'   ,'$dato8'   ,'$dato9'   ,'$dato10'  ,
          '$dato11' ,'$dato12'  ,'$dato13'  ,'$dato14'  ,'$dato15'  ,'$dato16'  ,
          '$dato17' ,'$dato18'  ,'$dato19'  ,'$dato20'  ,'$dato21'  ,'$dato22'  ,
          '$dato23' ,'$dato24'  ,'$dato25'  ,'$dato26'  ,'$dato27'  ,'$dato28'  ,
          '$dato29' ,'$dato30'  ,'$dato31'  ,'$dato32'  ,'$dato33'  ,'$dato34'  ,
          '$dato35' ,'$dato36'  ,'$dato37'  ,'$dato38'  ,'$dato39'  ,'$dato40'  ,
          '$dato41' ,'$dato42'  ,'$dato43'  ,'$dato44'  ,'$dato45'  ,'$dato46'  ,
          '$dato47' ,'$dato48', '$dato49','$dato50', '$dato51');";

          if (mysqli_query($conn, $sql)) {
            echo "<br>"; echo "New record created successfully SM".$id_1;
            echo "----".$dato10Fecha."__".$dato10;
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);

      // FIN DE INSERT DE LOS DATOS
    }

    
  }else{
    echo "Datos ya fueron ingresados hoy.";
  }

?>


