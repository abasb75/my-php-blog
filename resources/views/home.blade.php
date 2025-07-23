@extends('layouts.primary')

@section('meta')

    
@endsection

@section('content')
    <div id="home">
        @include('home.welcome')
        @include('home.aboutMe')
        @include('home.myJobs')
        @include('home.mySkills')
        @include('home.contactMe')
        @include('home.lastPosts')
    </div>
@endsection