<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'=>'required|unique:books,title,'.$this->book,
            'auther'=>'required',
            'body'=> 'required',
            'published_year'=> 'date_format:Y-m-d|before:today',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'name is required',
            'auther.required'=>'auther is required',
            'body.required'=>'body is required',
            'published_year.required'=>'published_year is required',
            'published_year.before'=>'published_year must be before this day',
           
        ];
    }
}
