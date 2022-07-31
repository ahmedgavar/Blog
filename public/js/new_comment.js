
        // 3 add comment to database
        $('.add_comment').on('submit',function(e){

            e.preventDefault();
            const post_id=$(this).attr('data-postId');
            const comment_id=Number( $(this).attr('data-commentId'))+1;
            const comment=$('#comment_input'+post_id).val();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });



            $.ajax({

                method: 'POST',

                url: '/users/comments',
                data:{
                    'comment':comment,
                    'post_id':post_id
                },
                dataType:'json',

                success:  (response)=> {
                    // hide message for no comment
                    $('#no_comment_div').hide();
                    // show new comment
                    $('#show_comments'+post_id).append(`<div>${comment}</div>`);
                    // empty input
                    $('#comment_input'+post_id).val('');
                    // show success message
                    toastr.success(response.message);


                    // start
                    $.ajax({
                        method: 'GET',
                        url: 'http://localhost:8000/users/comments/'+comment_id,
                        dataType:'json',

                        success: function (response)
                         {

                            const current_comment=response.responseText;

                            console.log(response);
                            $('#show_comments'+post_id).append(current_comment);



                        }
                        ,error: function(reject){
                        console.log(reject);
                        }

                    });

                    // end


                }
            , error: function (reject) {
                console.log(reject);


                   
                    // show error message for 5 seconds
                    const message= reject.responseJSON?reject.responseJSON.errors? reject.responseJSON.errors.comment?reject.responseJSON.errors.comment[0]:'':'':'';

                    $('#comment_error'+post_id).text(message);
                    setTimeout(function(){
                        $('#comment_error'+post_id).hide();// or fade, css display however you'd like.
                     }, 5000);



                }
            });
        });

