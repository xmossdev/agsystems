<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\ApiRequest;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends ApiRequest
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
            'name' => 'required|string',
            'price' => 'required',
            'count' => 'required|integer|min:1',
            'warehouse_id' => 'required|integer|exists:' . Warehouse::class . ',id,deleted_at,NULL',
            'id' => 'required|integer|exists:' . Item::class . ',id',
        ];
    }
}
