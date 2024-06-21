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

if(isset($_POST['area_id']) && isset($_POST['param_id'])){

        $user = "Dhen";
        
        $time_zone = $_POST['timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $area_id = $_POST['area_id'];
        $param_id = $_POST['param_id'];
        $param_cat = $_POST['param_cat'];

        $param_sub = "";

        if(!isset($_POST['param_sub'])){
            $param_sub = "false";
        }
        else{
            $param_sub = "true";
        }

        $ins_code = strtoupper(pg_escape_string($_POST['ins_code']));
        $ins_desc = pg_escape_string($_POST['ins_desc']);

        if(!empty($_POST['ins_code'])){

            $check_ins = "SELECT * FROM accsys.maintenance_area_instrument WHERE code = '$ins_code' AND area_code = '$area_id'
            AND area_param = '$param_id' AND area_category = '$param_cat'";
            $check_result = pg_query($connection, $check_ins);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_area_instrument (area_code, area_param, area_category, code, description, sub_instrument, trail)
                VALUES ($area_id, '$param_id', '$param_cat', '$ins_code', '$ins_desc', '$param_sub', '--Added-- $user | $time_zone: $date_time | $ip')";
                
                $result = pg_query($connection, $query);
    
                if (pg_affected_rows($result) > 0){
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