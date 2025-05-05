document.addEventListener('DOMContentLoaded', function () {
    // پیام موفقیت یا خطا از session
    let success = "{{ session('success') }}";
    let error = "{{ session('error') }}";
    if (success) {
        Swal.fire({
            title: 'موفق!',
            text: success,
            icon: 'success',
            confirmButtonText: 'باشه'
        });
    }
    if (error) {
        Swal.fire({
            title: 'خطا!',
            text: error,
            icon: 'error',
            confirmButtonText: 'باشه'
        });
    }
});
