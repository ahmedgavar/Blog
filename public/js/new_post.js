
/*
1_ using ajax to save new post
2_ use jquery to show images before uploading

*/

$('#createPostModal').on('show.bs.modal',function(event){

    $('#deletePostModal').hide();
    $('#editPostModal').hide();
     // this following line solved problem gray background when opening modal
     $(this).appendTo("body");
     //  End solve gray background when opening modal



});
// first task is about create post
$('#post_form').on('submit', function (e) {
        e.preventDefault();
        reset_error_inputs();
        // header
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            // data from inputs

        var data = new FormData( $( '#post_form' )[ 0 ] );
            // code for post data
        $.ajax({
                method: 'POST',
                enctype: 'multipart/form-data',
                url: 'users/posts',
                data: data,
                dataType:'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function (response)
                 {

                        // first step button text
                        $('#save_post').text('saving');
                        // second step:reset all inputs
                        reset_inputs()
                        // third step: reset all errors
                       reset_error_inputs();

                        // fourth step :close modal
                        close_modal();


                        // fifth step: show success message using toastr
                        toastr.success(response.message);

                        //  sixth step :show all posts
                        $.ajax({
                            method: 'GET',
                            url: 'http://localhost:8000/users/posts',
                            dataType:'json',

                            success: function (response)
                             {

                                const all_posts=response.responseText;

                                console.log(response);
                                $('.show_all_posts .container').html('');
                                $('.show_all_posts .container').html(all_posts);



                            }
                            ,error: function(reject){
                            $('#save_post').text('save');

                                console.log("reject",reject);
                                const all_posts=reject.responseText;
                                $('.show_all_posts .container').html('');

                                $('.show_all_posts .container').html(all_posts);
                            }

                        });




                }
                , error: function (reject) {

                    console.log(reject.responseJSON.errors);
                    $.each(reject.responseJSON.errors, function (key, val) {
                        $("#" + key + "_error").text(val);
                    });
                    $("#images_all_error").text(reject.responseJSON.errors["images.0"]);



                }
            });
        });





// helper functions

function reset_error_inputs(){
    $('#title_error').text('');
    $('#content_error').text('');
    $('#images_error').text('');
    $("#images_all_error").text('');

}

function reset_inputs(){

$('#title').val('');
$('#content').val('');
$('#images').val('');

}



function close_modal(){


$('#createPostModal').modal('hide');

$('body').removeClass('modal-open');
$('.modal-backdrop').remove();
}



// second task is to show images before uploading

$(function() {
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {

                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);

                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };


//end  Multiple images preview with JavaScript
// call this function for create modal

    $('#images').on('change', function() {
        // remove old images not to be shown
        $('div.imgPreview img').remove();
        multiImgPreview(this, 'div.imgPreview');
        // End call this function for create modal

    });
});





