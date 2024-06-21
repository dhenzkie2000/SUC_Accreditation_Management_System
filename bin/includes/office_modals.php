                <!-- Update modal start-->
                <div id="UpdateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Update modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Office</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="update_form">
                                    <div class="row">
                                        <input type="hidden" name="up_off_id" id="up_off_id" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Office Code</label>
                                                <div>
                                                    <input type="text" class="form-control" id="up_off_code" name="up_off_code" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Office Name</label>
                                                <div>
                                                    <input type="text" class="form-control" id="up_off_name" name="up_off_name">
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

                                <button class="btn btn-info btn-icon-split" id="up_off_btn" type="submit">
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
                <!-- Update modal end-->