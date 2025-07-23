<p>ابتدا باید دستورات update و upgrade را در ترمینال اجرا کرد. ما برای راه اندازی وب سرور از ابونتو 22.04 استفاده کردیم.</p>
<p><pre class="language-bash"><code> sudo apt update &amp; upgrade clear     </code></pre></p>
<h3>1. نصب وب سرور</h3>
<p>ما میتوانیم از وب سرورهای مختلفی همچون آپاچی، nginx و ... استفاده کنیم. ما nginx را انتخاب کردیم. برای نصب nginx کافیست دستورات زیر را در ترمینال وارد کنیم.</p>
<p><pre class="language-bash"><code> sudo apt install nginx     </code></pre></p>
<p>اکنون با وارد کردن ip سرور خود در مرورگر باید صفحه زیر به شما نمایش داده شود.</p>
<div class="post_image"><img src="/asset/image/post/16/body/nginx-welcome.JPG" alt="راه اندازی nginx در ابونتو"></div>
<p>البته حالتی هم جود دارد که فایروال مجوز دسترسی nginx به بیرون را ندهد. برای حل این موضوع باید فایروال را تنظیم کنید.</p>
<h3>2. تنظیم فایروال</h3>
<p>ابتدا فایروال را فعال میکنیم.</p>
<p><pre class="language-bash"><code> sudo ufw enable     </code></pre></p>
<div class="post_image"><img src="/asset/image/post/16/body/26_firewall_enable.JPG" alt="فعال کردن فایروال در ابونتو"></div>
<p>ممکن است بعد از فعال کردن فایروال نتوانیم از طریق ip صفحه apache را مشاهده کنیم.</p>
<p>توجه کنید: ممکن است بعد از وارد کردن این دستور ارتباط ssh شما با سرور قطع شود. یا در دفعات بعد نتوانید با putty به سرور متصل شوید. برای این امر در ترمینال دستور زیر را وارد کنید .</p>
<p><pre class="language-bash"><code> sudo ufw allow 22/tcp     </code></pre></p>
<p>برای دسترسی nginx به بیرون از سرور ممکن است نیازمند باز کردن پورت توسط فایروال باشیم. برای مشاهده لیست برنامه هایی که نیازمند مجوز فایروال هستند دستور زیر را وارد میکنیم.</p>
<p><pre class="language-bash"><code> sudo ufw app list     </code></pre></p>
<p>قاعدتا باید با چنین لیستی روبرو شویم.</p>
<div class="post_image"><img src="/asset/image/post/16/body/firewall-list.JPG" alt="لیست برنامه های منتظر تایید فایروال در ابونتو"></div>
<p>با دستور زیر به nginx روی پورت 80 مجوز دسترسی میدهیم.</p>
<p><pre class="language-bash"><code> sudo ufw allow 'Nginx Full'    </code></pre></p>
<div class="post_image"><img src="/asset/image/post/16/body/firewall-enable-nginx.JPG" alt="فعال کردن nginx روی فایروال"></div>
<p>اکنون اگر دستور زیر را در ترمینال وارد کنید، باید با چنین صحنه ای مواجه شوید که nginx به پورت 80 مجوز دسترسی دارد. همچنین دوباره قادر خواهید بود صفحه nginx در مرورگر را مشاهده کنید.</p>
<h3>3. nginx در سرویسهای ابونتو</h3>
<p>برای غیر فعال کردن nginx روی سرور از دستور زیر استفاده میکنیم.</p>
<p><pre class="language-bash"><code> sudo systemctl stop nginx     </code></pre></p>
<p>همچنین برای فعال کردن nginx از دستور زیر استفاده میکنیم.</p>
<p><pre class="language-bash"><code> sudo systemctl start nginx     </code></pre></p>
<p>برای ری استارت یا راه اندازی مجدد nginx هم از دستور زیر استفاده میکنیم.</p>
<p><pre class="language-bash"><code> sudo systemctl restart nginx     </code></pre></p>
<h3>4. نصب php روی سرور</h3>
<p>ابتدا php-fpm را نصب میکنیم.</p>
<p><pre class="language-bash"><code> sudo apt install php-fpm     </code></pre></p>
<p>باید مقدار cgi.fix_pathinfo را در فایل php.ini پیدا کنیم. دقت کنید که در حال حاضر نسخه 8.1 پی اچ پی روی سرور من نصب شده است.</p>
<p><pre class="language-bash"><code> sudo nano /etc/php/8.1/fpm/php.ini     </code></pre></p>
<p>cgi.fix_pathinfo را در این فایل پیدا میکنیم. با حذف علامت ; قبل از آن از حالت کامنت خارج میکنیم. همیچین مقدار آنرا برابر با 1 قرار میدهیم.</p>
<div class="post_image"><img src="/asset/image/post/16/body/php-fm-installtion-php-ini.JPG" alt="cgi.fix_pathinfo"></div>
<p><pre class="language-bash"><code> cgi.fix_pathinfo=1     </code></pre></p>
<p>سپس php-fpm را ریاستارت مجدد میکنیم.</p>
<p><pre class="language-bash"><code> sudo systemctl restart php7.0-fpm     </code></pre></p>
<h3>5. فعال کردن php روی nginx</h3>
<p>وارد پوشه /var/www/html میشویم.</p>
<p><pre class="language-bash"><code> cd /var/www/html ls     </code></pre></p>
<p>فایل index.nginx-debian.html را با index.php جایگزین میکنیم.</p>
<p>فایل index.php :</p>
<p><pre class="language-bash"><code> &lt;?php echo 'hello !!!' ?&gt;     </code></pre></p>
<p>اکنون اگر دامنه یا ip سرور خود را در مرورگر وارد کنیم با تصویر زیر روبرو میشویم.</p>
<div class="post_image"><img src="/asset/image/post/16/body/nginx-403.JPG" alt="صفحه 403 nginx"></div>
<p>برای اجرای پردازشهای php نیازمند تغییر در کانفیگهای nginx هستیم. دستور زیر را در ترمینال وارد میکنیم:</p>
<p><pre class="language-bash"><code> sudo nano /etc/nginx/sites-available/default     </code></pre></p>
<p>در این فایل index.php را به لیست index ها اضافه میکنیم.</p>
<div class="post_image"><img src="/asset/image/post/16/body/add-index-php-to-nginx-index.JPG" alt="اضافه کردن index.php به index در nginx"></div>
<p>همچنین در این فایل باید قیسمت های زیر را از حالت کامنت خارج کنیم. همچنین دقت کنید نسخه php هم درست تنظیم شود. 7.4 پیشفرض را من به 8.1 تغییر دادم.</p>
<div class="post_image"><img src="/asset/image/post/16/body/enable-php-processing-in-nginx.JPG" alt="فعالسازی php در nginx"></div>
<div class="post_image"><img src="/asset/image/post/16/body/enable-php-processing-in-nginx-uncommnted.JPG" alt="فعالسازی php در nginx"></div>
<p>سپس دستور زیر را در ترمینال وارد کنید تا تغییرات اعمال شود.</p>
<p><pre class="language-bash"><code> sudo nginx -t sudo systemctl reload nginx     </code></pre></p>
<p>میتوانیم محتوای و فایلهای سایت خود را در پوشه /var/www/html قرار دهیم. و آنرا در اینترنت روی مرورگر مشاهده کنیم.</p>
<h3>6. نصب mysql</h3>
<p>برای وب سایت خود قاعدتا نیاز به پایگاه داده خواهیم داشت. در php معمولا از پایگاه داده mysql استفاده میشود به همین خاطر باید mysql را هم نصب کنیم.</p>
<p><pre class="language-bash"><code> sudo apt install mysql-server -y     </code></pre></p>
<p>بعد از نصب mysql نیاز به تعیین یک رمز عبور برای کاربر root داریم که از دستورات زیر استفاده میکنیم.</p>
<p><pre class="language-bash"><code> sudo mysql &gt;&gt; ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'mynewpassword';     </code></pre></p>
<p>رمز عبور خود را بجای mynewpassword قرار دهید که باید شامل حروف بزرگ و کوچک ، اعداد و کاراکترهایی مثل @ باشد.</p>
<p>برای اتصال به دیتابیس mysql در php پکیج php-mysql را نصب میکنیم.</p>
<p><pre class="language-bash"><code> sudo apt install php-mysql     </code></pre></p>
<p><a href="/p/15">راه اندازی وب سرور آپاچی، php ، mysql روی ابونتو</a></p>