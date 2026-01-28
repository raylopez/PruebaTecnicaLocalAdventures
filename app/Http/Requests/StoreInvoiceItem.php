<?php

namespace App\Http\Requests;

use App\Enums\ItemType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Enum;

class StoreInvoiceItem extends FormRequest
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
            'invoice_id' => 'required|integer|exists:invoices,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer',
            'unit_price' => 'required|decimal:0,2'
        ];
    }

    public function messages()
    {
        return [
            'invoice_id.exists' => 'The selected invoice is invalid',
            'item_id.exists' => 'The selected item is invalid',
            'unit_price.decimal' => 'The :attribute field must be 2 places'
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
