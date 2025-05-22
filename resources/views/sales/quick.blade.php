@extends('layouts.app')

@section('head')
    <title>فروش سریع</title>
    <link rel="stylesheet" href="{{ asset('css/products-list.css') }}">
    <style>
        .quick-sale-title { font-size: 1.5rem; font-weight: bold; }
        .quick-sale-form .form-control { font-size: 1rem; }
    </style>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span class="quick-sale-title">ثبت فروش سریع</span>
            <a href="{{ route('sales.index') }}" class="btn btn-outline-primary btn-sm">لیست فاکتورها</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </div>
            @endif

            <form id="quick-sale-form" class="quick-sale-form" method="POST" action="{{ route('sales.quick.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>شماره فاکتور</label>
                        <input type="text" name="invoice_number" class="form-control" value="{{ $nextNumber }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>فروشنده</label>
                        <select name="seller_id" class="form-control" required>
                            <option value="">انتخاب کنید...</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>
                                    {{ $seller->first_name . ' ' . $seller->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>واحد پول</label>
                        <select name="currency_id" class="form-control" required>
                            <option value="">انتخاب کنید...</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>
                                    {{ $currency->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- محصولات و خدمات --}}
                <div class="mb-3">
                    <label for="products_input">انتخاب محصولات/خدمات</label>
                    <div id="products-area">
                        <table class="table table-bordered table-sm" id="products-table">
                            <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>تعداد</th>
                                    <th>قیمت واحد</th>
                                    <th>تخفیف</th>
                                    <th>مالیات (%)</th>
                                    <th>جمع کل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ردیف‌های محصولات اینجا اضافه می‌شود -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-outline-info btn-sm" id="add-product-btn">افزودن محصول/خدمت</button>
                    </div>
                    <input type="hidden" name="products_input" id="products_input" value="{{ old('products_input') }}">
                </div>

                <div class="mb-3">
                    <label>توضیحات فاکتور (اختیاری)</label>
                    <input type="text" name="title" class="form-control" maxlength="100" value="{{ old('title') }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-5 py-2">ثبت فروش سریع</button>
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // محصولات و خدمات برای انتخاب سریع (داده‌ها را از سرور به JS منتقل می‌کنیم)
    const productsList = @json($products);
    const servicesList = @json($services);

    // اضافه کردن ردیف جدید
    function addRow(product = null) {
        let tbody = $('#products-table tbody');
        let rowIdx = tbody.children().length;
        let row = `<tr>
            <td>
                <select class="form-select product-select" style="min-width:120px">
                    <option value="">انتخاب...</option>
                    ${productsList.map(p => `<option value="${p.id}" data-price="${p.sell_price}">${p.name}</option>`).join('')}
                    <option disabled>----- خدمات -----</option>
                    ${servicesList.map(s => `<option value="${s.id}" data-price="${s.sell_price}">${s.name}</option>`).join('')}
                </select>
            </td>
            <td><input type="number" class="form-control count-input" min="1" value="1" style="width: 70px"></td>
            <td><input type="number" class="form-control price-input" min="0" value="0" style="width: 100px"></td>
            <td><input type="number" class="form-control discount-input" min="0" value="0" style="width: 80px"></td>
            <td><input type="number" class="form-control tax-input" min="0" value="0" style="width: 70px"></td>
            <td class="total-cell text-nowrap">0</td>
            <td><button type="button" class="btn btn-danger btn-sm delete-row-btn">حذف</button></td>
        </tr>`;
        tbody.append(row);
    }

    // مقداردهی اولیه
    $(document).ready(function(){
        $('#add-product-btn').on('click', function(e){
            addRow();
        });

        // حذف ردیف
        $('#products-table').on('click', '.delete-row-btn', function(){
            $(this).closest('tr').remove();
            updateProductsInput();
        });

        // تغییرات روی هر سلول
        $('#products-table').on('change', 'select, input', function(){
            let tr = $(this).closest('tr');
            updateRowTotal(tr);
            updateProductsInput();
        });

        // مقدار پیشفرض: یک ردیف داشته باشیم
        if($('#products-table tbody tr').length === 0) addRow();
    });

    function updateRowTotal(tr) {
        let count = parseFloat(tr.find('.count-input').val()) || 1;
        let price = parseFloat(tr.find('.price-input').val()) || 0;
        let discount = parseFloat(tr.find('.discount-input').val()) || 0;
        let tax = parseFloat(tr.find('.tax-input').val()) || 0;
        let subtotal = count * price;
        let taxed = (subtotal - discount) * (tax / 100);
        let total = subtotal - discount + taxed;
        tr.find('.total-cell').text(total.toLocaleString());
    }

    function updateProductsInput() {
        let data = [];
        $('#products-table tbody tr').each(function(){
            let tr = $(this);
            let productId = tr.find('.product-select').val();
            if(!productId) return;
            let count = parseInt(tr.find('.count-input').val()) || 1;
            let price = parseInt(tr.find('.price-input').val()) || 0;
            let discount = parseInt(tr.find('.discount-input').val()) || 0;
            let tax = parseFloat(tr.find('.tax-input').val()) || 0;
            data.push({
                id: productId,
                count: count,
                sell_price: price,
                discount: discount,
                tax: tax
            });
        });
        $('#products_input').val(JSON.stringify(data));
    }

    // پر کردن قیمت واحد هنگام انتخاب محصول
    $('#products-table').on('change', '.product-select', function(){
        let price = $(this).find(':selected').data('price') || 0;
        let tr = $(this).closest('tr');
        tr.find('.price-input').val(price);
        updateRowTotal(tr);
        updateProductsInput();
    });

</script>
@endsection
