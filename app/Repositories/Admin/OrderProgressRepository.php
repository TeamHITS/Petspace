<?php

namespace App\Repositories\Admin;

use App\Models\OrderProgress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderProgressRepository
 * @package App\Repositories\Admin
 * @version May 26, 2021, 9:52 pm UTC
 *
 * @method OrderProgress findWithoutFail($id, $columns = ['*'])
 * @method OrderProgress find($id, $columns = ['*'])
 * @method OrderProgress first($columns = ['*'])
*/
class OrderProgressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'progress_status',
        'date_time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderProgress::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $orderProgress = $this->create($input);
        return $orderProgress;
    }

    /**
     * @param $request
     * @param $orderProgress
     * @return mixed
     */
    public function updateRecord($request, $orderProgress)
    {
        $input = $request->all();
        $orderProgress = $this->update($input, $orderProgress->id);
        return $orderProgress;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $orderProgress = $this->delete($id);
        return $orderProgress;
    }
}
