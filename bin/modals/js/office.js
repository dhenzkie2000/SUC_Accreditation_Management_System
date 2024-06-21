const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    displayOffice();
    addOffice();
    update();
    updateOffice();
    deleteOffice();
    wordSplit();
});

function displayOffice(){
    $('#dataTable').DataTable();
}

function wordSplit(){
    $(document).on('change', '#off_name', function(e)
    {
        e.preventDefault();

        var ins = $('#off_name').val();

        if($('#off_code').val() == ""){

            $.post("modals/php/wordsplit.php",{ins:ins, "trig":0},function(data){
                $('#off_code').val(data);
            });

        }
    });
}
function addOffice(){
    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_office.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                if(data.status == 1){

                    if(Toast.fire({icon: 'success', title: 'Office Added!'})){
                        window.location.reload();
                    }
                  
                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Office already exists.',
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
                        title: 'Unable to add office. Error Occured.',
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
        var off_code = $(this).attr('data-id');

        $.ajax({
            url:"modals/php/update_office.php",
            method:"POST",
            data:{
                off_code:off_code,
                "trig": 1
            },
            dataType: "json",
            success:function(d){
                $('#up_off_id').val(d.offccode);
                $('#up_off_code').val(d.offccode);
                $('#up_off_name').val(d.office);
                $('#UpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })
    })
}
function updateOffice(){
    $(document).on('click', '#up_off_btn', function(e)
    {
        e.preventDefault();

        var up_off_id = $('#up_off_id').val();
        var up_off_code = $('#up_off_code').val();
        var up_off_name = $('#up_off_name').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_office.php",{
            up_off_id:up_off_id,
            up_off_code:up_off_code,
            up_off_name:up_off_name,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){

            console.log(d);
            var data=JSON.parse(d);

            if(data.status == 1){
                
                $('#UpdateModal').modal('hide');
            
                if(Toast.fire({icon: 'success', title: 'Office Updated!'})){
                    window.location.reload();
                }
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Office already exists.',
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
function deleteOffice(){
    $(document).on('click', '#delete_btn', function() {
        var off_id = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Proceed to remove this office?',
            text: "Other supporting documents and its contents synchronized to this office will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_office.php",{
                    off_id:off_id
                },function(response){

                    if(response == '1'){
                        if(Toast.fire({icon: 'success', title: 'Office Removed!'})){
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