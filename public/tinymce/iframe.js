tinymce.PluginManager.add('iframe', function (editor, url) {
    editor.ui.registry.addButton('iframe', {
        text: 'iframe',
        icon: 'embed-page', // یا آیکون دلخواه
        onAction: function () {
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
                onSubmit: function (api) {
                    var data = api.getData();
                    // تولید یک ID یکتا برای iframe
                    var iframeId = 'iframe_' + Math.random().toString(36).substr(2, 9);
                    // HTML برای iframe و دکمه‌ها
                    var iframeHtml = `
                        <div class="iframe">
                            <iframe id="${iframeId}" src="${data.iframeUrl}" width="100%" frameborder="0" allowfullscreen sandbox="allow-scripts allow-same-origin"></iframe>
                            <div class="iframe-controls">
                                <button class="iframe-refresh" onclick="document.getElementById('${iframeId}').src = document.getElementById('${iframeId}').src;">رفرش</button>
                                <button class="iframe-open-tab" onclick="window.open('${data.iframeUrl}', '_blank');">باز کردن در تب جدید</button>
                            </div>
                        </div>
                    `;
                    editor.insertContent(iframeHtml);
                    api.close();
                }
            });
        }
    });

    return {
        getMetadata: function () {
            return {
                name: 'پلاگین درج iframe',
                url: 'https://example.com'
            };
        }
    };
});