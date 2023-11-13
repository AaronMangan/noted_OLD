<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\CreateNewPageRequest;
use App\Http\Requests\DashboardRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DashboardRequest $request)
    {
        // Check for a search option.
        $search = $request->safe()->only('search')['search'] ?? '';
        return view(
            'dashboard',
            ['pages' => \Auth::user()->pages()->where(function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere("content", "like", "%{$search}%");
            })->get(),
            'search' => $search,
            'shared' => \Auth::user()->shared(),
        ]
        );
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
        $data['shared_with_users'] = [];

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
    public function show(Request $request, Page $page)
    {
        //
        if(!Gate::allows('view-page', $page, $request->user())) {
            notify()->warning('You do not have permission to access this page', 'Warning');
            return redirect()->route('dashboard');
        }
        return view('view', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Page $page)
    {
        // Can the user edit that page?
        if(!Gate::allows('manage-page', $page, $request->user())) {
            notify()->warning('You do not have permission to edit this page', 'Warning');
            return redirect()->route('dashboard');
        }
        return view('edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateNewPageRequest $request, Page $page)
    {
        if(Gate::allows('manage-page', $page, $request->user())) {
            $data = $request->only(['title', 'content']);

            if($page->update($data)) {
                notify()->success('Page updated successfully', 'Success');
            } else {
                notify()->preset('default-error');
            }
        }

        //
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Page $page)
    {
        //
        if($page->delete()) {
            notify()->success('Page deleted successfully', 'Success');
        } else {
            notify()->preset('default-error');
        }
        return redirect('dashboard');
    }

    /**
     * Share the page, if you have the right to do so.
     *
     * @param Request $request
     * @param Page $page
     * @return void
     */
    public function share(Request $request, Page $page)
    {
        if(!Gate::allows('manage-page', $page, $request->user())) {
            notify()->warning('You do not have permission to share this page', 'Warning');
        }

        $user = User::where('email', $request->email)->first();
        if(!isset($user->id) || $page->user->id == $user->id) {
            notify()->error('User was not found to share with, or trying to share with page owner.', 'Error');
            return redirect()->route('dashboard');
        } elseif($page->share($user->id)) {
            notify()->success("Page was shared with {$request->email}", 'Success');
        }

        return redirect()->route('dashboard');
    }
}
