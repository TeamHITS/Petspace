<?php

namespace App\Repositories\Admin;

use App\Models\OrderServicePet;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderServicePetRepository
 * @package App\Repositories\Admin
 * @version November 12, 2021, 5:19 pm +04
 *
 * @method OrderServicePet findWithoutFail($id, $columns = ['*'])
 * @method OrderServicePet find($id, $columns = ['*'])
 * @method OrderServicePet first($columns = ['*'])
 */
class OrderServicePetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'name',
        'type',
        'gender',
        'breed',
        'weight',
        'color',
        'chip_id_num',
        'image',
        'birthdate',
        'neutered',
        'instruction',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderServicePet::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        if (is_array($request)) {
            $input = $request;
        } else {
            $input = $request->all();
        }
        $orderServicePet = $this->create($input);
        return $orderServicePet;
    }

    /**
     * @param $request
     * @param $orderServicePet
     * @return mixed
     */
    public function updateRecord($request, $orderServicePet)
    {
        if (is_array($request)) {
            $input = $request;
        } else {
            $input = $request->all();
        }
        $orderServicePet = $this->update($input, $orderServicePet->id);
        return $orderServicePet;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $orderServicePet = $this->delete($id);
        return $orderServicePet;
    }
}
