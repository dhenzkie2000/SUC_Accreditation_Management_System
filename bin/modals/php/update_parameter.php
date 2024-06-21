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
        
        $param_id = $_POST['param_id'];
    
        $query = "SELECT * FROM accsys.maintenance_area_parameter WHERE param_code = '$param_id'";
        $result = pg_query($connection, $query);
        while($row = pg_fetch_assoc($result)){
            $data=$row;
        }
    }
    
    if($_POST['trig'] == '2'){
    
        if(!empty($_POST['up_param_code']) || !empty($_POST['up_param_def'])){
    
            $up_param_code = $_POST['up_param_code'];
            $up_param_def = pg_escape_string($_POST['up_param_def']);
            $up_param_desc = pg_escape_string($_POST['up_param_desc']);
            $up_param_area_id = $_POST['up_param_area_id'];
            $up_param_id = $_POST['up_param_id'];

            $user = "Dhen";
            $time_zone = $_POST['up_timezone'];
            $set_zone = date_default_timezone_set($time_zone);
            $date_time = date('M-d-Y h:i:s a', time());

            if($up_param_id == $up_param_code){
                
                $up_query = "UPDATE accsys.maintenance_area_parameter
                SET
                param_code = '".$up_param_area_id."".$up_param_code."',
                area_code = '$up_param_area_id',
                short_def = '$up_param_def',
                description = '$up_param_desc',
                trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                WHERE param_code = '$up_param_id'";
    
                $up_result = pg_query($connection, $up_query);
    
                if(pg_affected_rows($up_result) > 0){
                    $data['status'] = 1;
                }
                else{
                    $data['status'] = 3;
                }
            }
            else{

                $check_query = "SELECT * FROM accsys.maintenance_area_parameter WHERE param_code = '$up_param_code'";
                $check_result = pg_query($connection, $check_query);
        
                if(pg_num_rows($check_result) > 0){
                    $data['status'] = 2;
                }
                else{
        
                    $up_query = "UPDATE accsys.maintenance_area_parameter
                    SET
                    param_code = '".$up_param_area_id."".$up_param_code."',
                    area_code = '$up_param_area_id',
                    short_def = '$up_param_def',
                    description = '$up_param_desc',
                    trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                    WHERE param_code = '$up_param_id'";
        
                    $up_result = pg_query($connection, $up_query);
        
                    if(pg_affected_rows($up_result) > 0){
                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 3;
                    }
                }

            }
        }
        else{
            $data['status'] = 0;
        }
    }
    
    echo json_encode($data);
?>