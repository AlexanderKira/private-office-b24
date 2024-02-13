<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BitrixReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'channel_name' => ['required', 'min:3', 'max:30'],
            'application' => ['required', 'min:3', 'max:30'],
            'conversion_to_sales' => ['required'],
            'sales' => ['required'],
            'revenue' => ['required'],
            'average_check' => ['required'],
            'profit' => ['required'],
            'roi' => ['required'],
        ];
    }
}
