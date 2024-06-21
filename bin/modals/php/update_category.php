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
    
    $cat_code = $_POST['cat_code'];

    $query = "SELECT cat_code, description, order_num FROM accsys.maintenance_parameter_category WHERE cat_code = '$cat_code'";
    $result = pg_query($connection, $query);
    while($row = pg_fetch_assoc($result)){
        $data=$row;
    }
}

if($_POST['trig'] == '2'){

    if(!empty($_POST['up_cat_code']) || !empty($_POST['up_cat_plac'])){

        $up_cat_code = strtoupper($_POST['up_cat_code']);
        $up_cat_desc = strtoupper(pg_escape_string($_POST['up_cat_desc']));
        $up_cat_plac = $_POST['up_cat_plac'];
        $up_cat_id = $_POST['up_cat_id'];
        $up_cat_num = $_POST['up_cat_num'];

        $user = "Dhen";
        $time_zone = $_POST['up_timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());

        if($up_cat_code == $up_cat_id){

            if($up_cat_num == $up_cat_plac){

                $up_query = "UPDATE accsys.maintenance_parameter_category
                SET
                cat_code = '$up_cat_code',
                description = '$up_cat_desc',
                trail = '--Updated-- $user | $time_zone: $date_time | $ip',
                order_num = $up_cat_plac
                WHERE cat_code = '$up_cat_id'";
    
                $up_result = pg_query($connection, $up_query);
    
                if(pg_affected_rows($up_result) > 0){
                    $data['status'] = 1;
                }
                else{
                    $data['status'] = 4;
                }

            }
            else{

                $placement = "SELECT * FROM accsys.maintenance_parameter_category WHERE order_num = $up_cat_plac";
                $plac_result = pg_query($connection, $placement);
    
                if(pg_num_rows($plac_result) > 0){
                    $data['status'] = 3;
                }
                else{
        
                    $up_query = "UPDATE accsys.maintenance_parameter_category
                    SET
                    cat_code = '$up_cat_code',
                    description = '$up_cat_desc',
                    trail = '--Updated-- $user | $time_zone: $date_time | $ip',
                    order_num = $up_cat_plac
                    WHERE cat_code = '$up_cat_id'";
        
                    $up_result = pg_query($connection, $up_query);
        
                    if(pg_affected_rows($up_result) > 0){
                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 4;
                    }
    
                }

            }
        }
        else{
            $check_cat = "SELECT * FROM accsys.maintenance_parameter_category WHERE cat_code = '$up_cat_code'";
            $check_result = pg_query($connection, $check_cat);

            if(pg_num_rows($check_result) > 0){
                $data['status'] = 2;
            }
            else{

                $placement = "SELECT * FROM accsys.maintenance_parameter_category WHERE order_num = $up_cat_plac";
                $plac_result = pg_query($connection, $placement);

                if(pg_num_rows($plac_result) > 0){
                    $data['status'] = 3;
                }
                else{
        
                    $up_query = "UPDATE accsys.maintenance_parameter_category
                    SET
                    cat_code = '$up_cat_code',
                    description = '$up_cat_desc',
                    trail = '--Updated-- $user | $time_zone: $date_time | $ip',
                    order_num = $up_cat_plac
                    WHERE cat_code = '$up_cat_id'";
        
                    $up_result = pg_query($connection, $up_query);
        
                    if(pg_affected_rows($up_result) > 0){
                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 4;
                    }

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