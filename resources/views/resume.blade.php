@php
    $title = "رزومه عباس باقری";
    $description = "رزومه کاری عباس باقری در زمینه برنامه نویسی وب و مهندس نرم افزار";
@endphp
@extends('layouts.primary')

@section('content')
    @include('layouts.headerTitle', [
                'title' => 'رزومه عباس باقری',
                'description' => 'در این صفحه اطلاعات کاری اینجانب قرار خواهد گرفت',
    ])
    @include('home.aboutMe')
    @include('home.myJobs')
    @include('home.mySkills')
    @include('home.contactMe')
@endsection