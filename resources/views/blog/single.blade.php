@php
    $title = $post->title;
    $description = $post->description;
@endphp
@extends('layouts.primary')

@section('content')
    <div id="header-title">
        <div id="header-title-image" class="cover bg-image">
            <x-image-library-picture :image="Outerweb\ImageLibrary\Models\Image::find($post->image)" conversion="original" fallback-conversion="original" />
        </div>

        <div class="cover" id="particles-js">
            <canvas class="particles-js-canvas-el" width="795" height="230" style="width: 100%; height: 100%;"></canvas>
        </div>
        <div class="cover content-cover">
            <h1>{{ $post->title }}</h1>
        </div>
    </div>

    <div class="header-title-padding-layout">

        <div class="cover content-detail">
            <div class="detail">
                <div class="detail-content">
                    <div class="reading-time">
                        <i class="icon-hourglass"></i>
                        <span>زمان مطالعه : {{ $post->reading_time }} دقیقه</span>
                    </div>
                    <div class="post-options">
                        <ul>
                        <li onclick="sharePost()"><i class="icon-share"></i></li>
                        <li><i class="icon-bookmark-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
            
        <div id="share-post" style="display:none;">
            <div id="share-post-bg" onclick="closeShareModal()"></div>
            <div id="share-content">
                <i class="icon-close" id="close-share-post" onclick="closeShareModal()"></i>
                <h3>اشتراک گذاری مطلب</h3>
                <span onclick="copyLink()">
                <i class="icon-copy" id="share-copy-btn" short-link="{{ route('post.short',['id'=>$post->id]) }}"></i>
                <i class="icon-link"></i>
                <i id="shore-copy-text">{{ route('post.short',['id'=>$post->id]) }}</i>
                </span>
                <h6>یا ارسال لینک از طریق</h6>
                <ul>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-facebook-square"></li>
                    </a>
                    <a href="https://x.com/share?text=نصب نسخه خاص php روی اوبونتو&amp;url={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-x"></li>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;title=نصب نسخه خاص php روی اوبونتو&amp;url={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-linkedin"></li>
                    </a>
                    <a href="https://telegram.me/share/url?url={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-telegram"></li>
                    </a>
                    <a href="https://wa.me/text?url={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-whatsapp"></li>
                    </a>
                    <a href="mailto:?subject=نصب نسخه خاص php روی اوبونتو&amp;body={{ route('post.short',['id'=>$post->id]) }}" target="_blank">
                        <li class="icon-envelope" style="font-size:1.6rem;"></li>
                    </a>
                </ul>
            </div>
        </div>
        <div id="scroll-spinner">
            <div id="scroll-spinner-precent" style="width:0%;"></div>
        </div>
    </div>

    <div class="main-container">
        <div id="post-container">
            <p class="post-description">
                {{ $post->description }}
            </p>
            <div class="post-info">
                <div class="info">
                    <i class="icon-clock"></i>
                    <span>{{ $post->created_at_shamsi }}</span>
                </div>
                <div class="info">
                <i class="icon-user"></i>
                <span>عباس باقری</span>
            </div>
        </div>
        <div class="post-body">
            {!!  $post->body !!}
        </div>
        <i class="icon-arrow-thin-up" id="go-top" style="left:50px;bottom:-100px;"></i>
        <div class="return-back">
            <button id="return-back-btn" onclick="history.back()">
            <i class="icon-arrow-right"></i>
            <span>صفحه قبل</span>
            </button>
        </div>
        </div>
    </div>
@endsection