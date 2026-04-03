<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        return view('welcome');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required'
        ]);

        $certificate = Certificate::where('certificate_id', $request->certificate_id)->first();

        if (!$certificate) {
            return response()->json([
                'status' => false,
                'message' => 'Certificate not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'certificate_id' => $certificate->certificate_id,
            'is_valid' => $certificate->status,
            'image' => asset('storage/images/uploads/' . basename($certificate->certificate_path)),
            'file_type' => pathinfo($certificate->certificate_path, PATHINFO_EXTENSION),
        ]);
    }
}
