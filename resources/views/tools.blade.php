
@php
    $title = 'ابزارهای کاربردی';
    $description = "لیستی از ابزارهای کاربردی ساخته شده توسط عباس  باقری";
@endphp
@extends('layouts.primary')
@section('content')

    @include('layouts.headerTitle', [
        'title' => $title,
        'description' => $description,
    ])

    <div id="blog-list">
        <div class="content">
            <section id="blog-section">
                @foreach ($tools as $tool)
                    <article class="item">
                            <div class="article">
                                <div class="thum-holder">
                                    <x-image-library-picture :image="Outerweb\ImageLibrary\Models\Image::find($tool->image_id)" conversion="original" fallback-conversion="original" />
                                </div>
                                <div class="post-title">
                                    <h3>{{ $tool->name }}</h3>
                                    <p>{{ $tool->description }}</p>
                                </div>
                                <div class="py-4 px-3 mt-4">
                                    <a 
                                        href="{{ $tool->link }}" 
                                        target="_blank" 
                                        class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-yellow-600 text-white rounded font-medium hover:bg-yellow-700 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                        مشاهده در مرورگر
                                    </a>
                                </div>
                            </div>
                    </article>
                @endforeach
            </section>
        </div>
    </div>
@endsection