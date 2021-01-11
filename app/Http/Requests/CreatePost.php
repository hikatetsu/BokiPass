<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
            'pass_class' => 'required|max:20',
            'pass_date' => 'required|max:20',
            'test_style' => 'required|max:20',
            'study_period' => 'required|max:191',
            'study_method' => 'required|max:191',
            'books_used' => 'required|max:191',
            'advice' => 'required|max:191',
            'free_column' => 'required|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'pass_date' => '「いつ合格しましたか？」',
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」',
            'study_method' => '「どのような勉強法でしたか？」',
            'books_used' => '「使用した教材は何ですか？」',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」',
            'free_column' => '「最後に一言お願いします。」',
        ];
    }
}
