@extends('layouts.master')

@section('content')

    @include('layouts.User.header')

    @include('layouts.User.flash_create_success')

    @include('layouts.User.banner')


    @include('layouts.User.some_divs')


    @include('layouts.User.show_posts')


    @include('layouts.User.contact')
    @include('layouts.User.footer')
    @include('layouts.User.copyright')



    @include('posts.create')
    @include('posts.edit')
    @include('posts.delete')




@endsection

@section('scripts')


<script src="{{ asset('js/new_post.js') }}" defer>
</script>


<script src="{{ asset('js/update_post.js') }}" defer>


</script>
<script src="{{ asset('js/delete_post.js') }}" defer>
</script>
@endsection
