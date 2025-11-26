<?php

namespace App\Http\Requests;

use App\Enums\TaskType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Authorization is handled by the Policy/Gate in the Controller for now,
        // or we can move the Gate::authorize check here if we have access to the child.
        // For now, we'll return true and let the controller handle the specific child policy check
        // or we can implement it here if we bind the child model.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['required', 'integer', 'min:1'],
            'type' => ['required', Rule::enum(TaskType::class)],
        ];
    }
}
