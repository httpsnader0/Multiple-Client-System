<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User\Role;
use App\Http\Controllers\Controller;
use App\Support\Traits\PermissionTrait;
use App\Http\Requests\Dashboard\User\RoleRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RoleController extends Controller
{
    use PermissionTrait;

    public function __construct()
    {
        $this->middleware(['permission:Index Role'])->only('index');
        $this->middleware(['permission:Create Role'])->only('create', 'store');
        $this->middleware(['permission:Show Role'])->only('show');
        $this->middleware(['permission:Edit Role'])->only('edit', 'update');
        $this->middleware(['permission:Delete Role'])->only('destroy');
        $this->middleware(['permission:Active Role'])->only('active');
    }

    public function index()
    {
        return view('dashboard.user.roles.index');
    }

    public function create()
    {
        return view('dashboard.user.roles.create')->with([
            'permissions' => $this->permissions(),
        ]);
    }

    public function store(RoleRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data['name'][$localeCode] = $request->name[$localeCode];
        }
        $role = Role::create($data);

        $role->syncPermissions($request->permissions);

        return adminResponse(route('dashboard.roles.index'), __('Created Successfully'));
    }

    public function edit(Role $role)
    {
        return view('dashboard.user.roles.edit')->with([
            'role' => $role,
            'permissions' => $this->permissions(),
        ]);
    }

    public function update(Role $role, RoleRequest $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data['name'][$localeCode] = $request->name[$localeCode];
        }
        $role->update($data);

        $role->syncPermissions($request->permissions);

        return adminResponse(route('dashboard.roles.index'), __('Updated Successfully'));
    }

    public function show(Role $role)
    {
        return view('dashboard.user.roles.show')->with([
            'role' => $role,
            'permissions' => $this->permissions(),
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
    }

    public function active(Role $role)
    {
        $role->update(['active' => $role->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $role->active,
        ]);
    }
}
