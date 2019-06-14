<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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

        $rules = [
            'title' => 'required|min:3',
            'content' => 'required',
            'category' => 'required|in:0,1,2,3,4,5',
            'sex' => 'required|in:0,1,2',
            'age' => 'required',
            'valid_at' => 'required',
        ];
                        error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'gtest--1234',json_encode($rules))));
        return $rules;
    }
}