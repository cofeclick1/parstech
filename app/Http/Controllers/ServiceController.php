<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(15);
        $serviceCategories = Category::where('category_type', 'service')->get();
        return view('services.index', compact('services', 'serviceCategories'));
    }

    public function create()
    {
        $units = Unit::all();
        $serviceCategories = Category::where('category_type', 'service')->get();
        return view('services.create', compact('units', 'serviceCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_code' => 'required|string|max:255|unique:services,service_code',
            'service_info' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units,id',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'info_link' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // مقداردهی فعال/غیرفعال
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // واحد
        $unit = Unit::find($validated['unit_id']);
        $validated['unit'] = $unit ? $unit->title : null;

        // تصویر
        if($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service = Service::create($validated);

        // ساخت یا آپدیت محصول معادل
        $service->createOrUpdateProduct();

        return redirect()->route('services.index')->with('success', 'خدمت با موفقیت ثبت شد.');
    }

    public function edit(Service $service)
    {
        $units = Unit::all();
        $serviceCategories = Category::where('category_type', 'service')->get();
        return view('services.edit', compact('service', 'units', 'serviceCategories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_code' => 'required|string|max:255|unique:services,service_code,' . $service->id,
            'service_info' => 'nullable|string|max:255',
            'service_category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units,id',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'info_link' => 'nullable|string',
            'full_description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $unit = Unit::find($validated['unit_id']);
        $validated['unit'] = $unit ? $unit->title : null;

        // تصویر جدید
        if($request->hasFile('image')) {
            if($service->image) Storage::disk('public')->delete($service->image);
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        // ساخت یا آپدیت محصول معادل
        $service->createOrUpdateProduct();

        return redirect()->route('services.index')->with('success', 'خدمت با موفقیت ویرایش شد.');
    }

    public function destroy(Service $service)
    {
        if($service->image) Storage::disk('public')->delete($service->image);
        $service->delete();
        // همچنین می‌توان محصول معادل را حذف کرد (در صورت نیاز)
        return redirect()->route('services.index')->with('success', 'خدمت با موفقیت حذف شد.');
    }
}
