<?php
include_once '../../../connection/db_connect.php';

$data=array();

if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
    $ip=$_SERVER['REMOTE_ADDR'];
}

if($_POST['trig'] == '1'){
    
    $doc_code = $_POST['doc_code'];

    $query = "SELECT scode, support_document FROM accsys.maintenance_supporting_docs WHERE scode = '$doc_code'";
    $result = pg_query($connection, $query);
    while($row = pg_fetch_assoc($result)){
        $data=$row;
    }
}

if($_POST['trig'] == '2'){

    if(!empty($_POST['up_doc_code']) || !empty($_POST['up_doc_sup'])){

        $up_doc_code = $_POST['up_doc_code'];
        $up_doc_sup = pg_escape_string($_POST['up_doc_sup']);
        $up_doc_id = $_POST['up_doc_id'];

        $check_query = "SELECT * FROM accsys.maintenance_supporting_docs WHERE scode = '$up_doc_code'";
        $check_result = pg_query($connection, $check_query);

        if(pg_num_rows($check_result) > 0){
            $data['status'] = 2;
        }
        else{
            
            $user = "Dhen";
            $time_zone = $_POST['up_timezone'];
            $set_zone = date_default_timezone_set($time_zone);
            $date_time = date('M-d-Y h:i:s a', time());

            $up_query = "UPDATE accsys.maintenance_supporting_docs
            SET
            scode = '$up_doc_code',
            support_document = '$up_doc_sup',
            trail = '--Updated-- $user | $time_zone: $date_time | $ip'
            WHERE scode = '$up_doc_id'";

            $up_result = pg_query($connection, $up_query);

            if(pg_affected_rows($up_result) > 0){
                $data['status'] = 1;
            }
            else{
                $data['status'] = 3;
            }
        }

    }
    else{
        $data['status'] = 0;
    }
}

echo json_encode($data);
?>