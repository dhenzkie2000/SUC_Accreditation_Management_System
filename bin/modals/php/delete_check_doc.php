<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['ins_id']) || isset($_POST['scode']) || isset($_POST['offccode'])){

    $scode = $_POST['scode'];
    $offccode = $_POST['offccode'];
    $ins_id = $_POST['ins_id'];

    $query = "DELETE FROM accsys.maintenance_area_instrument_docs WHERE instrument_keyctr ='$ins_id'
    AND scode = '$scode' AND offccode = '$offccode'";
    $result = pg_query($connection, $query);

}
?>