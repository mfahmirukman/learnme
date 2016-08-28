<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateReplyRequest extends Request
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
            'comments' => 'required|max:1000',
            'thread_id' => 'required|max:10',
            'user_id' => 'required|max10'
        ];
    }
}
