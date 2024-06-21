<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['param_id'])){
    $param_id = $_POST['param_id'];
    $query = "DELETE FROM accsys.maintenance_area_parameter WHERE param_code ='$param_id'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>