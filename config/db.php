<?php 

    $host='localhost';
    $dbname='hornbill-blog';
    $dbuser='root';
    $dbpassword='';

    $db = new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$dbpassword);
    if(!$db){
        echo "Database connection fail";
    }