<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['off_id'])){
    $off_id = $_POST['off_id'];
    $query = "DELETE FROM accsys.maintenance_get_docs WHERE offccode ='$off_id'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>