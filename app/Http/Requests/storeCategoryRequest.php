<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeCategoryRequest extends FormRequest
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
            'name_ar'=>'required',
            'name_en'=>'required',
            'slug'=>'required',
            'description_ar'=>'required',
            'description_en'=>'required',
            'image'=>[ 'required','image','mimes:jpg,png,jpeg' ],
          
            'title_ar'=>'required',
            'title_en'=>'required',
            'meta_description_ar'=>'required',
            'meta_description_en'=>'required',
            'meta_keywords'=>'required',


            //
        ];
       
    }
}
