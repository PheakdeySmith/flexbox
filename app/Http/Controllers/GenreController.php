<?php

namespace App\Http\Controllers;

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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres',
                'slug' => 'required|string|max:255|unique:genres',
            ]);

            Genre::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            return redirect()->route('genre.index')
                ->with('success', 'Genre created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating genre: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // This method is not needed in this context
        return redirect()->route('genre.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        try {
            $genre = Genre::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name,' . $id,
                'slug' => 'required|string|max:255|unique:genres,slug,' . $id,
            ]);

            $genre->update([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            return redirect()->route('genre.index')
                ->with('success', 'Genre updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating genre: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            $genre->delete();

            return redirect()->route('genre.index')
                ->with('success', 'Genre deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting genre: ' . $e->getMessage());
        }
    }
}
