<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
            'expense_date' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'A description is required.',
            'amount.required' => 'An amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least $0.01.',
            'amount.max' => 'The amount cannot exceed $999,999.99.',
            'expense_date.required' => 'The date is required.',
            'expense_date.date' => 'Please enter a valid date.',
            'expense_date.before_or_equal' => 'The date cannot be in the future.',
        ];
    }
}