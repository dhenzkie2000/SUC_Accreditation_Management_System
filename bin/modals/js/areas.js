const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);
$('#add_timezone').val(timezone);
$('#add_doc_timezone').val(timezone);
$('#sub_add_timezone').val(timezone);
$('#add_sub_doc_timezone').val(timezone);
$('#up_sub_timezone').val(timezone);
$('#up_timezone').val(timezone);

$('#display_cards').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
$(window).on('load', function(){
  setTimeout(removeLoader, 1000);
});

function removeLoader(){
    $( "#loadingDiv" ).fadeOut(500, function() {
      $( "#loadingDiv" ).remove();
  });  
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function(){
    displayAreas();
    addArea();
    add_SupportDocs();
    add_sub_SupportDocs();
    addParam();
    addsubParam();
    deleteArea();
    deleteParam();
    deleteIns();
    deletesubIns();
    update();
    updateArea();
    updateParam();
    updateIns();
    updatesubIns();
    goToAddInstrument();
    Switch();
});

function Switch(){
    $(document).on('click', '#switch_sub', function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        var ins_id = $(this).attr('value');  
        $.post("modals/php/update_switch_sub.php",{
            ins_id:ins_id
        },function(){
            displayAreas();
        });

    });
}

function displayAreas(){
    $.ajax({
        url: "modals/php/display_areas_param.php",
        type: "POST",
        async: false,
        data: {
            "display": 1
        },
        success: function(d){
            $("#display_cards").html(d);
        }
    });
}

function goToAddInstrument(){
    $(document).on('click', '#ins_add_btn', function()
    {
        var param_id = $(this).attr('param-id');
        var area_id = $(this).attr('area-id');

        $.post("modals/php/ajax.php",{
            param_id:param_id,
            area_id:area_id,
            "action": "AddInstrument"
        },function(d){
            console.log(d);
            window.location.href = d;
        });

    });
}

function addArea(){

    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_area.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                
                displayAreas();

                if(data.status == 1){

                    $('#add_form')[0].reset();

                    Toast.fire({
                        icon: 'success',
                        title: 'Area Added!'
                    });

                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Area already exists.',
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
                        title: 'Unable to add area. Error Occured.',
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
            
                displayAreas();

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
            
                displayAreas();

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

function addParam(){
    $(document).on('click', '#param_add_btn', function()
    {
        var max = 6;
        $('#AddModal').modal('show');

        var area_id = $(this).attr('data-id');

        var length = area_id.length;
        var maxlength = max - length;
        $('#add_param_code').attr('maxlength', maxlength);

        $('#add_area_id').val(area_id);
        $('#ar_num').text(area_id);

        $("#add_param_form").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:"modals/php/add_parameter.php",
                data:new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data);
                    displayAreas();
    
                    if(data.status == 1){

                        Toast.fire({
                            icon: 'success',
                            title: 'Parameter Added!'
                        });
    
                        $('#add_param_form')[0].reset();
                        $('#AddModal').modal('hide');
    
                    }
                    else if(data.status == 2){
    
                        Toast.fire({
                            icon: 'warning',
                            title: 'Parameter already exists.',
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
                            title: 'Unable to add parameter. Error Occured.',
                        })
                    }
                },
                error:function(data){
                    console.log(data);
                }
            })
        });
        

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
        $('#sub_ar_num').text(param_code);
        $('#ins_param_code').val(param_code);
        $('#AddSubModal').modal('show');

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
                displayAreas();

                if(data.status == 1){

                    $('#AddSubModal').modal('hide');
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

function update(){
    $(document).on('click', '#area_edit_btn', function()
    {
        var area_id = $(this).attr('data-id');

        $.ajax({
            url:"modals/php/update_area.php",
            method:"POST",
            data:{
                area_id:area_id,
                "trig": 1
            },
            dataType: "json",
            success:function(d){

                console.log(d);

                $('#up_area_id').val(d.keyctr);
                $('#up_area_def').val(d.short_def);
                $('#up_area_desc').val(d.description);
                $('#UpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })

    })
}

function updateArea(){
    $(document).on('click', '#up_area_btn', function(e)
    {
        e.preventDefault();

        var up_area_id = $('#up_area_id').val();
        var up_area_def = $('#up_area_def').val();
        var up_area_desc = $('#up_area_desc').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_area.php",{
            up_area_id:up_area_id,
            up_area_def:up_area_def,
            up_area_desc:up_area_desc,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){
            console.log(d);

            displayAreas();
            var data=JSON.parse(d);

            if(data.status == 1){
                $('#UpdateModal').modal('hide');            
                
                Toast.fire({
                    icon: 'success',
                    title: 'Area Updated!'
                });
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Area already exists.',
                })

            }
            else if(data.status == 0){

                Toast.fire({
                    icon: 'error',
                    title: 'Please fill required inputs.',
                })

            }
            else{
                Toast.fire({
                    icon: 'error',
                    title: 'Unable to update area. Please try again.',
                })
            }
        });

    });
}

function updateParam(){
    $(document).on('click', '#param_edit_btn', function()
    {
        var param_id = $(this).attr('data-id');
        
        $.ajax({
            url:"modals/php/update_parameter.php",
            method:"POST",
            data:{
                param_id:param_id,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_param_area_id').val(d.area_code);
                $('#up_ar_num').text(d.area_code);
                $('#up_param_id').val(d.param_code);
                $('#up_param_def').val(d.short_def);
                $('#up_param_desc').val(d.description);
                $('#ParamUpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })

    });

    $(document).on('click', '#up_param_btn', function(e)
    {
        e.preventDefault();

        var up_param_code = $('#up_param_code').val();
        var up_param_area_id = $('#up_param_area_id').val();
        var up_param_id = $('#up_param_id').val();
        var up_param_def = $('#up_param_def').val();
        var up_param_desc = $('#up_param_desc').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_parameter.php",{
            up_param_code:up_param_code,
            up_param_area_id:up_param_area_id,
            up_param_id:up_param_id,
            up_param_def:up_param_def,
            up_param_desc:up_param_desc,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){
            console.log(d);
            displayAreas();
            var data=JSON.parse(d);

            if(data.status == 1){
                $('#ParamUpdateModal').modal('hide');            
                
                Toast.fire({
                    icon: 'success',
                    title: 'Parameter Updated!'
                });
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Parameter already exists.',
                });

            }
            else if(data.status == 0){

                Toast.fire({
                    icon: 'error',
                    title: 'Please fill required inputs.',
                })

            }
            else{
                Toast.fire({
                    icon: 'error',
                    title: 'Unable to update parameter. Please try again.',
                })
            }
        });

    });

}

function updateIns(){
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
                $('#up_ins_code').val(d.code);
                $('#up_ins_desc').val(d.description);
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
                displayAreas();
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
            displayAreas();

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

function updatesubIns(){
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
                displayAreas();

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
            displayAreas();

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

function deleteArea(){
    $(document).on('click', '#area_delete_btn', function() {
        var area_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Proceed to remove this area?',
            text: "Other content under this area synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_area.php",{
                    area_id:area_id
                },function(response){
                    
                    displayAreas();
                    
                    if(response == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Area Removed!',
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

function deleteParam(){
    $(document).on('click', '#param_delete_btn', function() {
        var param_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Proceed to remove this parameter?',
            text: "Other content under this parameter synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_parameter.php",{
                    param_id:param_id
                },function(response){
                    
                    displayAreas();
                    
                    if(response == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Parameter Removed!',
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

                    displayAreas();

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

                    displayAreas();

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
