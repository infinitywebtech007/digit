<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust based on auth requirements
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'call_id' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'party_id' => 'nullable|exists:parties,id',
            'user_id' => 'nullable|exists:users,id',
            'reported_problem' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'next_follow_up_date' => 'nullable|date',
            'priority' => 'nullable|string|max:255',
        ];
    }
}
