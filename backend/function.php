<?php

include '../backend/dbconnect.php';

function select($data, $parm=""){
    $conn = OpenCon();
    $sql = "SELECT * FROM `$data`$parm";
    $result = $conn->query($sql);
    CloseCon($conn);
    
    return $result; 
}

function joinData($sql){
    $conn = OpenCon();
    $result = $conn->query($sql);
    CloseCon($conn);
    
    return $result; 
}

function sumData($sql){
    $conn = OpenCon();
    $result = $conn->query($sql);
    CloseCon($conn);
    
    return $result; 
}

?>