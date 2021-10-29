<?php

namespace App\Http\Requests\Api;


class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5', 'max:12', 'unique:users,name'],
            'password' => ['required', 'confirmed', 'max:16', 'min:6'],
            'email' => ['email:rfc,dns', 'unique:users,email'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.unique' => '用户名已经存在',
            'name.required' => '用户名不能为空',
            'name.max' => '用户名最大长度为12个字符',
            'name.min' => '用户名最小长度为5个字符',
            'password.required' => '密码不能为空',
            'password.max' => '密码长度不能超过16个字符',
            'password.min' => '密码长度不能小于6个字符',
            'password.confirmed' => '两次密码不同',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}
