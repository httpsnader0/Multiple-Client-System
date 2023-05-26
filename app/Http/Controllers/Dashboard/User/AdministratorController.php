<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AdministratorRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Index Administrator'])->only('index');
        $this->middleware(['permission:Create Administrator'])->only('create', 'store');
        $this->middleware(['permission:Show Administrator'])->only('show');
        $this->middleware(['permission:Edit Administrator'])->only('edit', 'update');
        $this->middleware(['permission:Delete Administrator'])->only('destroy');
        $this->middleware(['permission:Active Administrator'])->only('active');
    }

    public function index()
    {
        return view('dashboard.user.administrators.index');
    }

    public function create()
    {
        return view('dashboard.user.administrators.create');
    }

    public function store(AdministratorRequest $request)
    {
        $data['type'] = UserTypeEnum::ADMINISTRATOR();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $administrator = User::create($data);

        $administrator->assignRole(1);

        if ($request->has('profile')) {
            $administrator->addMedia($request->profile)->toMediaCollection('profile');
        }

        return adminResponse(route('dashboard.administrators.index'), __('Created Successfully'));
    }

    public function edit(User $administrator)
    {
        return view('dashboard.user.administrators.edit')->with([
            'administrator' => $administrator,
        ]);
    }

    public function update(User $administrator, AdministratorRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $administrator->update($data);

        if ($request->has('profile')) {
            $administrator->clearMediaCollection('profile');
            $administrator->addMedia($request->profile)->toMediaCollection('profile');
        }

        return adminResponse(route('dashboard.administrators.index'), __('Updated Successfully'));
    }

    public function show(User $administrator)
    {
        return view('dashboard.user.administrators.show')->with([
            'administrator' => $administrator,
        ]);
    }

    public function destroy(User $administrator)
    {
        $administrator->clearMediaCollection();
        $administrator->delete();
    }

    public function active(User $administrator)
    {
        $administrator->update(['active' => $administrator->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $administrator->active,
        ]);
    }
}
