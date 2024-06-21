<?php

include_once '../../../connection/db_connect.php';

    if(isset($_POST['display'])){

        $area_id = $_POST['area_id'];
        $param_id = $_POST['param_id'];

        $get_cat = "SELECT * FROM accsys.maintenance_parameter_category ORDER BY order_num ASC";
        $get_cat_result = pg_query($connection, $get_cat);

        if(pg_num_rows($get_cat_result) > 0){
            while($category=pg_fetch_row($get_cat_result)){

                $query = "SELECT * FROM accsys.maintenance_area_instrument WHERE area_code = '$area_id' AND area_param = '$param_id' AND area_category = '$category[0]'
                ORDER BY keyctr ASC";
                $result = pg_query($connection, $query);
?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $category[1];?></h6>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Document(s)</th>
                                                    <th>Source(s)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Document(s)</th>
                                                    <th>Source(s)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
<?php
                             if(pg_num_rows($result) > 0){
                                while($instrument=pg_fetch_row($result)){
                                        $get_docs = "SELECT accsys.maintenance_supporting_docs.support_document
                                        FROM accsys.maintenance_supporting_docs
                                        INNER JOIN accsys.maintenance_area_instrument_docs
                                        ON accsys.maintenance_supporting_docs.scode = accsys.maintenance_area_instrument_docs.scode
                                        WHERE accsys.maintenance_area_instrument_docs.instrument_keyctr = '$instrument[0]'";
                                        $get_docs_result = pg_query($connection, $get_docs);

                                        $get_off = "SELECT accsys.maintenance_get_docs.office
                                        FROM accsys.maintenance_get_docs
                                        INNER JOIN accsys.maintenance_area_instrument_docs
                                        ON accsys.maintenance_area_instrument_docs.offccode = accsys.maintenance_get_docs.offccode
                                        WHERE accsys.maintenance_area_instrument_docs.instrument_keyctr = '$instrument[0]'";
                                        $get_off_result = pg_query($connection, $get_off);
?>          
                                            <tr>
                                                <td><?php echo $instrument[4];?> <?php echo $instrument[5];?></td>
                                                <td>
                                                    <ul>
<?php
                                            if(pg_num_rows($get_docs_result) > 0){
                                                while($docs=pg_fetch_row($get_docs_result)){                                                        
?>
                                                        <li><?php echo $docs[0];?></li>
<?php
                                                }
                                            }
                                            else{
                                                echo "No supporting document(s) found.";
                                            }    
?>
                                                    </ul> 
                                                </td>
                                                <td>
                                                    <ul>
<?php
                                            if(pg_num_rows($get_off_result) > 0){
                                                while($office=pg_fetch_row($get_off_result)){ 
?>
                                                        <li><?php echo $office[0];?></li>
<?php
                                                }
                                             }
                                             else{
                                                echo "No source(s) found.";
                                             }
?>
                                                    </ul> 
                                                </td>
                                                <td style="width: 10%;">
                                                    <button class="btn btn-primary w-100 mt-2"  id="doc_btn" data-id="<?php echo $instrument[0];?>">
                                                        <span class="icon text-white-100">
                                                            <i class="fas fa-list"></i>
                                                        </span>
                                                    </button>
                                                    <button class="btn btn-info w-100 mt-2"  id="edit_btn" data-id="<?php echo $instrument[0];?>" param-id="<?php echo $param_id;?>">
                                                        <span class="icon text-white-100">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                    </button>
                                                    <button class="btn btn-danger w-100 my-2"  id="delete_btn" data-id="<?php echo $instrument[0];?>">
                                                        <span class="icon text-white-100">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </button>
<?php
                                        $check_sub = "SELECT * FROM accsys.maintenance_area_instrument WHERE sub_instrument = 'true' AND keyctr = $instrument[0]";
                                        $check_sub_result = pg_query($connection, $check_sub);
?>
                                                <label class="switch parsub ins">
                                                    <input type="checkbox" value="<?php echo $instrument[0];?>" class="default" id="switch_sub"
<?php
                                        if(pg_num_rows($check_sub_result) > 0){
                                            echo "checked";
                                        }
                                        else{  
                                            echo "";
                                        }
?>
                                                        >
                                                        <span class="slider round parsub ins"></span>
                                                    </label>
                                                </td>
                                            </tr>
<?php
                                        $get_sub_ins_query = "SELECT * FROM accsys.maintenance_area_instrument_sub WHERE instrument_code = '$instrument[0]'";
                                        $get_sub_ins_result = pg_query($connection, $get_sub_ins_query);

                                        if(pg_num_rows($get_sub_ins_result) > 0){
                                            while($sub=pg_fetch_row($get_sub_ins_result)){

                                                $sub_get_docs = "SELECT accsys.maintenance_supporting_docs.support_document
                                                FROM accsys.maintenance_supporting_docs
                                                INNER JOIN accsys.maintenance_area_instrument_sub_docs
                                                ON accsys.maintenance_supporting_docs.scode = accsys.maintenance_area_instrument_sub_docs.scode
                                                WHERE accsys.maintenance_area_instrument_sub_docs.instrument_sub_keyctr = '$sub[0]'";
                                                $get_sub_docs_result = pg_query($connection, $sub_get_docs);
        
                                                $get_sub_off = "SELECT accsys.maintenance_get_docs.office
                                                FROM accsys.maintenance_get_docs
                                                INNER JOIN accsys.maintenance_area_instrument_sub_docs
                                                ON accsys.maintenance_area_instrument_sub_docs.offccode = accsys.maintenance_get_docs.offccode
                                                WHERE accsys.maintenance_area_instrument_sub_docs.instrument_sub_keyctr = '$sub[0]'";
                                                $get_sub_off_result = pg_query($connection, $get_sub_off);

?>
                                                <tr>
                                                    <td><?php echo $sub[2];?> <?php echo $sub[3];?></td>
                                                    <td>
                                                        <ul>
<?php
                                                if(pg_num_rows($get_sub_docs_result) > 0){
                                                    while($sub_docs=pg_fetch_row($get_sub_docs_result)){                                                        
?>
                                                        <li><?php echo $sub_docs[0];?></li>
<?php
                                                    }
                                                }
                                                else{
                                                    echo "No supporting document(s) found.";
                                                }    
?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
<?php
                                                if(pg_num_rows($get_sub_off_result) > 0){
                                                    while($sub_office=pg_fetch_row($get_sub_off_result)){ 
?>
                                                        <li><?php echo $sub_office[0];?></li>
<?php
                                                    }
                                                }
                                                else{
                                                    echo "No source(s) found.";
                                                }
?>
                                                        </ul>
                                                    </td>
                                                    <td style="width: 10%;">
                                                        <button class="btn btn-primary w-100 mt-2"  id="sub_doc_btn" data-id="<?php echo $sub[0];?>">
                                                            <span class="icon text-white-100">
                                                                <i class="fas fa-list"></i>
                                                            </span>
                                                        </button>
                                                        <button class="btn btn-info w-100 mt-2"  id="sub_edit_btn" data-id="<?php echo $sub[0];?>">
                                                            <span class="icon text-white-100">
                                                                <i class="fas fa-pen"></i>
                                                            </span>
                                                        </button>
                                                        <button class="btn btn-danger w-100 my-2"  id="sub_delete_btn" data-id="<?php echo $sub[0];?>">
                                                            <span class="icon text-white-100">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>                                     
<?php
                                            }
                                        }
                                        else{
                                            echo "";
                                        }

                                        if(pg_num_rows($check_sub_result) > 0){
?>
                                            <tr>
                                                <td class="py-0 ins_sub" colspan="4" id="add_sub_param" data-id = "<?php echo $instrument[0];?>" cat-id = "<?php echo $instrument[3];?>" param-code = "<?php echo $instrument[4];?>">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Insert sub
                                                </td>
                                            </tr>
<?php
                                        }
                                        else{
                                            echo "";
                                        }
                                }
                            }
                            else{
                                echo '<td colspan="4"><p>No instrument(s) found.</p></td>';
                            }
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php

            }
        }
        else{
            echo "No Data(s) found.";
        }

    }

?>