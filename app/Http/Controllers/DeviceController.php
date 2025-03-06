<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $devices = Device::where("user_id", $request->user()->id)->get();
        return response()->json($devices);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'bail|required|unique:devices|max:255'
        ]);

        // return response()->json(['device_id' => $validated['device_id'], 'user_id' => $request->user()->id]);

        $device = Device::create(['device_id' => $validated['device_id'], 'user_id' => $request->user()->id]);
        return response()->json($device, 201);
    }

    public function show(Device $device)
    {
        return response()->json($device);
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'device_id' => 'bail|required|unique:devices|max:255',
        ]);

        $device->update($validated);
        return response()->json($device);
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json(null, 204);
    }
}
