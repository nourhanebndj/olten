<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeService;

class TypeServiceController extends Controller
{
    // Afficher tous les types de services
    public function index(Request $request)
    {
        $query = TypeService::query();

        // Filtre par nom si search rempli
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $types = $query->latest()->paginate(10)->withQueryString();

        return view('admin.type_services.index', compact('types'));
    }


    // Formulaire de création
    public function create()
    {
        return view('admin.type_services.create');
    }

    // Enregistrer un nouveau type
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TypeService::create($request->all());

        return redirect()->route('admin.type_services.index')
                         ->with('success', 'Type de service créé avec succès !');
    }

    // Formulaire d'édition
    public function edit(TypeService $typeService)
    {
        return view('admin.type_services.edit', compact('typeService'));
    }

    // Mettre à jour
    public function update(Request $request, TypeService $typeService)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $typeService->update($request->all());

        return redirect()->route('admin.type_services.index')
                         ->with('success', 'Type de service mis à jour !');
    }

    // Supprimer
    public function destroy(TypeService $typeService)
    {
        $typeService->delete();
        return redirect()->route('admin.type_services.index')
                         ->with('success', 'Type de service supprimé !');
    }
}
