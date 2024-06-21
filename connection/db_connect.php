<?php
    $connection = pg_connect("host=el101finalrequirement.postgres.database.azure.com port=5432 dbname=ACCSYS user=el101 password=sucaccreditation@2024");
    
    if(!$connection){
        echo "Error";
        exit;
    }
?>