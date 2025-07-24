
@php
    $title = 'نوشته‌های  عباس باقری';
    $description = "مطالب عباس  باقری، برنامه نویس و طراح حرفه‌ای سایت";
@endphp
@extends('layouts.primary')
@section('content')

    @include('layouts.headerTitle', [
        'title' => 'نوشته‌های من',
        'description' => 'معمولا در مورد چیزهای مختلف می‌نویسم...',
    ])

    <div id="blog-list">
        <div class="content">
        <div class="section-title-container">
            <div class="section-title">
                <div class="line"></div>
                <div class="radius">
                    <div class="inner-radius"></div>
                </div>
                <h2>جدیدترین نوشته‌ها</h2>
            </div>
        </div>
        <section id="blog-section">
            @foreach ($posts as $post)
                <article class="item">
                    <a 
                        href="/blog/{{ $post->id }}/{{ $post->slug ?? App\Helpers\SlugHelper::makeUniqueSlug($post->title) }}" 
                        title="{{ $post->title }}"
                        ajax
                    >
                        <div class="article">
                            <div class="thum-holder">
                                <x-image-library-picture :image="Outerweb\ImageLibrary\Models\Image::find($post->thumbnail)" conversion="original" fallback-conversion="original" />
                            </div>
                            <div class="post-title">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit($post->description, 100) }}</p>
                            </div>
                            <div class="detail">
                                <i class="icon-clock"></i>
                                <span>{{ $post->created_at_shamsi }}</span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </section>
        @include('layouts.pager')
    </div>
@endsection