                <div id="UpdateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Update modal content start-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Document</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form id="update_form">
                                    <div class="row">
                                        
                                        <input type="hidden" name="up_doc_id" id="up_doc_id" readonly>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Document Code</label>
                                                <div>
                                                    <input type="text" class="form-control" id="up_doc_code" name="up_doc_code" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Support Document</label>
                                                <div>
                                                    <textarea class="form-control w-100" rows="15" name="up_doc_sup" id="up_doc_sup" style="resize: none;"></textarea>
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

                                <button class="btn btn-info btn-icon-split" id="up_doc_btn" type="submit">
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