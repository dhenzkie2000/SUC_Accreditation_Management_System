                <div id="UpdateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Update modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Category</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="update_form">
                                    <div class="row">
                                        <input type="hidden" name="up_cat_id" id="up_cat_id" readonly>
                                        <input type="hidden" name="up_cat_num" id="up_cat_num" readonly>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category Code</label>
                                                <div>
                                                    <input type="text" class="form-control" id="up_cat_code" name="up_cat_code" maxlength="1" style="text-transform: uppercase;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category Placement</label>
                                                <div>
                                                    <input type="number" class="form-control" id="up_cat_plac" name="up_cat_plac" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Category Description</label>
                                                <div>
                                                    <textarea class="form-control w-100" rows="15" name="up_cat_desc" id="up_cat_desc" style="resize: none; text-transform: uppercase;"></textarea>
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

                                <button class="btn btn-info btn-icon-split" id="up_cat_btn" type="submit">
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