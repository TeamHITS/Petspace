<?php

namespace App\Repositories\Admin;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories\Admin
 * @version March 17, 2021, 9:17 pm UTC
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "user_id",
        "petspace_id",
        "user_address_id",
        "technician_id",
        "slot_id",
        "date_time",
        "status",
        "sub_total",
        "tax",
        "delivery_fee",
        "total",
        "rating",
        "rating_comment",
        "note"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input            = $request instanceof Request ? $request->all() : $request;
        $order = $this->create($input);
        return $order;
    }

    /**
     * @param $request
     * @param $order
     * @return mixed
     */
    public function updateRecord($request, $order)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $order = $this->update($input, $order->id);
        return $order;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $order = $this->delete($id);
        return $order;
    }
}
