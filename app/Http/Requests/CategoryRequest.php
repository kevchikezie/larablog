<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = \App\Models\Category::whereUid($this->route('uid'))->first('id');

        switch ($this->method()) {
            case 'POST':
            {
                /*return [
                    'name' => 'required|unique:categories',
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];*/
                return [
                    'name' => 'required',
                    'photo'=>'nullable', //Max 800KB
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => ['required', Rule::unique('categories')->ignore($category->id)],
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }            
            default:
                break;
        }


    }
}
