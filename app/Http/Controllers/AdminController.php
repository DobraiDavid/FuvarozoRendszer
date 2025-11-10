<?php

namespace App\Http\Controllers;

use App\Models\Munka;
use App\Models\Fuvarozo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // List all jobs
    public function index(Request $request) {
        $query = Munka::with('fuvarozo');

        // Status filtering (bonus feature)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $munkak = $query->get();
        return view('admin.munkak.index', compact('munkak'));
    }

    // Show create form
    public function create() {
        $fuvarozok = Fuvarozo::all();
        return view('admin.munkak.create', compact('fuvarozok'));
    }

    // Store new job
    public function store(Request $request) {
        $request->validate([
            'indulas' => 'required',
            'erkezes' => 'required',
            'cimzett_neve' => 'required',
            'cimzett_telefonszama' => 'required',
        ]);

        Munka::create($request->all());
        return redirect()->route('admin.munkak.index')->with('success', 'Munka létrehozva!');
    }

    // Edit job
    public function edit(Munka $munka) {
        $fuvarozok = Fuvarozo::all();
        return view('admin.munkak.edit', compact('munka', 'fuvarozok'));
    }

    // Update job
    public function update(Request $request, Munka $munka) {
        $request->validate([
            'indulas' => 'required',
            'erkezes' => 'required',
            'cimzett_neve' => 'required',
            'cimzett_telefonszama' => 'required',
            'status' => 'required'
        ]);

        // Check if status changed to 'sikertelen' for notification
        $oldStatus = $munka->status;
        $munka->update($request->all());

        // Notification for failed jobs (bonus feature)
        if ($request->status == 'sikertelen' && $oldStatus != 'sikertelen') {
            session()->flash('warning', 'Figyelem: A munka sikertelenre lett állítva!');
        }

        return redirect()->route('admin.munkak.index')->with('success', 'Munka frissítve!');
    }

    // Delete job
    public function destroy(Munka $munka) {
        $munka->delete();
        return redirect()->route('admin.munkak.index')->with('success', 'Munka törölve!');
    }
}