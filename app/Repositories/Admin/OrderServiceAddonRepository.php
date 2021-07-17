<?php

namespace App\Repositories\Admin;

use App\Models\OrderServiceAddon;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderServiceAddonRepository
 * @package App\Repositories\Admin
 * @version April 16, 2021, 5:37 pm UTC
 *
 * @method OrderServiceAddon findWithoutFail($id, $columns = ['*'])
 * @method OrderServiceAddon find($id, $columns = ['*'])
 * @method OrderServiceAddon first($columns = ['*'])
 */
class OrderServiceAddonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_service_id',
        'submenu_service_id',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderServiceAddon::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input             = $request instanceof Request ? $request->all() : $request;
        $orderServiceAddon = $this->create($input);
        return $orderServiceAddon;
    }

    /**
     * @param $request
     * @param $orderServiceAddon
     * @return mixed
     */
    public function updateRecord($request, $orderServiceAddon)
    {
        $input             = $request->all();
        $orderServiceAddon = $this->update($input, $orderServiceAddon->id);
        return $orderServiceAddon;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $orderServiceAddon = $this->delete($id);
        return $orderServiceAddon;
    }
}
