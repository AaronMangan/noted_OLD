<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateSettingsRequest;
use App\Services\SettingsService;
use Illuminate\Support\Str;
use App\Models\User;

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
            $page->shared_with_users = implode('; ', User::whereIn('id', $page->shared_with_users)->pluck('email')->toArray());
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
        // Get User Input.
        $settings = $request->validated();
        $settings['private'] = (isset($settings['private']) && $settings['private'] == 'on') ? 1 : 0;
        $settings['shared_with_users'] = Str::of($settings['shared_with_users'])->remove(' ')->trim()->explode(';');

        // Instantiate a new Settings Service & Update.
        $settingsService = new SettingsService($page);
        $updated = $settingsService->setSharedWithUsers($settings['shared_with_users']->toArray() ?? [])
            ->setPrivate($settings['private'])
            ->update();

        if($updated) {
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
