
/*
1_ using ajax to save new post
2_ use jquery to show images before uploading

*/
// first task is about create post
$('#post_form').on('submit', function (e) {
        e.preventDefault();
        $('#title_error').innerHtml="";
        $('#content_error').innerHtml="";
        $('#images_error').innerHtml="";


        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        // var formData=$('#post_form').serialize();
        var data = new FormData( $( '#post_form' )[ 0 ] );


        console.log(data);

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
                        $('#title_error').innerHtml="";
                        $('#content_error').innerHtml="";
                        $('#images_error').innerHtml="";


                        // third step :close modal
                        $('#createPostModal').modal('hide');
                        $('#createPostModal').removeClass('fade');
                        $('#createPostModal').removeClass('show');

                        $(".modal-backdrop").remove();
                        $('body').removeClass('modal-open');







                }
                , error: function (reject) {


                    $.each(reject.responseJSON.errors, function (key, val) {
                        $("#" + key + "_error").text(val);
                    });


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
