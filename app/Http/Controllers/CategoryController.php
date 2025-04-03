<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Auth::user()->categories()->latest()->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => ['required', 'max:255', 'unique:categories'],
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        // Make sure the slug is unique
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Create a category
        $category = Auth::user()->categories()->create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        // $user = auth()->user(); // Or get the user however you prefer

        // Mail::to($user->email)->send(new PostCreated($post, $user));

        // Redirect to dashboard
        return redirect()->route('categories.index')->with('success', 'Categorie is toegevoegd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('edit', $category);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        // Validate
        $request->validate([
            'name' => ['required', 'max:255', 'unique:categories'],
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        // Make sure the slug is unique
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug
        ]);

        // $user = auth()->user(); // Or get the user however you prefer

        // Mail::to($user->email)->send(new PostCreated($post, $user));

        // Redirect to dashboard
        return redirect()->route('categories.index')->with('success', 'Categorie is bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categorie is verwijderd');
    }
}
