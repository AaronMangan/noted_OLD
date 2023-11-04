<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNewPageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewPageRequest $request)
    {
        // Get user data.
        $data = $request->safe()->only(['title', 'content']);
        $data['user_id'] = $request->user()->id;
        $data['content'] = $data['content'];

        // Create page.
        $saved = Page::create($data);

        // Notify and return
        if(isset($saved->id)) {
            notify()->preset('page-added');
        } else {
            notify()->preset('default-error');
        }
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
        return view('view', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
