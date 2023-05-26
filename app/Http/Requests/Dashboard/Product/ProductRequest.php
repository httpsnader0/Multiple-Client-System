<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cover' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:20000'],
            'name.*' => ['required'],
            'description.*' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'cover' => __('Cover'),
            'name.*' => __('Name'),
            'description.*' => __('description'),
            'price' => __('Price'),
        ];
    }
}
