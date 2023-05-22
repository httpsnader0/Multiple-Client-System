<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Index Client'])->only('index');
        $this->middleware(['permission:Show Client'])->only('show');
        $this->middleware(['permission:Delete Client'])->only('destroy');
        $this->middleware(['permission:Active Client'])->only('active');
    }

    public function index()
    {
        return view('dashboard.user.clients.index');
    }

    public function show(User $client)
    {
        return view('dashboard.user.clients.show')->with([
            'client' => $client,
        ]);
    }

    public function destroy(User $client)
    {
        $client->clearMediaCollection();
        $client->delete();
    }

    public function active(User $client)
    {
        $client->update(['active' => $client->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $client->active,
        ]);
    }
}
