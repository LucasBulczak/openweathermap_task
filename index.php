<?php
session_start();
require_once './db/database.php';
require_once './helpers/WeatherInfo.php';


    if(isset($_POST['city'])) {
        $city = $_POST['city'];

        if(!empty($city)) {
            $weatherInfo = new WeatherInfo($city);
            $data = $weatherInfo->getWeatherInfo();
        }   
    }
    
    function saveDataToDatabase($db, $city){
        $query = $db->prepare('INSERT INTO info VALUES (NULL, :city, :dateFrom, :dateTo, :userIP)');
        $query->bindValue(':city', $city, PDO::PARAM_STR);
            
        $dateFrom = ( new DateTime() )->format('Y-m-d');
        $query->bindValue(':dateFrom', $dateFrom, PDO::PARAM_STR);
            
        $dateTo = date('Y-m-d', strtotime($dateFrom. ' + 5 days'));
        $query->bindValue(':dateTo', $dateTo, PDO::PARAM_STR);
            
        $userIP = $_SERVER['REMOTE_ADDR'];
        //uzupełnienie adresu localhost
        if ($userIP == '::1') {
            $userIP = '127.0.0.1';
        }
        $query->bindValue(':userIP', $userIP, PDO::PARAM_STR);
            
        $query->execute();        
    }
    function displayLast5RecordsFromDatabase($db) {
        //$query = $db->prepare('SELECT city FROM weather.info LIMIT 5');
        
        $query = $db->prepare('SELECT city FROM weather.info ORDER BY id DESC LIMIT 5');
        $query->execute();
        
        $result = $query->fetchAll();
        
        if(!empty($result)) {
            echo '<div class="recent"><p>Recently checked cities:</p>';
            echo '<ol>';
            foreach ($result as $row) {
                echo '<li>'.$row['city'].'</li>';
            }
            echo '</ol></div>';
        } else {
            echo '<div class="recent"><p>Recently checked cities:</p><br>'
            . 'There is no data to show.</div>';
        }
        
        
        
    }
    function displayData($data) {
        $currentDate = (new DateTime())->format('Y-m-d');
        
        $it = 0;
        echo '<table border="0" rules="none"><tr>';
        foreach($data as $item) {
            $itemTime = ( new DateTime($item->getDate()) )->format('Y-m-d');
            
            if($it<=5) {
                if ($currentDate != $itemTime) {
                    //echo '<td>'.$item.'</td>';
                //} else {
                    $it++;
                    $currentDate = $itemTime;
                    echo '</tr>';

                }
                echo '<td>'.$item.'</td>';
            }
        }
        echo '</table>';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      
  <style type="text/css">
      
      
  </style>
      -->
  </head>
  <body>
     <div class="container">
        <h1>Check the Weather in your city:</h1>
        <form method="post">
            City name: <br /> <input type="text" name="city" /> <br />
            <input type="submit" value="search" />
        </form>
        <div id="weather">
            <?php
                
                if (isset($_SESSION['e_json_response'])){
                    echo '<div class="error">'.$_SESSION['e_json_response'].'</div>';
                    unset($_SESSION['e_json_response']);
                }
            
                if(isset($data) ) {
                    if ($data!=null) {
                        //wpisanie do bazy danych
                    saveDataToDatabase($db, $city);
                    
                    $tableExists = $db->query("SHOW TABLES LIKE 'info'")->rowCount() > 0;
                    if ($tableExists)
                        displayLast5RecordsFromDatabase($db);
                    
                    displayData($data);
                    
                    }
                }
            ?>
        </div>
     </div> 
  </body>
</html>