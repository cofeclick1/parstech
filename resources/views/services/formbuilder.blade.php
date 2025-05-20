<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم‌ساز پیشرفته</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- استایل فرم‌ساز -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.css" />
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.js"></script>
    <script>
        $(function() {
            var formBuilder = $('#fb-editor').formBuilder({
                disableFields: ['autocomplete', 'hidden'], // می‌تونی فیلدهای دلخواه رو حذف یا اضافه کنی
                i18n: {
                    locale: 'fa' // برای راست‌چین و فارسی‌سازی (در صورت نیاز میشه کامل فارسیش کرد)
                }
            });

            $('#save-form').click(function() {
                var formData = formBuilder.actions.getData('json');
                // اینجا می‌تونی با ajax به سرور بفرستی یا ذخیره کنی
                alert('خروجی فرم (JSON):\n' + formData);
                // برای ذخیره سمت سرور می‌تونی اینجا ajax بزنی
                // $.post('/route-to-save-form', { form: formData, _token: '{{ csrf_token() }}' });
            });
        });
    </script>
    <!-- در انتهای فایل blade، قبل از </body> اینها رو بذار -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.css" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/formBuilder/3.11.7/form-builder.min.js"></script>

</body>
</html>


