<?php

return [
    'version' => [
        'tiny' => '7.3.0',
        'language' => [
            // https://cdn.jsdelivr.net/npm/tinymce-i18n@latest/
            'version' => '24.7.29',
            'package' => 'langs7',
        ],
        'licence_key' => env('TINY_LICENSE_KEY', 'no-api-key'),
    ],
    'provider' => 'cloud', // cloud|vendor
    // 'direction' => 'rtl',
    /**
     * change darkMode: 'auto'|'force'|'class'|'media'|false|'custom'
     */
    'darkMode' => 'auto',

    /** cutsom */
    'skins' => [
        // oxide, oxide-dark, tinymce-5, tinymce-5-dark
        'ui' => 'oxide',

        // dark, default, document, tinymce-5, tinymce-5-dark, writer
        'content' => 'default'
    ],

    'profiles' => [
        'default' => [
            'plugins' => 'accordion autoresize codesample directionality advlist link image lists preview pagebreak searchreplace wordcount code fullscreen insertdatetime media iframe table emoticons',
            'toolbar' => 'undo redo removeformat | fontfamily fontsize fontsizeinput font_size_formats styles | bold italic underline | rtl ltr | alignjustify alignleft aligncenter alignright | numlist bullist outdent indent | forecolor backcolor | blockquote table toc hr | image link media iframe code codesample emoticons | wordcount fullscreen',
            'upload_directory' => null,
                
            'custom_configs' => [
                'extended_valid_elements' => 'iframe[src|width|height|frameborder|allow|allowfullscreen|sandbox]',
                'external_plugins' => [
                    'iframe' => '/tinymce/iframe.js',
                ],
                'valid_elements' => '*[*]', // اجازه دادن به همه تگ‌ها و ویژگی‌ها (اختیاری، با احتیاط)
                'sandbox_iframes' => false, // غیرفعال کردن sandbox پیش‌فرض
                'convert_urls' => false, // جلوگیری از تبدیل URLها
                'allow_script_urls' => true, // اجازه دادن به URLهای اسکریپت
                'allow_conditional_comments' => true,
                'codesample_languages' => [
                    ['text' => 'HTML/XML', 'value' => 'html'],
                    ['text' => 'JavaScript', 'value' => 'javascript'],
                    ['text' => 'CSS', 'value' => 'css'],
                    ['text' => 'PHP', 'value' => 'php'],
                    ['text' => 'Python', 'value' => 'python'],
                    ['text' => 'Java', 'value' => 'java'],
                    ['text' => '.htaccess', 'value' => 'apache'],
                    ['text' => 'Shell', 'value' => 'bash'],
                    ['text' => 'Docker', 'value' => 'docker'],
                    ['text' => 'JSON', 'value' => 'json'],
                    ['text' => 'YAML', 'value' => 'yml'],
                    ['text' => 'INI', 'value' => 'ini'],
                ],

            ]
        ],

        'simple' => [
            'plugins' => 'autoresize directionality emoticons link wordcount',
            'toolbar' => 'removeformat | bold italic | rtl ltr | numlist bullist | link emoticons',
            'upload_directory' => null,
        ],

        'minimal' => [
            'plugins' => 'link wordcount',
            'toolbar' => 'bold italic link numlist bullist',
            'upload_directory' => null,
        ],

        'full' => [
            'plugins' => 'accordion autoresize codesample directionality advlist autolink link image lists charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons help',
            'toolbar' => 'undo redo removeformat | fontfamily fontsize fontsizeinput font_size_formats styles | bold italic underline | rtl ltr | alignjustify alignright aligncenter alignleft | numlist bullist outdent indent accordion | forecolor backcolor | blockquote table toc hr | image link anchor media codesample emoticons | visualblocks print preview wordcount fullscreen help',
            'upload_directory' => null,
        ],
    ],

    /**
     * this option will load optional language file based on you app locale
     * example:
     * languages => [
     *      'fa' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@24.7.29/langs7/fa.min.js',
     *      'es' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@24.7.29/langs7/es.min.js',
     *      'ja' => asset('assets/ja.min.js')
     * ]
     */
    'languages' => [],

    'extra' => [
        'toolbar' => [
            // 'fontsize' => '10px 12px 13px 14px 16px 18px 20px',
            // 'fontfamily' => 'Tahoma=tahoma,arial,helvetica,sans-serif;',
        ]
    ]
];
