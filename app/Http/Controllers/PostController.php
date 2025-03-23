<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        // make sure that all routes from the post controller are protected, like post, destroy, etc.
        return [
            // new Middleware(['auth'], except: ['index', 'show']),
            new Middleware(['auth']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:1024']
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

        $user = auth()->user(); // Or get the user however you prefer

        Mail::to($user->email)->send(new PostCreated($post, $user));

        // Redirect to dashboard
        return redirect()->route('posts.index')->with('success', 'De nieuwe post is aangemaakt!');

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

        return view('posts.edit', ['post' => $post]);
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
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:1024']
        ]);

        // Store image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        // Redirect to dashboard
        return redirect()->route('posts.index')->with('success', 'Jouw bericht is bijgewerkt');
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

        return redirect()->route('posts.index')->with('success', 'Jouw bericht is verwijderd');

    }
}
