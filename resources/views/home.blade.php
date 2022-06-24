@extends('layouts.master')

@section('content')
    @include('layouts.User.header')
    @include('layouts.User.banner')

    @include('layouts.User.some_divs')
    @include('layouts.User.about')

    @include('layouts.User.blog')

    @include('layouts.User.news_letter')
    @include('layouts.User.recent')


    @include('layouts.User.contact')
    @include('layouts.User.footer')
    @include('layouts.User.copyright')



@endsection
