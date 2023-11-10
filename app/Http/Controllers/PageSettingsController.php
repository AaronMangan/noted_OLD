<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateSettingsRequest;

class PageSettingsController extends Controller
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
    public function create(Request $request, Page $page)
    {
        //
        if(Gate::allows('manage-page', $page, \Auth::user())) {
            return view('page-settings', compact('page'));
        }
        notify()->warning('You do not have permissions', 'Not Allowed');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateSettingsRequest $request, Page $page)
    {
        $valid = $request->validated();
        $valid['private'] = (isset($valid['private']) && $valid['private'] == 'on') ? true : false;
        if($page->update($valid)) {
            notify()->success('Settings saved successfully', 'Success');
        }

        return redirect()->route('settings.create', $page->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
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
