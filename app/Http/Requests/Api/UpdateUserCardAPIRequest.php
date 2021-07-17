<?php

namespace App\Http\Requests\Api;

use App\Models\UserCard;

class UpdateUserCardAPIRequest extends BaseAPIRequest
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
        return UserCard::$api_update_rules;
    }
}
