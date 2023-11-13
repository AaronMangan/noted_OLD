<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicPageViewRequest extends FormRequest
{
    protected $redirectRoute = '/';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // If the page is private, then it cannot be accessed publicly.
        return (!$this->page->private) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'signature' => 'required'
        ];
    }
}
