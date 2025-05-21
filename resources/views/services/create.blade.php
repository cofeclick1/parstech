@extends('layouts.app')

@section('title', 'افزودن خدمت جدید')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/service-create.css') }}">
    <style>
        .switch-edit-code {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .code-manual-input {
            display: none;
        }
        .switch-edit-code input[type="checkbox"]:checked ~ .code-manual-input {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
<section class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fa fa-plus-circle me-2"></i>افزودن خدمت جدید
                    </h4>
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

                        <!-- نام خدمت -->
                        <div class="mb-3">
                            <label for="title" class="form-label required">نام خدمت</label>
                            <input type="text" name="title" id="title" class="form-control" required autofocus value="{{ old('title') }}">
                        </div>

                        <!-- کد خدمت با سوییچ تولید خودکار یا دستی -->
                        <div x-data="{ customCode: false }">
                            <label>
                                <input type="checkbox" x-model="customCode">
                                کد دلخواه وارد شود
                            </label>
                            <div x-show="customCode">
                                <label for="service_code">کد خدمت</label>
                                <input type="text" name="service_code" id="service_code" class="form-control" value="{{ old('service_code') }}">
                                <span>کد دلخواه را وارد کنید</span>
                            </div>
                            <div x-show="!customCode">
                                <label for="service_code_generated">کد خدمت (پیشفرض)</label>
                                <input type="text" name="service_code_generated" id="service_code_generated" class="form-control" value="{{ $generatedCode ?? '' }}" readonly>
                                <span>کد پیشفرض به صورت خودکار تولید می‌شود مانند: services-1</span>
                            </div>
                        </div>

                        <!-- تصویر خدمت -->
                        <div class="mb-3">
                            <label for="image" class="form-label">تصویر خدمت</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        <!-- اطلاعات خدمات -->
                        <div class="mb-3">
                            <label for="service_info" class="form-label">اطلاعات خدمات</label>
                            <input type="text" name="service_info" id="service_info" class="form-control" value="{{ old('service_info') }}">
                        </div>

                        <select name="service_category_id" id="service_category_id" class="form-select">
                            <option value="">انتخاب کنید</option>
                            @foreach($serviceCategories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ old('service_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <!-- توضیحات کوتاه -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">توضیح کوتاه</label>
                            <input type="text" name="short_description" id="short_description" class="form-control" maxlength="255" value="{{ old('short_description') }}">
                        </div>

                        <!-- توضیحات -->
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea name="description" id="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                        </div>

                        <!-- لینک یا صفحه اطلاعات گرفته شده (باکس متن) -->
                        <div class="mb-3">
                            <label for="info_link" class="form-label">صفحه/لینک اطلاعات گرفته شده</label>
                            <textarea name="info_link" id="info_link" class="form-control" rows="2">{{ old('info_link') }}</textarea>
                        </div>

                        <!-- توضیحات کامل -->
                        <div class="mb-3">
                            <label for="full_description" class="form-label">توضیحات کامل</label>
                            <textarea name="full_description" id="full_description" class="form-control" rows="5">{{ old('full_description') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-save me-1"></i>ثبت خدمت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/service-create.js') }}"></script>

<script>
    function toggleManualCode(checkbox) {
        const codeInput = document.getElementById('service_code');
        const manualInput = document.getElementById('service_code_manual');
        if (checkbox.checked) {
            codeInput.readOnly = false;
            manualInput.disabled = false;
            manualInput.style.display = 'inline-block';
            codeInput.style.display = 'none';
        } else {
            codeInput.readOnly = true;
            manualInput.disabled = true;
            manualInput.style.display = 'none';
            codeInput.style.display = 'inline-block';
        }
    }
</script>
@endsection
