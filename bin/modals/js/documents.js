const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    displayDocs();
    addDocs();
    wordSplit();
    update();
    updateLevel();
    deleteDoc();
});

function displayDocs(){
    $('#dataTable').DataTable();
}

function wordSplit(){
    $(document).on('change', '#doc_sup', function(e)
    {
        e.preventDefault();

        var ins = $('#doc_sup').val();

        if($('#doc_code').val() == ""){

            $.post("modals/php/wordsplit.php",{ins:ins, "trig":0},function(data){
                $('#doc_code').val(data);
            });

        }
    });
}

function addDocs(){
    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_docs.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                if(data.status == 1){

                    if(Toast.fire({icon: 'success', title: 'Document Added!'})){
                        window.location.reload();
                    }
                  
                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Document already exists.',
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
                        title: 'Unable to add document. Error Occured.',
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
        var doc_code = $(this).attr('data-id');

        $.ajax({
            url:"modals/php/update_document.php",
            method:"POST",
            data:{
                doc_code:doc_code,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_doc_id').val(d.scode);
                $('#up_doc_code').val(d.scode);
                $('#up_doc_sup').val(d.support_document);
                $('#UpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })

    })
}

function updateLevel(){
    $(document).on('click', '#up_doc_btn', function(e)
    {
        e.preventDefault();

        var up_doc_id = $('#up_doc_id').val();
        var up_doc_code = $('#up_doc_code').val();
        var up_doc_sup = $('#up_doc_sup').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_document.php",{
            up_doc_id:up_doc_id,
            up_doc_code:up_doc_code,
            up_doc_sup:up_doc_sup,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){

            console.log(d);
            var data=JSON.parse(d);

            if(data.status == 1){
                
                $('#UpdateModal').modal('hide');
            
                if(Toast.fire({icon: 'success', title: 'Document Updated!'})){
                    window.location.reload();
                }
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Document already exists.',
                })

            }
            else if(data.status == 0){

                Toast.fire({
                    icon: 'error',
                    title: 'Please fill required inputs.',
                })

            }
        });

    });
}

function deleteDoc(){
    $(document).on('click', '#delete_btn', function() {
        var doc_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Proceed to remove this support document?',
            text: "Other documents under this support document attached or synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_document.php",{
                    doc_id:doc_id
                },function(response){
                    if(response == '1'){
                        if(Toast.fire({icon: 'success', title: 'Support Document Removed!'})){
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