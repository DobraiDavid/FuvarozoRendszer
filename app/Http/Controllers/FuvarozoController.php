<?php

namespace App\Http\Controllers;

use App\Models\Munka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuvarozoController extends Controller
{
    // Show all jobs for the logged-in driver
    public function index() {
        $fuvarozo = Auth::user();
        $munkak = $fuvarozo->munkak;
        return view('fuvarozo.munkak.index', compact('munkak'));
    }

    // Update job status
    public function updateStatus(Request $request, Munka $munka) {
        $request->validate(['status' => 'required|in:kiosztva,folyamatban,elvegezve,sikertelen']);

        if ($munka->fuvarozo_id != Auth::id()) {
            abort(403, 'Nem frissítheted más fuvarozó munkáját.');
        }

        $munka->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Státusz frissítve!');
    }
}
