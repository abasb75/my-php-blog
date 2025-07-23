@php
    $title = 'ارتباط با عباس باقری';
    $description = "راه‌های ارتباطی با مهندس عباس باقری، برنامه نویس و طراح  وب";
@endphp
@extends('layouts.primary')
@section('content')
    @include('layouts.headerTitle', [
        'title' => 'ارتباط با عباس باقری',
        'description' => 'پیام شما پاسخ داده خواهد شد.',
    ])
    @include('home.contactForm')
    @include('home.contactMe')
@endsection