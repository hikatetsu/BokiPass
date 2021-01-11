<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComment extends FormRequest
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
            'body' => 'required|max:191',
        ];
    }

    // 入力欄の名称を日本語化、エラーメッセージの日本語化は/resources/lang/jp/validation.php。
    public function attributes()
    {
        return [
            'body' => 'コメント',
        ];
    }
}
