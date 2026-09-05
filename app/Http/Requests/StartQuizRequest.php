<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'quiz_technology_id' => ['required', 'exists:quiz_technologies,id'],
            'quiz_level_id' => ['required', 'exists:quiz_levels,id'],
        ];
    }
}
