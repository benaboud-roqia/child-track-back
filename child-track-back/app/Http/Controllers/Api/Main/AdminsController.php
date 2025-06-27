<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Extra\Phone;
use Illuminate\Http\Request;
use App\Models\Api\User\Admin;
use Illuminate\Support\Str;


class AdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::with(['key.user' ])->paginate(10);
        return response()->json($admins);
    }

    public function show(Admin $admin)
    {
        return response()->json($admin->fresh(['key.user']));
    }

    public function store(Request $request)
    {
        $username = Str::slug($request->input('name') . '.' . $request->input('last')) . rand(10000, 99999);
        $request->merge(['username' => $username]);
        $admin = Admin::create($request->all());
        return response()->json($admin, 201);
    }

    public function storePhone(Request $request , Admin $admin)
    {
        $phone = $admin->phones()->create($request->all());
        return response()->json($phone, 201);
    }


    public function update(Request $request, Admin $admin)
    {
        $admin->update($request->all());
        return response()->json($admin);
    }

    public function updatePhone(Request $request, Admin $admin , Phone $phone)
    {
        $phone->update($request->all());
        return response()->json($phone);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully']);
    }

    public function createKey(Admin $admin)
    {
        $key = Str::random(10);
        $admin->key()->create(['value' => $key]);
        return response()->json(['api_key' => $key]);
    }
}
