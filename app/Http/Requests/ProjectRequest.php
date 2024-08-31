<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required |string',
            'type' => 'required|in:hourly,fixed',
            'budget' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must be less than 255 characters',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'type.required' => 'Type is required',
            'type.in' => 'Type must be hourly or fixed',
            'budget.numeric' => 'Budget must be a number',
            
        ];
        }
}
