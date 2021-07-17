<?php

namespace App\Repositories\Admin;

use App\Models\UserAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserAddressRepository
 * @package App\Repositories\Admin
 * @version February 14, 2021, 10:59 am UTC
 *
 * @method UserAddress findWithoutFail($id, $columns = ['*'])
 * @method UserAddress find($id, $columns = ['*'])
 * @method UserAddress first($columns = ['*'])
*/
class UserAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'type',
        'address'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserAddress::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::id();
        $userAddress = $this->create($input);
        return $userAddress;
    }

    /**
     * @param $request
     * @param $userAddress
     * @return mixed
     */
    public function updateRecord($request, $userAddress)
    {
        $input = $request->all();
        $userAddress = $this->update($input, $userAddress->id);
        return $userAddress;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $userAddress = $this->delete($id);
        return $userAddress;
    }
}
