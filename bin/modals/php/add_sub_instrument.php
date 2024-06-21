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

if(isset($_POST['add_sub_param_code']) && isset($_POST['add_sub_param_desc'])){

        $user = "Dhen";
        
        $time_zone = $_POST['add_timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $add_sub_ins_id = $_POST['add_sub_ins_id'];
        $add_sub_ins_cat = $_POST['add_sub_ins_cat'];
        $add_sub_param_code = strtoupper(pg_escape_string($_POST['add_sub_param_code']));
        $add_sub_param_desc = pg_escape_string($_POST['add_sub_param_desc']);
        $ins_param_code = pg_escape_string($_POST['ins_param_code']);

        if(!empty($_POST['add_sub_param_code'])){

            $check_ins = "SELECT * FROM accsys.maintenance_area_instrument_sub WHERE sub_code = '".$ins_param_code."".$add_sub_param_code."'";
            $check_result = pg_query($connection, $check_ins);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_area_instrument_sub (area_category, sub_code, description, trail, instrument_code)
                VALUES ('$add_sub_ins_cat', '".$ins_param_code."".$add_sub_param_code."', '$add_sub_param_desc', '--Added-- $user | $time_zone: $date_time | $ip', '$add_sub_ins_id') RETURNING keyctr";
                
                $result = pg_query($connection, $query);
                $last_id = pg_fetch_result($result, 0);
    
                if (pg_affected_rows($result) > 0){

                    $check_docs = "SELECT * FROM accsys.maintenance_area_instrument_docs WHERE instrument_keyctr = '$add_sub_ins_id'";
                    $check_docs_r = pg_query($connection, $check_docs);
    
                    if(pg_num_rows($check_docs_r) > 0){
                        while($docs=pg_fetch_row($check_docs_r)){
                            $insert_doc = "INSERT INTO accsys.maintenance_area_instrument_sub_docs (instrument_sub_keyctr, scode, offccode, trail)
                            VALUES ('$last_id','$docs[2]', '$docs[3]', '--Added-- $user | $time_zone: $date_time | $ip')";
                            $insert_doc_r = pg_query($connection, $insert_doc);
                        }
                    }   
                    $response['status'] = 1;
                }
                else{
                    $response['status'] = 3;
                }
            } 
        }
        else{
            $response['status'] = 0;  
        }
}

echo json_encode($response);
?>