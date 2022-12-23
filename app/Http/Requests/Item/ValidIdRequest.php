<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\ApiRequest;
use App\Models\Item;

class ValidIdRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validationData(): array
    {
        $id = request()->route('id');
        return array_merge($this->all(), ['id' => $id]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:' . Item::class . ',id',
        ];
    }
}
