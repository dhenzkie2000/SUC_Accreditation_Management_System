<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['ass_id'])){
    $ass_id = $_POST['ass_id'];
    $query = "DELETE FROM accsys.get_docs_office_setup WHERE keyctr ='$ass_id'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>