
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
        $('#title_error').text('');
        $('#content_error').text('');
        $('#images_error').text('');
        $("#images_all_error").text('');


        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        // var formData=$('#post_form').serialize();
        var data = new FormData( $( '#post_form' )[ 0 ] );



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

                        // first step:reset all inputs

                        $('#title').val('');
                        $('#content').val('');
                        $('#images').val('');
                        // second step: reset all errors
                        $('#title_error').text('');
                        $('#content_error').text('');
                        $('#images_error').text('');


                        // third step :close modal
                        $('#createPostModal').modal('hide');

                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();


                        // fourth step: show success message for 5 seconds
                        $('#success_msg').show();

                        $('#success_msg').text(response.message);
                        setTimeout(function(){
                            $('#success_msg').hide();// or fade, css display however you'd like.
                         }, 3000);
                        //  fifth step :show all posts
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


















