<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nom', 'LIKE', "%{$search}%");
        }

        $categories = $query->latest()->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('admin.categories.create');
    }

    // Enregistre une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('nom', 'description'));

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie ajoutée avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Met à jour une catégorie existante
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only('nom', 'description'));

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprime une catégorie
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie supprimée avec succès.');
    }
}
