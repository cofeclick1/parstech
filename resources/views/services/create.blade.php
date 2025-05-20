@extends('layouts.app')

@section('title', 'افزودن خدمت جدید')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/service-create.css') }}">
@endsection

@section('content')
<section class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fa fa-plus-circle me-2"></i>افزودن خدمت جدید</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <!-- عنوان خدمت -->
                        <div class="mb-3">
                            <label for="title" class="form-label required">عنوان خدمت <span class="text-muted fs-7">(مثال: ثبت‌نام خودرو، پرداخت قبض، تعمیر موبایل)</span></label>
                            <input type="text" name="title" id="title" class="form-control" required autofocus value="{{ old('title') }}">
                        </div>

                        <!-- دسته‌بندی خدمت -->
                        <div class="mb-3">
                            <label for="category" class="form-label">دسته‌بندی خدمت</label>
                            <select name="category_id" id="category" class="form-select">
                                <option value="">انتخاب کنید</option>
                                @foreach($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- قیمت خدمت -->
                        <div class="mb-3">
                            <label for="price" class="form-label required">قیمت خدمت (تومان)</label>
                            <input type="number" name="price" id="price" class="form-control" required min="0" value="{{ old('price') }}">
                        </div>

                        <!-- توضیحات کوتاه -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">توضیح کوتاه (اختیاری)</label>
                            <input type="text" name="short_description" id="short_description" class="form-control" maxlength="255" value="{{ old('short_description') }}">
                        </div>

                        <!-- توضیحات کامل -->
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات کامل (اختیاری)</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <!-- آپلود تصویر خدمت (اختیاری) -->
                        <div class="mb-3">
                            <label for="image" class="form-label">تصویر خدمت (اختیاری)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-save me-1"></i>ثبت خدمت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="alert alert-info mt-4">
                <strong>راهنما:</strong>
                <ul class="mb-1">
                    <li>برای خدمات کافی‌نت و کامپیوتر نیازی به وارد کردن تعداد نیست. فقط عنوان و قیمت را وارد کنید.</li>
                    <li>در صورت تمایل، توضیحات بیشتر یا تصویر برای خدمت اضافه کنید.</li>
                    <li>لیست خدمات پیشنهادی: ثبت‌نام وام، ثبت‌نام خودرو، تمدید بیمه، تعمیر سخت‌افزاری و نرم‌افزاری، شارژ سیم‌کارت و...</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <!-- اگر نیاز به اسکریپت خاصی بود، اینجا اضافه کنید -->
@endsection
