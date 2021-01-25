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
            'nunber_times' => 'required|max:20',
            'image' => 'nullable|file|image|mimes:png,jpeg',
        ];
    }

    // 入力欄の名称を日本語化、エラーメッセージの日本語化は/resources/lang/jp/validation.php。
    public function attributes()
    {
        return [
            'pass_class' => '「何級に合格しましたか？」',
            'pass_date' => '「いつ合格しましたか？」',
            'test_style' => '「どの試験方式でしたか？」',
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」',
            'study_method' => '「どのような勉強法でしたか？」',
            'books_used' => '「使用した教材は何ですか？」',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」',
            'nunber_times' => '「受験回数は何回ですか？」',
            'image' => '「画像を添付（任意）」',
        ];
    }
}
