<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['doc_id'])){
    $doc_id = $_POST['doc_id'];
    $query = "DELETE FROM accsys.maintenance_supporting_docs WHERE scode ='$doc_id'";
    $result = pg_query($connection, $query);
    
    if (pg_affected_rows($result) > 0){
        echo '1';
    }
    else{
        echo '0';
    }
}
?>