<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Product\Product;
use App\Models\Product\Purchase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Index Product'])->only('index');
        $this->middleware(['permission:Create Product'])->only('create', 'store');
        $this->middleware(['permission:Show Product'])->only('show');
        $this->middleware(['permission:Edit Product'])->only('edit', 'update');
        $this->middleware(['permission:Delete Product'])->only('destroy');
        $this->middleware(['permission:Active Product'])->only('active');
    }

    public function index()
    {
        return view('dashboard.product.products.index');
    }

    public function create()
    {
        return view('dashboard.product.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data['user_id'] = auth()->user()->id;
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data['name'][$localeCode] = $request->name[$localeCode];
            $data['description'][$localeCode] = $request->description[$localeCode];
        }
        $data['price'] = $request->price;
        $product = Product::create($data);

        if ($request->has('cover')) {
            $product->addMedia($request->cover)->toMediaCollection('cover');
        }

        return adminResponse(route('dashboard.products.index'), __('Created Successfully'));
    }

    public function edit(Product $product)
    {
        return view('dashboard.product.products.edit')->with([
            'product' => $product,
        ]);
    }

    public function update(Product $product, ProductRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data['name'][$localeCode] = $request->name[$localeCode];
            $data['description'][$localeCode] = $request->description[$localeCode];
        }
        $data['price'] = $request->price;
        $product->update($data);

        if ($request->has('cover')) {
            $product->clearMediaCollection('cover');
            $product->addMedia($request->cover)->toMediaCollection('cover');
        }

        return adminResponse(route('dashboard.products.index'), __('Updated Successfully'));
    }

    public function show(Product $product)
    {
        return view('dashboard.product.products.show')->with([
            'product' => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection();
        $product->delete();
    }

    public function active(Product $product)
    {
        $product->update(['active' => $product->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $product->active,
        ]);
    }

    public function buy(Product $product)
    {
        Purchase::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'total' => $product->price,
        ]);

        return adminResponse(route('dashboard.index'), __('Boughted Successfully'));
    }

    public function reports()
    {
        return view('dashboard.product.reports.index');
    }
}
