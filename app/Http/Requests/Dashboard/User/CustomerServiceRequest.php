<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profile' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:20000'],
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->isMethod('POST') ? null : $this->customer_service->id)],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', 'confirmed', Password::min(8)],
            'role' => ['required', Rule::exists('roles', 'id')],
        ];
    }

    public function attributes(): array
    {
        return [
            'profile' => __('Profile Image'),
            'name' => __('Name'),
            'email' => __('Email Address'),
            'password' => __('Password'),
            'role' => __('Roles'),
        ];
    }
}
