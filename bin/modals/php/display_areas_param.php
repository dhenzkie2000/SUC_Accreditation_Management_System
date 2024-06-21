<?php

include_once '../../../connection/db_connect.php';

    if(isset($_POST['display'])){

        $query = "SELECT * FROM accsys.maintenance_area ORDER BY keyctr ASC";
        $result = pg_query($connection, $query);

        if(pg_num_rows($result) > 0){
            while($area=pg_fetch_row($result)){
?>
                <div class="card mb-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between drop press">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $area[1];?>: <?php echo $area[2]?></h6>
                    </div>
                    <div class="card-body bod_cont pt-0">
                        <div class="w-100 d-flex justify-content-end">
                            <div class="butn add h-100" id="param_add_btn" data-id="<?php echo $area[0];?>">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="butn edit h-100" id="area_edit_btn" data-id="<?php echo $area[0];?>">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div class="butn delete h-100" id="area_delete_btn" data-id="<?php echo $area[0];?>">
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
<?php
                 $get_params = "SELECT * FROM accsys.maintenance_area_parameter WHERE area_code = '$area[0]' ORDER BY param_code ASC";
                 $param_result = pg_query($connection, $get_params);

                if(pg_num_rows($param_result) > 0){
                    while($param=pg_fetch_row($param_result)){
?>
                        <div class="param_cont mb-2">
                            <div class="param_header mb-0 drop press">
                                <h6 class="m-0 param_h">
                                    <i class="fa fa-arrow-circle-right mr-2" aria-hidden="true"></i>
                                    <span class="font-weight-bold text-primary"><?php echo $param[2];?>: <?php echo $param[3];?></span>
                                </h6>
                            </div>
                            <div class="param_sub">
                                <div class="w-100 d-flex justify-content-end">
                                    <div class="butn add h-100" id="ins_add_btn" param-id="<?php echo $param[0];?>" area-id="<?php echo $area[0];?>">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="butn edit h-100" id="param_edit_btn" data-id="<?php echo $param[0];?>">
                                        <i class="fas fa-pen"></i>
                                    </div>
                                    <div class="butn delete h-100" id="param_delete_btn" data-id="<?php echo $param[0];?>">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
<?php
                $get_cat = "SELECT accsys.maintenance_parameter_category.cat_code, accsys.maintenance_parameter_category.description
                            FROM accsys.maintenance_parameter_category
                            INNER JOIN accsys.maintenance_area_instrument
                            ON accsys.maintenance_parameter_category.cat_code = accsys.maintenance_area_instrument.area_category
                            INNER JOIN accsys.maintenance_area_parameter
                            ON accsys.maintenance_area_instrument.area_param = accsys.maintenance_area_parameter.param_code
                            WHERE accsys.maintenance_area_parameter.param_code = '$param[0]'
                            GROUP BY accsys.maintenance_parameter_category.cat_code
                            ORDER BY accsys.maintenance_parameter_category.order_num ASC";
                $cat_result = pg_query($connection, $get_cat);

                    if(pg_num_rows($cat_result) > 0){
                        while($cat=pg_fetch_row($cat_result)){
?>
                                <div class="param_sub_header mt-2 drop press">
                                    <h6 class="m-0 font-weight-bold param_h ml-4">
                                        <i class="fa fa-caret-right mr-2" aria-hidden="true"></i> <span class="text-primary"><?php echo $cat[1];?></span>
                                    </h6>
                                </div>
                                <div class="param_body">
                                    <div class="param_content_cont mt-3">
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
                                                <tbody>
<?php
                            $get_instruments = "SELECT accsys.maintenance_area_instrument.keyctr, accsys.maintenance_area_instrument.code, accsys.maintenance_area_instrument.description
                                                FROM accsys.maintenance_area_instrument
                                                INNER JOIN accsys.maintenance_area
                                                ON accsys.maintenance_area_instrument.area_code = accsys.maintenance_area.keyctr
                                                INNER JOIN accsys.maintenance_area_parameter
                                                ON accsys.maintenance_area_instrument.area_param = accsys.maintenance_area_parameter.param_code
                                                INNER JOIN accsys.maintenance_parameter_category
                                                ON accsys.maintenance_area_instrument.area_category = accsys.maintenance_parameter_category.cat_code
                                                WHERE accsys.maintenance_area.keyctr = '$area[0]' AND accsys.maintenance_parameter_category.cat_code = '$cat[0]' AND accsys.maintenance_area_parameter.param_code = '$param[0]'
                                                ORDER BY accsys.maintenance_area_instrument.code ASC";
                            $get_instruments_result = pg_query($connection, $get_instruments);

                            if(pg_num_rows($get_instruments_result) > 0){ 
                                while($instrument=pg_fetch_row($get_instruments_result)){    
?>
                                                    <tr>
                                                        <td style="width: 45%;">
                                                            <span><?php echo $instrument[1];?></span>
                                                            <span><?php echo $instrument[2];?></span>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <ul>
<?php
                                                            $get_docs = "SELECT accsys.maintenance_area_instrument_docs.keyctr, accsys.maintenance_supporting_docs.support_document,
                                                            accsys.maintenance_get_docs.office
                                                            FROM accsys.maintenance_area_instrument_docs
                                                            INNER JOIN accsys.maintenance_get_docs
                                                            ON accsys.maintenance_area_instrument_docs.offccode = accsys.maintenance_get_docs.offccode
                                                            INNER JOIN accsys.maintenance_supporting_docs
                                                            ON accsys.maintenance_area_instrument_docs.scode = accsys.maintenance_supporting_docs.scode
                                                            WHERE instrument_keyctr = '$instrument[0]' ORDER BY keyctr ASC";
                                                            
                                                            $get_docs_result = pg_query($connection, $get_docs);
                                                            $get_src_result = pg_query($connection, $get_docs);

                                                            if(pg_num_rows($get_docs_result) > 0){
                                                                while($docs=pg_fetch_row($get_docs_result)){  
?>
                                                                    <li><?php echo $docs[1];?></li>
<?php
                                                                }
                                                            }
                                                            else{
                                                                echo "No supporting document(s) found.";
                                                            }
?>
                                                            </ul>
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <ul>
<?php
                                                        if(pg_num_rows($get_src_result) > 0){
                                                            while($src=pg_fetch_row($get_src_result)){ 
?>      
                                                                <li><?php echo $src[2];?></li>
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
                                                            <button class="btn btn-info w-100 mt-2"  id="edit_btn" data-id="<?php echo $instrument[0];?>" param-id="<?php echo $param[0];?>">
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
                                <label class="switch parsub area">
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
                             <span class="slider round parsub area"></span>    
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

                                if(pg_num_rows($check_sub_result) > 0){
?>
                                    <tr>
                                        <td class="py-0 ins_sub" colspan="4" id="add_sub_param" data-id = "<?php echo $instrument[0];?>" cat-id = "<?php echo $cat[0];?>" param-code = "<?php echo $instrument[1];?>">
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
                        echo "No instrument(s) found.";
                    }
?>
                            </div>
                        </div>
<?php
                    }
                }
                else{
                    echo '<p>No Parameter(s) found.</p>';  
                }
?>
                    </div>
                </div>
<?php
            }
        }
        else{
            echo '<p>No Area(s) found.</p>';
        }
    }
?>

<script type="text/javascript">
     $(document).ready(function(){

        $(".card-body.bod_cont").show();
        $(".param_sub").hide();
        $(".param_body").hide();

        $(".card-header.drop").click(function(){
            $(this).next(".card-body.bod_cont").slideToggle();
        });

        $(".param_header.drop").click(function(){
            $(this).next(".param_sub").slideToggle();
        });

        $(".param_sub_header.drop").click(function(){
            $(this).next(".param_body").slideToggle();
        });

     });
</script>