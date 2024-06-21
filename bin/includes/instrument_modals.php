            <div id="AddModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Sub-Instrument</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="add_sub_param_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" id="add_timezone" name="add_timezone" readonly>
                                        <input type="hidden" name="add_sub_ins_id" id="add_sub_ins_id" readonly>
                                        <input type="hidden" name="add_sub_ins_cat" id="add_sub_ins_cat" readonly>
                                        <input type="hidden" name="ins_param_code" id="ins_param_code" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Sub-Instrument Code</label>
                                                <div>
                                                    <div class="input-group">
                                                        <span class="input-group-append ar_num" id="ar_num"></span>
                                                        <input type="text" class="form-control input-lg" name="add_sub_param_code" id="add_sub_param_code" style="text-transform: uppercase;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <div>
                                                    <textarea class="form-control w-100" rows="15" name="add_sub_param_desc" id="add_sub_param_desc" style="resize: none;" maxlength="300"></textarea>
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

                                <button class="btn btn-primary btn-icon-split" id="add_sub_param_btn" type="submit">
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

                <div id="AddDocModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Supporting Document(s)</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="add_sup_doc_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" id="add_doc_timezone" name="add_doc_timezone" readonly>
                                        <input type="hidden" name="add_doc_ins_id" id="add_doc_ins_id" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Supporting Document(s)</label>
                                                <div id="display_docs_list"></div>
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

                                <button class="btn btn-primary btn-icon-split" id="add_doc_param_btn" type="submit">
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

                <div id="AddSubDocModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Supporting Document(s)</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="add_sub_sup_doc_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" id="add_sub_doc_timezone" name="add_sub_doc_timezone" readonly>
                                        <input type="hidden" name="add_sub_doc_ins_id" id="add_sub_doc_ins_id" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Supporting Document(s)</label>
                                                <div id="display_sub_docs_list"></div>
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

                                <button class="btn btn-primary btn-icon-split" id="add_sub_doc_param_btn" type="submit">
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

                <div id="UpdateInsModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Instrument</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="up_param_ins_form" enctype="multipart/form-data">
                                    <input type="hidden" id="up_timezone" name="up_timezone" readonly>
                                    <input type="hidden" name="up_ins_id" id="up_ins_id" readonly>
                                    <input type="hidden" name="up_old_param_code" id="up_old_param_code" readonly>
                                    <input type="hidden" name="parameter_code" id="parameter_code" readonly>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Instrument Code</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-lg" name="up_param_code" id="up_param_code" style="text-transform: uppercase;" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <div>
                                                    <textarea class="form-control w-100" rows="15" name="up_param_desc" id="up_param_desc" style="resize: none;" maxlength="300"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label mb-3" style="font-weight: bolder;">Supporting Document(s):</label>
                                                <div id="up_display_docs_list"></div>
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

                                <button class="btn btn-primary btn-icon-split" id="up_param_btn" type="submit">
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

                
                <div id="UpdateSubInsModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Add modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Sub-Instrument</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="up_param_sub_ins_form" enctype="multipart/form-data">
                                    <input type="hidden" id="up_sub_timezone" name="up_timezone" readonly>
                                    <input type="hidden" name="up_ins_id" id="up_sub_ins_id" readonly>
                                    <input type="hidden" name="up_old_param_code" id="up_sub_old_param_code" readonly>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Instrument Code</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-lg" name="up_param_code" id="up_sub_param_code" style="text-transform: uppercase;" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <div>
                                                    <textarea class="form-control w-100" rows="15" name="up_param_desc" id="up_sub_param_desc" style="resize: none;" maxlength="300"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label mb-3" style="font-weight: bolder;">Supporting Document(s):</label>
                                                <div id="up_sub_display_docs_list"></div>
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

                                <button class="btn btn-primary btn-icon-split" id="up_sub_param_btn" type="submit">
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