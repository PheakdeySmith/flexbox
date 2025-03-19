<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $genres = Genre::latest()->get();
        return view('backend.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        // This method is not needed as we're using a modal for creation
        return redirect()->route('genre.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $request->validate([
            'name' => 'required|string|max:255|unique:genres',
            'slug' => 'required|string|max:255|unique:genres',
        ]);

        Genre::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('genre.index')
            ->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $genre = Genre::with('movies')->findOrFail($id);
        return view('backend.genre.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        // This method is not needed as we're using a modal for editing
        return redirect()->route('genre.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $genre = Genre::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id,
            'slug' => 'required|string|max:255|unique:genres,slug,' . $id,
        ]);

        $genre->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('genre.index')
            ->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genre.index')
            ->with('success', 'Genre deleted successfully.');
    }
}
