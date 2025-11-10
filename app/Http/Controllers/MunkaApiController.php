<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Munka;
use App\Models\Fuvarozo;
use Illuminate\Http\Request;

class MunkaApiController extends Controller
{
    /**
     * Display a listing of munkak.
     */
    public function index()
    {
        $munkak = Munka::with('fuvarozo')->get();
        return response()->json($munkak);
    }

    /**
     * Store a newly created munka.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'indulas' => 'required|string',
            'erkezes' => 'required|string',
            'cimzett_neve' => 'required|string',
            'cimzett_telefonszama' => 'required|string',
            'fuvarozo_id' => 'nullable|exists:fuvarozo,id',
        ]);

        $munka = Munka::create($validated);

        return response()->json([
            'message' => 'Munka sikeresen létrehozva',
            'munka' => $munka->load('fuvarozo')
        ], 201);
    }

    /**
     * Display the specified munka.
     */
    public function show(Munka $munka)
    {
        return response()->json($munka->load('fuvarozo'));
    }

    /**
     * Update the specified munka.
     */
    public function update(Request $request, Munka $munka)
    {
        $validated = $request->validate([
            'indulas' => 'sometimes|required|string',
            'erkezes' => 'sometimes|required|string',
            'cimzett_neve' => 'sometimes|required|string',
            'cimzett_telefonszama' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:kiosztva,folyamatban,elvegezve,sikertelen',
            'fuvarozo_id' => 'nullable|exists:fuvarozo,id',
        ]);

        $munka->update($validated);

        return response()->json([
            'message' => 'Munka sikeresen frissítve',
            'munka' => $munka->load('fuvarozo')
        ]);
    }

    /**
     * Remove the specified munka.
     */
    public function destroy(Munka $munka)
    {
        $munka->delete();

        return response()->json([
            'message' => 'Munka sikeresen törölve'
        ]);
    }

    /**
     * Update munka status (for fuvarozok).
     */
    public function updateStatus(Request $request, Munka $munka)
    {
        $validated = $request->validate([
            'status' => 'required|in:kiosztva,folyamatban,elvegezve,sikertelen',
        ]);

        $munka->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Státusz sikeresen frissítve',
            'munka' => $munka->load('fuvarozo')
        ]);
    }

    /**
     * Get munkak for a specific fuvarozo.
     */
    public function fuvarozoMunkak($fuvarozoId)
    {
        $fuvarozo = Fuvarozo::findOrFail($fuvarozoId);
        $munkak = $fuvarozo->munkak;

        return response()->json([
            'fuvarozo' => $fuvarozo,
            'munkak' => $munkak
        ]);
    }
}