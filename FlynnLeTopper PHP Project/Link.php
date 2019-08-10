      <!--
File: php,  Link.php
Author: Ian Topper
Date: 3/11/2019
-->
  <?php

function dbConnect(){
    $serverName = 'buscissql1601\cisweb';
    $uName = 'project';
    $pWord = 'assist';
    $db = 'Team116DB';   
      //PDO object, set connection  
    try{     
        $conn = new PDO("sqlsrv:Server=$serverName; Database=$db", $uName, 
                $pWord, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));          
    }   
    catch (PDOException $e){
        die('Connection failed: ' . $e->getMessage());
    }    
        return $conn;
}

function executeQuery($query){
    $conn = dbConnect();
      // execute query,assign results to PDOStatement object
    try{
        $stmt = $conn->query($query);
        //retreive the rows
        if ($stmt->columnCount() > 0){
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  
            }
        dbDisconnect($conn);
        return $results;
    }
    catch (PDOException $e)
    {
        dbDisconnect($conn);
        die ('Query failed: ' . $e->getMessage());
    }
}

function dbDisconnect($conn){
    // close connection
    $conn = null;
}
        ?> 
