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

if(isset($_POST['up_ins_id'])){

    if(!empty($_POST['up_param_code']) || !empty($_POST['up_param_desc'])){
        
        $up_old_param_code = $_POST['up_old_param_code'];

        $up_ins_id = $_POST['up_ins_id'];
        $up_param_code = pg_escape_string($_POST['up_param_code']);
        $up_param_desc = pg_escape_string($_POST['up_param_desc']);

        $user = "Dhen";
        $time_zone = $_POST['up_timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());

        if(!isset($_POST['support_doc'])){
            if($up_param_code != $up_old_param_code){

                $check_query = "SELECT * FROM accsys.maintenance_area_instrument_sub WHERE sub_code = '$up_param_code'";
                $check_result = pg_query($connection, $check_query);

                if(pg_num_rows($check_result) > 0){
                    $data['status'] = 2;
                }
                else{
                    $up_query = "UPDATE accsys.maintenance_area_instrument_sub
                    SET
                    sub_code = '$up_param_code',
                    description = '$up_param_desc',
                    trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                    WHERE keyctr = '$up_ins_id'";

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

                $up_query = "UPDATE accsys.maintenance_area_instrument_sub
                SET
                sub_code = '$up_param_code',
                description = '$up_param_desc',
                trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                WHERE keyctr = '$up_ins_id'";

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

            $checked_array=$_POST['support_doc'];

            if($up_param_code != $up_old_param_code){

                $check_query = "SELECT * FROM accsys.maintenance_area_instrument_sub WHERE sub_code = '$up_param_code'";
                $check_result = pg_query($connection, $check_query);

                if(pg_num_rows($check_result) > 0){
                    $data['status'] = 2;
                }
                else{
                    $up_query = "UPDATE accsys.maintenance_area_instrument_sub
                    SET
                    sub_code = '$up_param_code',
                    description = '$up_param_desc',
                    trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                    WHERE keyctr = '$up_ins_id'";

                    $up_result = pg_query($connection, $up_query);

                    if(pg_affected_rows($up_result) > 0){

                        foreach($_POST['support_doc_name'] as $key => $value)
                        {
                            if(in_array($_POST['support_doc_name'][$key], $checked_array)){
                                
                                $support_doc_name = $_POST['support_doc_name'][$key];
                                $office = $_POST['office'][$key];
                
                                $get_info = "SELECT * FROM accsys.get_docs_office_setup WHERE keyctr = '$support_doc_name'";
                                $get_info_r = pg_query($connection, $get_info);
                                $info=pg_fetch_row($get_info_r);
                              
                                $query = "INSERT INTO accsys.maintenance_area_instrument_sub_docs (instrument_sub_keyctr, scode, offccode, trail)
                                        VALUES ('$up_ins_id','$info[1]', '$office', '--Added-- $user | $time_zone: $date_time | $ip')";                   
                                $result = pg_query($connection, $query);
                            }
                        }

                        $data['status'] = 1;
                    }
                    else{
                        $data['status'] = 3;
                    }
                }
            }
            else{
                $up_query = "UPDATE accsys.maintenance_area_instrument_sub
                SET
                sub_code = '$up_param_code',
                description = '$up_param_desc',
                trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                WHERE keyctr = '$up_ins_id'";

                $up_result = pg_query($connection, $up_query);

                if(pg_affected_rows($up_result) > 0){

                    foreach($_POST['support_doc_name'] as $key => $value)
                    {
                        if(in_array($_POST['support_doc_name'][$key], $checked_array)){
                            
                            $support_doc_name = $_POST['support_doc_name'][$key];
                            $office = $_POST['office'][$key];
            
                            $get_info = "SELECT * FROM accsys.get_docs_office_setup WHERE keyctr = '$support_doc_name'";
                            $get_info_r = pg_query($connection, $get_info);
                            $info=pg_fetch_row($get_info_r);
                          
                            $query = "INSERT INTO accsys.maintenance_area_instrument_sub_docs (instrument_sub_keyctr, scode, offccode, trail)
                                    VALUES ('$up_ins_id','$info[1]', '$office', '--Added-- $user | $time_zone: $date_time | $ip')";                   
                            $result = pg_query($connection, $query);
                        }
                    }

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