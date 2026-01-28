<?php

namespace App\Http\Requests;

use App\Enums\ItemType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;

class StoreInvoiceRequest extends FormRequest
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
            'client_id' => 'required|integer|exists:clients,id',
            'due_date' => 'required|date',
            'discount' => 'required|decimal:0,2',
            'tax' => 'required|decimal:0,2',
            'subtotal' => 'required|decimal:0,2',
            'total' => 'required|decimal:0,2',
            'notes' => 'max:120',
            'items' => 'required|array',
            'items.*.description' => 'required|max:100',
            'items.*.quantity' => 'required|integer',
            'items.*.unit_price' => 'required|decimal:0,2',
            'items.*.type' => ['required', new Enum(ItemType::class)],
        ];
    }

    public function messages()
    {
        return [
            'company_id.exists' => 'The selected company is invalid',
            'client_id.exists' => 'The selected client is invalid'
        ];
    }

    /**
     * Disable default redirect response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors ocurred',
            'errors' => $validator->errors()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
