<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\CustomerServiceRequest;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class CustomerServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Index Customer Service'])->only('index');
        $this->middleware(['permission:Create Customer Service'])->only('create', 'store');
        $this->middleware(['permission:Show Customer Service'])->only('show');
        $this->middleware(['permission:Edit Customer Service'])->only('edit', 'update');
        $this->middleware(['permission:Delete Customer Service'])->only('destroy');
        $this->middleware(['permission:Active Customer Service'])->only('active');
    }

    public function index()
    {
        return view('dashboard.user.customer-services.index')->with([
            'roles' => Role::active()->where('id', '!=', '1')->pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('dashboard.user.customer-services.create')->with([
            'roles' => Role::active()->where('id', '!=', '1')->pluck('name', 'id'),
        ]);
    }

    public function store(CustomerServiceRequest $request)
    {
        $data['type'] = UserTypeEnum::CUSTOMER_SERVICE();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $customerService = User::create($data);

        $customerService->assignRole($request->role);

        if ($request->has('profile')) {
            $customerService->addMedia($request->profile)->toMediaCollection('profile');
        }

        return adminResponse(route('dashboard.customer-services.index'), __('Created Successfully'));
    }

    public function edit(User $customerService)
    {
        return view('dashboard.user.customer-services.edit')->with([
            'customerService' => $customerService,
            'roles' => Role::active()->where('id', '!=', '1')->pluck('name', 'id'),
        ]);
    }

    public function update(User $customerService, CustomerServiceRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $customerService->update($data);

        $customerService->syncRoles($request->role);

        if ($request->has('profile')) {
            $customerService->clearMediaCollection('profile');
            $customerService->addMedia($request->profile)->toMediaCollection('profile');
        }

        return adminResponse(route('dashboard.customer-services.index'), __('Updated Successfully'));
    }

    public function show(User $customerService)
    {
        return view('dashboard.user.customer-services.show')->with([
            'customerService' => $customerService,
        ]);
    }

    public function destroy(User $customerService)
    {
        $customerService->clearMediaCollection();
        $customerService->delete();
    }

    public function active(User $customerService)
    {
        $customerService->update(['active' => $customerService->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $customerService->active,
        ]);
    }
}
