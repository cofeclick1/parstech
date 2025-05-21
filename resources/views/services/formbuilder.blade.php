<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم‌ساز پیشرفته</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- استایل فرم‌ساز -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.css" integrity="sha512-v1s1n2yi5nV6Xk1h6I1p/4+gRv5e/6l7n5vHj0qJ6JZQw0E6kZ2xwOQ7x8fRr5+3v6Z5r1eW8h6iCj8w5r0e3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { background: #f7f7f7; margin: 0; padding: 0; }
        #fb-editor { background: #fff; margin: 30px auto; max-width: 900px; border-radius: 10px; box-shadow: 0 4px 16px #0001; padding: 24px; }
        .fb-main { direction: rtl !important; }
    </style>
</head>
<body>
    <div id="fb-editor"></div>
    <div style="text-align:center; margin-top:24px;">
        <button id="save-form" class="btn btn-success" style="font-size:1.2em; padding:8px 24px;">ذخیره فرم</button>
    </div>

    <!-- اسکریپت‌ها: اول jQuery، بعد formBuilder -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.js" integrity="sha512-i0VnP5w5Q5N8QXf5XnErHj8WZ7Vw5L1kZQw0E6kZ2xwOQ7x8fRr5+3v6Z5r1eW8h6iCj8w5r0e3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            // آیا پلاگین درست لود شده؟
            if (!$.fn.formBuilder) {
                alert('اشکال در بارگذاری پلاگین formBuilder! اینترنت خود را بررسی کنید یا کش مرورگر را پاک کنید.');
                return;
            }
            var formBuilder = $('#fb-editor').formBuilder({
                disableFields: ['autocomplete', 'hidden'],
                i18n: {
                    locale: 'fa'
                }
            });

            $('#save-form').click(function() {
                var formData = formBuilder.actions.getData('json');
                alert('خروجی فرم (JSON):\n' + formData);
                // اینجا می‌تونی با ajax به سرور بفرستی یا ذخیره کنی
                // $.post('/route-to-save-form', { form: formData, _token: '{{ csrf_token() }}' });
            });
        });
    </script>
</body>
</html>
