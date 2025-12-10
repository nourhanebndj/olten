<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\TypeService;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Liste avec filtre
    public function index(Request $request)
    {
        $query = Service::with('type');

        // Filtre par nom
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // Filtre par type
        if ($request->filled('type_service_id')) {
            $query->where('type_service_id', $request->type_service_id);
        }

        $services = $query->latest()->paginate(10)->withQueryString();
        $types = TypeService::all();

        return view('admin.services.index', compact('services', 'types'));
    }

    // Formulaire création
    public function create()
    {
        $types = TypeService::all();
        return view('admin.services.create', compact('types'));
    }

    // Enregistrer nouveau service
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'type_service_id' => 'required|exists:type_services,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service créé avec succès !');
    }

    // Formulaire édition
    public function edit(Service $service)
    {
        $types = TypeService::all();
        return view('admin.services.edit', compact('service', 'types'));
    }

    // Mise à jour
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'type_service_id' => 'required|exists:type_services,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Supprimer ancienne image si existante
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service mis à jour !');
    }

    // Supprimer
    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service supprimé !');
    }
}
