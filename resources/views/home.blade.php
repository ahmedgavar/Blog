@extends('layouts.master')

@section('content')

    @include('layouts.User.header')

    @include('layouts.User.flash_create_success')

    @include('layouts.User.banner')


    @include('layouts.User.some_divs')
    < x-notification-message />

    @include('layouts.User.show_posts')


    @include('layouts.User.contact')
    @include('layouts.User.footer')
    @include('layouts.User.copyright')



    @include('posts.create')
    @include('posts.edit')
    @include('posts.delete')




@endsection

@section('scripts')


<script
    src="{{ asset('js/new_post.js') }}" defer>
</script>


<script
     src="{{ asset('js/update_post.js') }}" defer>

</script>



<script
    src="{{ asset('js/delete_post.js') }}" defer>
</script>


<script
    src="{{ asset('js/new_comment.js') }}" defer>
</script>



{{-- for laravel tinymce --}}

<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({

      selector: 'textarea#new_comment',

    });
  </script>

{{-- end  laravel tinymce --}}
{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

function updateSetting(_this) {

    toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };
{{-- end toastr --}}

@auth

@endauth

@endsection
