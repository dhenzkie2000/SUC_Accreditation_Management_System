const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(timezone);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500
});

$(document).ready(function() {
    displayCategory();
    addCategory();
    update();
    updateCategory();
    deleteCategory();
});

function displayCategory(){
    $('#dataTable').DataTable();
}

function addCategory(){

    $("#add_form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"modals/php/add_category.php",
            data:new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                if(data.status == 1){

                    if(Toast.fire({icon: 'success', title: 'Category Added!'})){
                        window.location.reload();
                    }
                  
                }
                else if(data.status == 2){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Category already exists.',
                    })

                }
                else if(data.status == 3){

                    Toast.fire({
                        icon: 'warning',
                        title: 'Placement must be unique.',
                    })

                }
                else if(data.status == 0){

                    Toast.fire({
                        icon: 'error',
                        title: 'Please fill required inputs',
                    })

                }
                else if(data.status == 4){
                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to add category. Error Occured.',
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
        var cat_code = $(this).attr('data-id');

        $.ajax({
            url:"modals/php/update_category.php",
            method:"POST",
            data:{
                cat_code:cat_code,
                "trig": 1
            },
            dataType: "json",
            success:function(d){

                console.log(d);

                $('#up_cat_id').val(d.cat_code);
                $('#up_cat_num').val(d.order_num);
                $('#up_cat_code').val(d.cat_code);
                $('#up_cat_desc').val(d.description);
                $('#up_cat_plac').val(d.order_num);
                $('#UpdateModal').modal('show');
            },
            error:function(d){
                console.log(d);
            }
        })

    });

}

function updateCategory(){
    $(document).on('click', '#up_cat_btn', function(e)
    {
        e.preventDefault();

        var up_cat_id = $('#up_cat_id').val();
        var up_cat_num = $('#up_cat_num').val();
        var up_cat_code = $('#up_cat_code').val();
        var up_cat_plac = $('#up_cat_plac').val();
        var up_cat_desc = $('#up_cat_desc').val();
        var up_timezone = $('#timezone').val();

        $.post("modals/php/update_category.php",{
            up_cat_id:up_cat_id,
            up_cat_num:up_cat_num,
            up_cat_code:up_cat_code,
            up_cat_plac:up_cat_plac,
            up_cat_desc:up_cat_desc,
            up_timezone:up_timezone,
            "trig": 2
        },function(d){
            console.log(d);
            var data=JSON.parse(d);

            if(data.status == 1){
                
                $('#UpdateModal').modal('hide');
            
                if(Toast.fire({icon: 'success', title: 'Category Updated!'})){
                    window.location.reload();
                }
            }
            else if(data.status == 2){

                Toast.fire({
                    icon: 'warning',
                    title: 'Category already exists.',
                })

            }
            else if(data.status == 3){

                Toast.fire({
                    icon: 'warning',
                    title: 'Placement must be unique.',
                })

            }
            else if(data.status == 0){

                Toast.fire({
                    icon: 'error',
                    title: 'Please fill required inputs.',
                })

            }
            else if(data.status == 4){
                Toast.fire({
                    icon: 'error',
                    title: 'Unable to update category. Error Occured.',
                })
            }
        });

    });
}
function deleteCategory(){
    $(document).on('click', '#delete_btn', function() {
        var cat_code = $(this).attr('data-id');
        Swal.fire({
            title: 'Proceed to remove this category?',
            text: "Other contents under this category such as instrument parameters and documents attached or synchronized will also be deleted. Confirm?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4169e1',
            cancelButtonColor: '#fa8072',
            confirmButtonText: 'Proceed'
        }).then((result) => {
            if (result.isConfirmed){
                $.post("modals/php/delete_category.php",{
                    cat_code:cat_code
                },function(response){

                    if(response == '1'){
                        if(Toast.fire({icon: 'success', title: 'Category Removed!'})){
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