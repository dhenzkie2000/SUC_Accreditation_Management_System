<?php

include_once '../../../connection/db_connect.php';

$response = array(
    'status' => 0,
);

if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
    $ip=$_SERVER['REMOTE_ADDR'];
}

if(isset($_POST['sub_office']) || isset($_POST['sub_support_doc'])){

    $user = "Dhen";  
    $time_zone = $_POST['add_sub_doc_timezone'];
    $set_zone = date_default_timezone_set($time_zone);
    $date_time = date('M-d-Y h:i:s a', time());

    $checked_array=$_POST['sub_support_doc'];
    $ins_id = $_POST['add_sub_doc_ins_id'];

        foreach($_POST['sub_support_doc_name'] as $key => $value)
        {
            if(in_array($_POST['sub_support_doc_name'][$key], $checked_array)){
                
                $support_doc_name = $_POST['sub_support_doc_name'][$key];
                $office = $_POST['sub_office'][$key];

                $get_info = "SELECT * FROM accsys.get_docs_office_setup WHERE keyctr = '$support_doc_name'";
                $get_info_r = pg_query($connection, $get_info);
                $info=pg_fetch_row($get_info_r);
              
                $query = "INSERT INTO accsys.maintenance_area_instrument_sub_docs (instrument_sub_keyctr, scode, offccode, trail)
                        VALUES ('$ins_id','$info[1]', '$office', '--Added-- $user | $time_zone: $date_time | $ip')";
                
                $result = pg_query($connection, $query);
    
                if (pg_affected_rows($result) > 0){
                    $response['status'] = 1;
                }
                else{
                    $response['status'] = 2;
                }
            }
        }
   
}

echo json_encode($response);

?>