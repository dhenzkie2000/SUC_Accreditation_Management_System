                <div id="UpdateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Update modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Level</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="update_form">
                                    <div class="row">
                                        
                                        <input type="hidden" name="up_lvl_id" id="up_lvl_id" readonly>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Level Number</label>
                                                <div>
                                                    <input type="number" class="form-control input-lg" name="up_lvl_num" id="up_lvl_num"
                                                    maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Level Description</label>
                                                <div>
                                                    <input type="text" class="form-control input-lg" name="up_lvl_desc" id="up_lvl_desc" maxlength="200">
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

                                <button class="btn btn-info btn-icon-split" id="up_lvl_btn" type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">Submit</span>
                                </button>
                            </div>
                        </form>
                        </div>
                        <!-- Update modal content end-->
                    </div>
                </div>