                <div id="AddModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Assign Element(s)</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="add_ass_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" id="timezone" name="timezone" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="param_cat">Office(s):</label>
                                                <select class="form-control" id="office" name="office">
                                                    <option value="" hidden></option>
<?php
                                                $get_off = "SELECT * FROM accsys.maintenance_get_docs ORDER BY office ASC";
                                                $off_result = pg_query($connection, $get_off);
                                                if(pg_num_rows($off_result) > 0){
                                                    while($office=pg_fetch_row($off_result)){
?>
                                                    <option value="<?php echo $office[0];?>"><?php echo $office[1];?></option>               
<?php
                                                    }
                                                }
                                                else{
                                                    echo "No office(s) found.";
                                                }
?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Supporting Document(s)</label>
                                                <div class="sup_doc_cont">
                                                    <div id="display_docs_list"></div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                    <span class="text">Cancel</span>
                                </button>

                                <button class="btn btn-primary btn-icon-split" id="ass_btn" type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Submit</span>
                                </button>
                            </div>
                        </form>
                        </div>
                        <!-- Add modal content end-->
                    </div>
                </div>

                <div id="UpdateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Update Assigned Supporting Document(s)</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="up_ass_form">
                                    <div class="row">
                                        <input type="hidden" id="up_timezone" name="up_timezone" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="param_cat">Office:</label>
                                                <div>
                                                    <input type="hidden" class="form-control" id="up_ass_id" name="up_ass_id">
                                                    <input type="hidden" class="form-control" id="up_office_id" name="up_office_id">
                                                    <input type="text" class="form-control" id="up_office_name" disabled readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Supporting Document</label>
                                                <select class="form-control" id="up_supp_doc" name="up_supp_doc"></select>
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                    <span class="text">Cancel</span>
                                </button>

                                <button class="btn btn-primary btn-icon-split" id="up_btn_doc_off" type="button">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Submit</span>
                                </button>
                            </div>
                        </form>
                        </div>
                        <!-- Add modal content end-->
                    </div>
                </div>