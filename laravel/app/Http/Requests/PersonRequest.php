<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'persons_name' => 'required',
            // 'mail' => 'email_strict',
            // 'age' => 'numeric|between:0,100',
        ];
    }

    /**
     * バリデーションエラーのメッセージをカスタマイズする
     *
     * @return array
     */
    public function messages()
    {
        return [
            'persons_name.required' => '名前は必ず入力してください。',
            // 'mail.email' => '正しいE-mailアドレスを入力してください。',
            // 'age.numeric' => '年齢は整数で入力してください。',
            // 'age.between' => '年齢は0〜100の範囲で入力してください。',
        ];
    }
}