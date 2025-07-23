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
                    var iframeHtml = `<div class="iframe">
                        <iframe src="${data.iframeUrl}" width="100%" frameborder="0" allowfullscreen sandbox="allow-scripts"></iframe>
                    </div>`;
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