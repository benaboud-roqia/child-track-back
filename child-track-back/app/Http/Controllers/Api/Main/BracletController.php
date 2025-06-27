<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Braclet;
use App\Models\Api\Main\Children;
use App\Models\Api\Main\Location;
use Illuminate\Http\Request;

class BracletController extends Controller
{
    public function index()
    {
        $braclets = Braclet::with(['children', 'location', 'circle'])->orderBy('created_at', 'desc')->paginate(6);

        return response()->json($braclets);
    }

    public function store(Request $request)
    {
        $braclet = Braclet::create($request->all());
        return response()->json([
            'message' => 'Braclet created successfully',
            'data' => $braclet->load(['children', 'location', 'circle'])
        ]);
    }

    public function linkChild(Request $request,  $id)
    {
        $child = Children::findOrFail($id);
        $request->validate([
            'mac' => 'required|exists:braclets,mac',
        ]);

        $braclet = Braclet::where('mac',$request->mac)->first();
        $braclet->children_id = $child->id;
        $braclet->save();
        return response()->json([
            'message' => 'Children linked successfully',
            'data' => $braclet->load(['children', 'location', 'circle'])
        ]);
    }

    public function show(Braclet $braclet)
    {
        return response()->json(
            $braclet->load(['children', 'location', 'circle'])
        );
    }


    public function update(Request $request, Braclet $braclet)
    {
        $braclet->update($request->all());
        return response()->json([
            'message' => 'Braclet updated successfully',
            'data' => $braclet->load(['children', 'location', 'circle'])
        ]);

    }

    public function destroy(Braclet $braclet)
    {
        $braclet->delete();
        return response()->json([
            'message' => 'Braclet deleted successfully'
        ]);
    }

    public function updateLocation(Request $request, Location $location)
    {
        $location->update($request->all());
        return response()->json([
            'message' => 'Location updated successfully',
            'data' => $location->fresh()
        ]);
    }

    public function connect(Request $request)
    {
        // Ici tu peux simuler une logique de connexion réelle (enregistrement, authentification, etc.)
        // Pour la simulation, on retourne juste "connecté"
        return response()->json([
            'status' => 'success',
            'message' => 'Bracelet connecté avec succès'
        ]);
    }
}
