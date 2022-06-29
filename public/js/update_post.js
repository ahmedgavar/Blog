

    $('#editPostModal').on('show.bs.modal',function(event){


        // this following line solved problem gray background when opening modal
        $(this).appendTo("body");
        //  End solve gray background when opening modal

        var button=$(event.relatedTarget);
        var title=button.data('title');
        var content=button.data('content');
        var postEditId=button.data('id');

        $('#title_edit').val(title);
        $('#content_edit').val(content);
        $('#postId').val(postEditId);


    });

    // second task
    $('#post_form_update').on('submit', function (e)
    {
        e.preventDefault();
        var post_id=$('#postId').val();
        $('#title_edit_error').innerHtml="";
        $('#content_edit_error').innerHtml="";
        $('#images_edit_error').innerHtml="";


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
                        $('#title_edit_error').innerHtml="";
                        $('#content_edit_error').innerHtml="";
                        $('#images_edit_error').innerHtml="";


                         // third step :close modal
                         $('#editPostModal').modal('hide');

                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();




                        // fourth step: show success message for 5 seconds
                        $('#success_msg_update').show();
                        setTimeout(function(){
                            $('#success_msg_update').hide();// or fade, css display however you'd like.
                         }, 3000);



                }
                , error: function (reject) {


                    $.each(reject.responseJSON.errors, function (key, val) {
                        $("#" + key + "_error").text(val);
                    });


                }
            });
        });






