<?php

namespace App\Models;

/**
 * Class Register
 * @package App\Models
 *
 * @SWG\Definition(
 *      definition="Register",
 *      required={"name", "email", "phone", "address", "gender","image","date_of_birth", "password", "password_confirmation", "device_token", "device_type"},
 *      @SWG\Property(
 *          property="name",
 *          description="User Name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="User Phone Name",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="email",
 *          description="User Email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="Password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),@SWG\Property(
 *          property="date_of_birth",
 *          description="date_of_birth",
 *          type="string"
 *      ), @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="password_confirmation",
 *          description="Password Confirmation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="device_token",
 *          description="Device Token",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="device_type",
 *          description="User Device Type:ios,android,web",
 *          type="string"
 *      )
 * )
 */
class Register
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'                  => 'required',
        'image'                 => 'sometimes|image|mimes:jpg,png',
        'gender'                => 'sometimes',
        'date_of_birth'         => 'sometimes',
        'email'                 => 'required|email',//|unique:users,email
        'device_token'          => 'sometimes|required',
        'device_type'           => 'required|string|in:ios,android,web',
        'password'              => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6'
    ];
}