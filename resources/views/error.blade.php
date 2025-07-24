@php
    $title = $title ?? 'خطایی رخ داده است';
    $description = $description ?? 'عباس باقری، برنامه‌نویس و طراح حرفه‌ای سایت';
    $errorCode = $errorCode ?? 'خطا';
@endphp
@extends('layouts.primary')

@section('content')
<div id="error-container">
    <div id="particles-js"><canvas class="particles-js-canvas-el" width="800" height="621" style="width: 100%; height: 100%;"></canvas></div>
    <div class="content">
        <div>
            <span>{{ $errorCode }}</span>
            <h1>{{ $description }}</h1>
        </div>
    </div>
</div>
@endsection