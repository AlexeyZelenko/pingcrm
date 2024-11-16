<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    /**
     * Определите, авторизован ли пользователь для выполнения этого запроса.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Получить правила проверки, которые применяются к запросу.
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Аутентификация пользователя.
     */
    public function authenticate()
    {
        // Проверяем, успешно ли аутентифицирован пользователь
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw new \Illuminate\Validation\ValidationException(
                $this,
                __('auth.failed') // Или любое другое сообщение об ошибке
            );
        }
    }
}
