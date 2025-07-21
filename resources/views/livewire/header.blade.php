<header id="main-header">
    <div class="content">
        <button id="mobile-menu-button" title="باز کردن منو" wire:click="toggleMobileMenu">
            <i class="icon-menu"></i> <!-- فرضاً آیکون‌ها رو با فونت آیکون لود می‌کنی -->
        </button>
        <h2>
            <span>وب سایت شخصی عباس باقری</span>
            <a href="/">
                <img src="{{ asset('images/logo-ba4.svg') }}" alt="وب سایت شخصی عباس باقری" />
            </a>
        </h2>
        <nav id="nav-menu">
            <div class="bg-holder"></div>
            <div class="nav-content" id="nav-menu-list">
                <div class="top-space"></div>
                <ul>
                    @foreach($pages as $page)
                        <li>
                            <a href="{{ $page['href'] }}" title="{{ $page['title'] }}">
                                <i class="icon-{{ $page['icon'] }}"></i>
                                <span>{{ $page['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <ul>
            @foreach($socials as $social)
                <li class="{{ $social['icon'] }}">
                    <a href="{{ $social['href'] }}" title="{{ $social['title'] }}">
                        <i class="icon-{{ $social['icon'] }}"></i>
                    </a>
                </li>
            @endforeach
        </ul>
        <div id="dark-mode" title="انتخاب تم" wire:click="toggleDarkMode">
            <i class="icon-moon-o"></i>
        </div>
    </div>
</header>