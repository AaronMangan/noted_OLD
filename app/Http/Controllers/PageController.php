<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNewPageRequest;
use App\Http\Requests\DashboardRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DashboardRequest $request)
    {
        // Check for a search option.
        $search = $request->safe()->only('search')['search'] ?? '';
        return view('dashboard', ['pages' => \Auth::user()->pages()->where(function ($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere("content", "like", "%{$search}%");
        })->get(),
        'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // If the user wants to create a new page from the template.
        $from = $request->has('template_id') ? $request->user()->templates()->find($request->template_id) : null;

        //
        $templates = \Auth::user()->templates()->orderBy('name', 'asc')->get() ?? [];
        return view('create', compact('templates', 'from'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewPageRequest $request)
    {
        // Get user data.
        $data = $request->safe()->only(['title', 'content', 'tags']);
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
        if($page->delete()) {
            notify()->success('Page deleted successfully', 'Success');
        } else {
            notify()->preset('default-error');
        }
        return redirect('dashboard');
    }
}
