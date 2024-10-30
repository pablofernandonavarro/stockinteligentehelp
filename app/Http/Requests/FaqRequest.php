<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       $rules = [
        "question" => "required|max:200",
        "answer" => "required|max:400",
        "category_id" => "required|exists:categories,id",
        "is_active" => "required|in:0,1",
        'priority'=>'required'
        ];
        return $rules;
    }
}
