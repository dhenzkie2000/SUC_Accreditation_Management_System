const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    displayLevel();
    addLevel();
    update();
    updateLevel();
    deleteLevel();
});

function displayLevel(){
    $('#dataTable').DataTable();
}

function addLevel(){

    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_level.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                if(data.status == 1){

                    if(Toast.fire({icon: 'success', title: 'Level Added!'})){
                        window.location.reload();
                    }
                  
                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Level already exists.',
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
                        title: 'Unable to add level. Error Occured.',
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
        var lvl_code = $(this).attr('data-id');

        $.ajax({
            url:"modals/php/update_level.php",
            method:"POST",
            data:{
                lvl_code:lvl_code,
                "trig": 1
            },
            dataType: "json",
            success:function(d){

                console.log(d);

                $('#up_lvl_id').val(d.lvl_code);
                $('#up_lvl_num').val(d.lvl_code);
                $('#up_lvl_desc').val(d.description);
                $('#UpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })

    })

}

function updateLevel(){
    $(document).on('click', '#up_lvl_btn', function(e)
    {
        e.preventDefault();

        var up_lvl_id = $('#up_lvl_id').val();
        var up_lvl_code = $('#up_lvl_num').val();
        var up_lvl_desc = $('#up_lvl_desc').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_level.php",{
            up_lvl_code:up_lvl_code,
            up_lvl_desc:up_lvl_desc,
            up_lvl_id:up_lvl_id,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){
            console.log(d);
            var data=JSON.parse(d);

            if(data.status == 1){
                
                $('#UpdateModal').modal('hide');
            
                if(Toast.fire({icon: 'success', title: 'Level Updated!'})){
                    window.location.reload();
                }
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Level already exists.',
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

function deleteLevel(){
    $(document).on('click', '#delete_btn', function() {
        var lvl_id = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Proceed to remove this level?',
            text: "Other contents under this level such as parameters and documents attached or synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){

                $.post("modals/php/delete_level.php",{
                    lvl_id:lvl_id
                },function(response){

                    if(response == '1'){
                        if(Toast.fire({icon: 'success', title: 'Level Removed!'})){
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


