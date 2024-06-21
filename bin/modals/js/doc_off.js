const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);
$('#up_timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    displayDocOff();
    assignDocs();
    deleteAssignment();
    update();
    updateAssignment();
});

function displayDocOff(){
    $('#dataTable').DataTable();
}

function assignDocs(){
    $(document).on('click', '#assign_btn', function()
    {
        $('#AddModal').modal('show');

        $(document).on('change', '#office', function()
        {
            var office = $('#office').val();

            $.ajax({
                url: "modals/php/display_list_supdocs.php",
                type: "POST",
                async: false,
                data: {
                    "display": 1,
                    office:office
                },
                success: function(d){
                    $("#display_docs_list").html(d);
                }
            });
        });
    });

    $("#add_ass_form").on('submit', function(e)
    {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_assignment.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                console.log(data);

                if(data.status == 1){

                    if(Toast.fire({icon: 'success', title: 'Document(s) Assigned!'})){
                        window.location.reload();
                    }
                  
                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'error',
                        title: 'Please check at least one document',
                    })

                }
                else if(data.status == 2){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to assign document. Error Occured.',
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
    $(document).on('click', '#edit_btn', function()
    {

        var ass_id = $(this).attr('data-id');
        var doc_id = $(this).attr('doc-id'); 

        $.ajax({
            url:"modals/php/update_off_doc.php",
            method:"POST",
            data:{
                ass_id:ass_id,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_ass_id').val(d.keyctr);
                $('#up_office_name').val(d.office);
                $('#up_office_id').val(d.offccode);
                
                if($('#UpdateModal').modal('show')){

                    var office_id =  $('#up_office_id').val();

                    $.ajax({
                        url: "modals/php/get_supporting_doc.php",
                        type: "POST",
                        async: false,
                        data: {
                            "display": 1,
                            doc_id:doc_id,
                            office_id:office_id
                        },
                        success: function(d){
                            $("#up_supp_doc").html(d);
                        }
                    });

                }
            },
            error:function(d){
                console.log(d);
            }
        });
    });
}

function updateAssignment(){

    $(document).on('click', '#up_btn_doc_off', function(e)
    {   
        var up_ass_id = $('#up_ass_id').val();
        var up_office_id = $('#up_office_id').val();
        var up_office_name = $('#up_office_name').val();
        var up_supp_doc = $('#up_supp_doc').val();
        var up_timezone = $('#up_timezone').val();

        $.post("modals/php/update_off_doc.php",{
            up_ass_id:up_ass_id,
            up_office_id:up_office_id,
            up_office_name:up_office_name,
            up_supp_doc:up_supp_doc,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){
            var data=JSON.parse(d);

            if(data.status == 1){
                
                $('#UpdateModal').modal('hide');
            
                if(Toast.fire({icon: 'success', title: 'Document Assignment Updated!'})){
                    window.location.reload();
                }
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'The document is already assigned to this office.',
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
                    icon: 'warning',
                    title: 'Please select new document to proceed.',
                })
            }
        });

    });

}

function deleteAssignment(){
    $(document).on('click', '#delete_btn', function()
    {
        var ass_id = $(this).attr('data-id');

        Swal.fire({
            title: 'Proceed to remove this document/office assignment?',
            text: "Other contents under this assignment synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){
                $.post("modals/php/delete_doc_off.php",{
                    ass_id:ass_id
                },function(response){

                    if(response == '1'){
                        if(Toast.fire({icon: 'success', title: 'Assignment Removed!'})){
                            window.location.reload();
                        } 
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