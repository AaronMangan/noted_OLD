<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNewTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return $request->user()->tags()->paginate($request->per_page ?? 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewTagRequest $request)
    {
        //
        $filtered = $request->safe()->only(['name', 'description']);
        $filtered['user_id'] = $request->user()->id;
        $tag = Tag::create($filtered);
        if(isset($tag->id)) {
            notify()->success('Tag created successfully', 'Success');
        }
        return redirect()->route('profile.edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
        if($tag->delete()) {
            notify()->success('Tag deleted successfully', 'Success');
        }
        return redirect()->route('profile.edit');
    }
}
