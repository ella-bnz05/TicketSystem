<?php

function OpenCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "ticketingsystem";
    $conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
    return $conn;
}

function CloseCon($conn){
    $conn->close();
}
?>