<?php

namespace App\Http\Requests\Api;

use App\Models\PackageSize;

class UpdatePackageSizeAPIRequest extends BaseAPIRequest
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
     * @return array
     */
    public function rules()
    {
        return PackageSize::$api_update_rules;
    }
}
