<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewTemplateRequest;
use App\Http\Requests\EditTemplateRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewTemplateRequest $request)
    {
        //
        $data = $request->safe()->only(['name', 'template']);
        $data['user_id'] = $request->user()->id;
        $template = Template::create($data);
        if(isset($template->id)) {
            notify()->success('Template created successfully!', 'Success');
        } else {
            notify()->preset('default-error');
        }

        return redirect()->route('profile.edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTemplateRequest $request, Template $template)
    {
        // Update the template and redirect bask to settings.
        $done = $template->update($request->safe()->only(['name', 'template']));
        if($done) {
            notify()->success('Template updated successfully!', 'Success');
        } else {
            notify()->preset('default-error');
        }
        return redirect()->route('profile.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        //
        if($template->delete()) {
            notify()->success("Template deleted successfully", "Success");
        } else {
            notify()->error("An error occurred", "Error");
        }

        return redirect()->route('profile.edit');
    }
}
