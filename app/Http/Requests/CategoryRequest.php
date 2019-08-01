<?php

namespace App\Http\Requests;

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
        $category = \App\Models\Category::whereUid($this->category)->first('uid');
        
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|unique:categories',
                    'is_enabled' => 'required',
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|unique:categories,'.$categories->id,
                    'is_enabled' => 'required',
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }            
            default:
                break;
        }


    }
}
