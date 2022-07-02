
// first  task is to show images before uploading

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

    $('#images_edit').on('change', function() {
        // remove old images not to be shown


        $('div.imgEditPreview img').remove();
        multiImgPreview(this, 'div.imgEditPreview');
        // End call this function for create modal

    });
});

    $('#editPostModal').on('show.bs.modal',function(event){


        // this following line solved problem gray background when opening modal
        $(this).appendTo("body");
        //  End solve gray background when opening modal

        var button=$(event.relatedTarget);
        var title=button.data('title');
        var content=button.data('content');
        var postEditId=button.data('id');
        var img=button.data('images');


        $('#title_edit').val(title);
        $('#content_edit').val(content);
        $('#postId').val(postEditId);



    });

    // second task
    $('#post_form_update').on('submit', function (e)
    {
        e.preventDefault();
        var post_id=$('#postId').val();
        $('#title_edit_error').text('');
        $('#content_edit_error').text('');
        $('#images_edit_error').text('');


        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        var data = new FormData( $( '#post_form_update' )[ 0 ] );

        console.log(data);

        $.ajax({
                method: 'POST',
                enctype: 'multipart/form-data',
                url: 'users/posts/'+post_id,
                data: data,
                dataType:'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function (response)
                 {


                        // first step:reset all inputs

                        $('#title_edit').val('');
                        $('#content_edit').val('');
                        $('#images_edit').val('');
                        // second step: reset all errors
                        $('#title_edit_error').text('');
                        $('#content_edit_error').text('');
                        $('#images_edit_error').text('');

                         // third step :close modal
                         $('#editPostModal').modal('hide');

                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();


                        // fourth step: show success message for 5 seconds
                        $('#success_msg_update').text(response.message);

                        $('#success_msg_update').show();
                        setTimeout(function(){
                            $('#success_msg_update').hide();// or fade, css display however you'd like.
                         }, 5000);

                        //  fifth step : show new post
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


                    $.each(reject.responseJSON.errors, function (key, val) {
                        $("#" + key + "_error").text(val);
                    });


                }
            });
        });






