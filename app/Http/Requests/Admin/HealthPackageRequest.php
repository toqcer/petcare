<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HealthPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'caption' => 'required|max:255',
            'about' => 'required',
            'perfume' => 'required|max:255',
            'vitamin' => 'required|max:255',
            'snack' => 'required|max:255',
            'available_date' => 'required|date',
            'duration' => 'required|max:255',
            'package_name' => 'required|max:255',
            'price' => 'required|integer'
        ];
    }
}
