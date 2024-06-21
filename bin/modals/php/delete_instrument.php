<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['ins_id'])){
    $ins_id = $_POST['ins_id'];
    $query = "DELETE FROM accsys.maintenance_area_instrument WHERE keyctr ='$ins_id'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>