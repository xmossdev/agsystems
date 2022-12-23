<?php

namespace App\Http\Requests\Warehouse;

use App\Http\Requests\ApiRequest;

class IndexRequest extends ApiRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'filter.name' => 'nullable',
            'filter.code'=> 'nullable',
            'filter.paginate.page' => 'nullable|integer',
            'filter.paginate.perPage' => 'nullable|integer',
        ];
    }
}
