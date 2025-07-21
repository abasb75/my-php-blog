<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $isDarkMode = true; // پیش‌فرض دارک‌مود

    public $socials = [
        ['icon' => 'telegram', 'title' => 'گفت و گو در تلگرام', 'href' => 'https://telegram.me/989015827703'],
        ['icon' => 'github', 'title' => 'گیت‌هاب', 'href' => 'https://github.com/abasb75'],
        ['icon' => 'virgool', 'title' => 'پست‌های من در ویرگول', 'href' => 'https://virgool.io/@abasb75'],
    ];

    public $pages = [
        ['href' => '/', 'title' => 'صفحه اصلی', 'label' => 'خانه', 'icon' => 'home'],
        ['href' => '/resume', 'title' => 'رزومه عباس باقری', 'label' => 'رزومه', 'icon' => 'profile'],
        ['href' => '/contact', 'title' => 'راه‌های ارتباطی با عباس باقری', 'label' => 'ارتباط', 'icon' => 'phone'],
        ['href' => '/blog', 'title' => 'نوشته‌های عباس باقری', 'label' => 'نوشته‌ها', 'icon' => 'feather'],
        ['href' => '/work-samples', 'title' => 'نمونه کارهای عباس باقری', 'label' => 'نمونه‌کارها', 'icon' => 'folder'],
    ];

    public function toggleDarkMode()
    {
        $this->isDarkMode = !$this->isDarkMode;
    }

    public function render()
    {
        return view('livewire.header');
    }
}