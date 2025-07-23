tinymce.PluginManager.add('iframe', function(editor, url) {
    editor.ui.registry.addButton('iframe', {
        text: 'iframe',
        icon: 'embed-page', // یا آیکون دلخواه
        onAction: function() {
            editor.windowManager.open({
                title: 'درج iframe',
                body: {
                    type: 'panel',
                    items: [
                        {
                            type: 'input',
                            name: 'iframeUrl',
                            label: 'URL ویدیو (مثل اپارات)'
                        },
                        {
                            type: 'input',
                            name: 'width',
                            label: 'عرض',
                            value: '560'
                        },
                        {
                            type: 'input',
                            name: 'height',
                            label: 'ارتفاع',
                            value: '315'
                        }
                    ]
                },
                buttons: [
                    {
                        type: 'submit',
                        text: 'تأیید'
                    },
                    {
                        type: 'cancel',
                        text: 'لغو'
                    }
                ],
                onSubmit: function(api) {
                    var data = api.getData();
                    var iframeHtml = `<iframe src="${data.iframeUrl}" width="100%" frameborder="0" allowfullscreen></iframe>`;
                    editor.insertContent(iframeHtml);
                    api.close();
                }
            });
        }
    });

    return {
        getMetadata: function() {
            return {
                name: 'پلاگین درج iframe',
                url: 'https://example.com'
            };
        }
    };
});