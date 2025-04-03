<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Auth::user()->posts()
            ->with(['categories' => function($query) {
                $query->orderBy('name', 'asc');
            }])
            ->orderBy('created_at', 'desc')  // Or use latest()
            ->get();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name', 'asc')->latest()->get();
        return view('posts.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255', 'unique:posts'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:1024'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['exists:categories,id']
        ]);

        // Store image if exists
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        // Make sure the slug is unique
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Create a post
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'image' => $path,
        ]);

        // Sync categories
        $post->categories()->sync($request->categories ?? []);

        // $user = auth()->user(); // Or get the user however you prefer

        // Mail::to($user->email)->send(new PostCreated($post, $user));

        // Redirect to dashboard
        return redirect()->route('posts.index')->with('success', 'Bericht is toegevoegd!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('show', $post);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        $categories = Auth::user()->categories()->orderBy('name', 'asc')->latest()->get();
        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:1024'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['exists:categories,id']
        ]);

        // Store image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        // Make sure the slug is unique
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
            'slug' => $slug
        ]);

        // Sync categories
        $post->categories()->sync($request->categories ?? []);

        // Redirect to dashboard
        return redirect()->route('posts.index')->with('success', 'Bericht is bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete post image if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Bericht is verwijderd');

    }

}
