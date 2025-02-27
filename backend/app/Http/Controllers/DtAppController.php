<?php

namespace App\Http\Controllers;

use App\Models\DataApp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DtAppController extends Controller
{
    public function index()
    {
        $applications = DataApp::all();
        return response()->json($applications);
    }

    public function store(Request $request)
    {
        // More viable when the user key is up.
        // $request->validate([
        //     'app_status' => 'required|in:0,1',
        // ]);

        $genKey = Str::uuid();

        $newApp = DataApp::create([
            'app_key' => $genKey,
            'app_status' => 1,
            // 'app_status' => $request->app_status,
        ]);

        return response()->json(['success' => 'Application created successfully.', 'application' => $newApp]);
    }

    public function show(DataApp $allDtApp)
    {
        return response()->json($allDtApp);
    }

    public function update(Request $request, DataApp $upApp)
    {
        $request->validate([
            'app_key' => 'required|string|max:255',
            'app_status' => 'required|in:0,1',
        ]);

        $upApp->update($request->all());

        return response()->json(['success' => 'Application updated successfully.', 'application' => $upApp]);
    }

    public function destroy(DataApp $dropApp)
    {
        $dropApp->delete();

        return response()->json(['success' => 'Application deleted successfully.']);
    }

    public function getCsrfToken() {
        return response()->json([
            'csrf' => csrf_token(),
        ]);
    }
}
