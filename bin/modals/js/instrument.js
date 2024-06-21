const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);
$('#up_timezone').val(timezone);
$('#up_sub_timezone').val(timezone);
$('#add_timezone').val(timezone);
$('#add_doc_timezone').val(timezone);
$('#add_sub_doc_timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    addInstrument();
    displayInstrument();
    addsubParam();
    add_SupportDocs();
    add_sub_SupportDocs();
    deleteIns();
    Code();
    deletesubIns();
    updateParam();
    updatesubParam();
    Switch();
});

function Code(){
    $(document).on('change', '#param_cat', function(e)
    {
        var param_cat = $('#param_cat').val();
        $('#ins_code').val(param_cat+".");
    });
}

function Switch(){
    $(document).on('click', '#switch_sub', function(e)
    {
        var ins_id = $(this).attr('value');  
        $.post("modals/php/update_switch_sub.php",{
            ins_id:ins_id
        },function(){
            displayInstrument();
        });

    });
}

function displayInstrument(){
    $.ajax({
        url: "modals/php/display_instrument.php",
        type: "POST",
        async: false,
        data: {
            param_id:param_id,
            area_id:area_id,
            "display": 1
        },
        success: function(d){
            $("#display_instrument").html(d);
        }
    });
}

function addInstrument(){
    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_instrument.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                
                console.log(data);
                displayInstrument();

                if(data.status == 1){

                    $('#add_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Parameter Instrument Added!'
                    });

                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Instrument already exists.',
                    })

                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'error',
                        title: 'Please fill required inputs',
                    })

                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to add instrument. Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        })
    });
}

function addsubParam(){
    $(document).on('click', '#add_sub_param', function()
    {
        var max = 6;

        var ins_id = $(this).attr('data-id');
        var cat_id = $(this).attr('cat-id');
        var param_code = $(this).attr('param-code');

        var length = param_code.length;
        var maxlength = max - length;

        $('#add_sub_param_code').attr('maxlength', maxlength);

        $('#add_sub_ins_id').val(ins_id);
        $('#add_sub_ins_cat').val(cat_id);
        $('#ar_num').text(param_code);
        $('#ins_param_code').val(param_code);
        $('#AddModal').modal('show');

    });

    $("#add_sub_param_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_sub_instrument.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                
                console.log(data);
                displayInstrument();

                if(data.status == 1){

                    $('#AddModal').modal('hide');
                    $('#add_sub_param_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Sub-Instrument Added!'
                    });

                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Sub-Instrument already exists.',
                    })

                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'error',
                        title: 'Please fill required inputs',
                    })

                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to add sub-instrument. Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        })
    });
}

function add_SupportDocs(){

    $(document).on('click', '#doc_btn', function()
    {
        var ins_id = $(this).attr('data-id');

        $('#add_doc_ins_id').val(ins_id);
        $('#AddDocModal').modal('show');

        $.ajax({
            url: "modals/php/display_list_add_sup_doc.php",
            type: "POST",
            async: false,
            data: {
                "display": 1,
                ins_id:ins_id
            },
            success: function(d){
                $("#display_docs_list").html(d);
            }
        });
        
    });

    $("#add_sup_doc_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_ins_doc.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
            
                displayInstrument();

                if(data.status == 1){

                    $('#AddDocModal').modal('hide');
                    $('#add_sup_doc_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Supporting Document(s) Synchronized!'
                    });

                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Please select at least one',
                    })

                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to add support document(s). Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        })
    });

}

function add_sub_SupportDocs(){

    $(document).on('click', '#sub_doc_btn', function()
    {
        var ins_id = $(this).attr('data-id');

        $('#add_sub_doc_ins_id').val(ins_id);
        $('#AddSubDocModal').modal('show');

        $.ajax({
            url: "modals/php/display_sub_list_add_sup_doc.php",
            type: "POST",
            async: false,
            data: {
                "display": 1,
                ins_id:ins_id
            },
            success: function(d){
                $("#display_sub_docs_list").html(d);
            }
        });
        
    });

    $("#add_sub_sup_doc_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_sub_ins_doc.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
            
                displayInstrument();

                if(data.status == 1){

                    $('#AddSubDocModal').modal('hide');
                    $('#add_sub_sup_doc_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Supporting Document(s) Synchronized!'
                    });

                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Please select at least one',
                    })

                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to add support document(s). Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        })
    });

}

function deleteIns(){
    $(document).on('click', '#delete_btn', function() {
        var ins_id = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Proceed to remove this instrument?',
            text: "Other contents under this instrument such as support document(s) attached or synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_instrument.php",{
                    ins_id:ins_id
                },function(response){

                    displayInstrument();

                    if(response == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Instrument Removed!'
                        })
                    }
                    
                    else if(response == '0'){
                        Toast.fire({
                            icon: 'error',
                            title: 'Error Occured! Please try again.',
                        })
                    }
                });
            }
        });    
    });
}

function updateParam(){
    $(document).on('click', '#edit_btn', function()
    {
        var ins_id = $(this).attr('data-id');
        var param_id = $(this).attr('param-id');

        $('#up_ins_id').val(ins_id);
        $('#parameter_code').val(param_id);

        $.ajax({
            url:"modals/php/update_get_instrument.php",
            method:"POST",
            data:{
                ins_id:ins_id,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_old_param_code').val(d.code);
                $('#up_param_code').val(d.code);
                $('#up_param_desc').val(d.description);
                $('#UpdateInsModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        });

        $.ajax({
            url: "modals/php/display_up_list_supdoc.php",
            type: "POST",
            async: false,
            data: {
                "display": 1,
                ins_id:ins_id
            },
            success: function(d){
                $("#up_display_docs_list").html(d);
            }
        });

    });

    $("#up_param_ins_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/update_instrument.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                console.log(data);
                displayInstrument();

                if(data.status == 1){

                    $('#UpdateInsModal').modal('hide');
                    $('#up_param_ins_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Instrument Updated!'
                    });
                }
                else if(data.status == 2){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Instrument already exists.',
                    })
                }
                else if(data.status == 0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Please fill required inputs',
                    })
                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to update instrument. Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }); 

    $(document).on('click', '#uncheck_supdoc', function()
    {
        var scode = $(this).attr('scode');
        var offccode = $(this).attr('offccode');
        var ins_id = $(this).attr('ins-id');

        $.post("modals/php/delete_check_doc.php",{
            ins_id:ins_id,
            scode:scode,
            offccode:offccode
        },function(){
            displayInstrument();

            $.ajax({
                url: "modals/php/display_up_list_supdoc.php",
                type: "POST",
                async: false,
                data: {
                    "display": 1,
                    ins_id:ins_id
                },
                success: function(d){
                    $("#up_display_docs_list").html(d);
                }
            });
        });

    });
}

function updatesubParam(){
    $(document).on('click', '#sub_edit_btn', function()
    {
        var ins_id = $(this).attr('data-id');

        $('#up_sub_ins_id').val(ins_id);

        $.ajax({
            url:"modals/php/update_get_sub_instrument.php",
            method:"POST",
            data:{
                ins_id:ins_id,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_sub_old_param_code').val(d.sub_code);
                $('#up_sub_param_code').val(d.sub_code);
                $('#up_sub_param_desc').val(d.description);
                $('#UpdateSubInsModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        });

        $.ajax({
            url: "modals/php/display_up_sub_list_supdoc.php",
            type: "POST",
            async: false,
            data: {
                "display": 1,
                ins_id:ins_id
            },
            success: function(d){
                $("#up_sub_display_docs_list").html(d);
            }
        });
    });

    $("#up_param_sub_ins_form").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type:"POST",
            url:"modals/php/update_sub_instrument.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                console.log(data);
                displayInstrument();

                if(data.status == 1){

                    $('#UpdateSubInsModal').modal('hide');
                    $('#up_param_sub_ins_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Sub-Instrument Updated!'
                    });
                }
                else if(data.status == 2){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Sub-Instrument already exists.',
                    })
                }
                else if(data.status == 0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Please fill required inputs',
                    })
                }
                else if(data.status == 3){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to update sub-instrument. Error Occured.',
                    })
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    }); 

    $(document).on('click', '#uncheck_sub_supdoc', function()
    {
        var scode = $(this).attr('scode');
        var offccode = $(this).attr('offccode');
        var ins_id = $(this).attr('ins-id');

        $.post("modals/php/delete_sub_check_doc.php",{
            ins_id:ins_id,
            scode:scode,
            offccode:offccode
        },function(){
            displayInstrument();

            $.ajax({
                url: "modals/php/display_up_sub_list_supdoc.php",
                type: "POST",
                async: false,
                data: {
                    "display": 1,
                    ins_id:ins_id
                },
                success: function(d){
                    $("#up_sub_display_docs_list").html(d);
                }
            });
        });

    });


}

function deletesubIns(){
    $(document).on('click', '#sub_delete_btn', function() {
        var ins_id = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Proceed to remove this sub-instrument?',
            text: "Other contents under this sub-instrument such as support document(s) attached or synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_sub_instrument.php",{
                    ins_id:ins_id
                },function(response){

                    displayInstrument();

                    if(response == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Sub-Instrument Removed!'
                        })
                    }
                    
                    else if(response == '0'){
                        Toast.fire({
                            icon: 'error',
                            title: 'Error Occured! Please try again.',
                        })
                    }
                });
            }
        });    
    });
}



