<div id="home-latest-post">
    <div class="content">
        <div class="section-title">
            <div class="line"></div>
            <div class="radius">
                <div class="inner-radius"></div>
            </div>
            <h2>نوشته‌های تازه</h2>
        </div>
        <div class="list">
            @foreach ($posts as $post)
                <article class="item">
                    <a 
                        href="/blog/{{ $post->id }}/{{ $post->slug }}" 
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
        </div>
        <div class="button">
            <a href="/blog" ajax>
                <span>موارد بیشتر</span>
                <i class="icon-arrow-left"></i>
            </a>
        </div>
    </div>
</div>