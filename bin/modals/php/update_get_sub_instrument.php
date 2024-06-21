<?php
include_once '../../../connection/db_connect.php';

$data=array();

if($_POST['trig'] == '1'){
    
    $ins_id = $_POST['ins_id'];

    $query = "SELECT sub_code, description FROM accsys.maintenance_area_instrument_sub WHERE keyctr = '$ins_id'";
    $result = pg_query($connection, $query);
    while($row = pg_fetch_assoc($result)){
        $data=$row;
    }
}

echo json_encode($data);
?>