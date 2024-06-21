<?php
    $connection = pg_connect("host=localhost port=5432 dbname=ACCSYS user=postgres password=dhenzkie2000");
    
    if(!$connection){
        echo "Error";
        exit;
    }
?>