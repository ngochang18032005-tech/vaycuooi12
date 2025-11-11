<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'avatar' => 'nullable|image|max:2048', // Giới hạn kích thước ảnh tối đa 2MB
            'password' => 'required|string|min:6|confirmed', // Xác nhận mật khẩu
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'email.required' => 'Vui lòng nhập email.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
    }
}
