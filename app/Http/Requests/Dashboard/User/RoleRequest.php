<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.*' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name.*' => __('Name'),
        ];
    }
}
