<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $post = $this->route()->parameter('post');
        $rules = [
            'name' => 'required|string|max:180',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'status' => 'required|in:1,2',
            'file'   => 'image'
        ];
        if ($this->status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'etiquetas.*' => 'required',
                'extract'     => 'required',
                  'body'      => 'required',
            ]);
        }
      
        return $rules;
    }
}
