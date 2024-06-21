<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['area_id'])){
    $area_id = $_POST['area_id'];
    $query = "DELETE FROM accsys.maintenance_area WHERE keyctr = $area_id";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>