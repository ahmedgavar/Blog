@extends('layouts.master')

@section('content')

    @include('layouts.User.header')


    {{-- show success message when creating post --}}
    @if (session('create_status'))
    <div class="alert alert-success" id="success_create_update_msg">
        {{ session('create_status') }}
    </div>
    @endif
    {{-- end show success message when creating post --}}

    @include('layouts.User.banner')

    @include('layouts.User.some_divs')
    @include('layouts.User.about')

    @include('layouts.User.blog')

    @include('layouts.User.recent')


    @include('layouts.User.contact')
    @include('layouts.User.footer')
    @include('layouts.User.copyright')
    @include('User.create')



@endsection

@section('scripts')


<script src="{{ asset('js/new_post.js') }}" defer>

</script>
@endsection
