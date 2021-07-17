<?php

namespace App\Repositories\Admin;

use App\Models\OrderService;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderServiceRepository
 * @package App\Repositories\Admin
 * @version April 16, 2021, 5:36 pm UTC
 *
 * @method OrderService findWithoutFail($id, $columns = ['*'])
 * @method OrderService find($id, $columns = ['*'])
 * @method OrderService first($columns = ['*'])
 */
class OrderServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pet_id',
        'order_id',
        'service_id',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderService::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input        = $request instanceof Request ? $request->all() : $request;
        $orderService = $this->create($input);
        return $orderService;
    }

    /**
     * @param $request
     * @param $orderService
     * @return mixed
     */
    public function updateRecord($request, $orderService)
    {
        $input        = $request->all();
        $orderService = $this->update($input, $orderService->id);
        return $orderService;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $orderService = $this->delete($id);
        return $orderService;
    }
}
