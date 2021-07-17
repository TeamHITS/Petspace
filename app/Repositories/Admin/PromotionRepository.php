<?php

namespace App\Repositories\Admin;

use App\Models\Promotion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PromotionRepository
 * @package App\Repositories\Admin
 * @version July 7, 2021, 1:53 am +04
 *
 * @method Promotion findWithoutFail($id, $columns = ['*'])
 * @method Promotion find($id, $columns = ['*'])
 * @method Promotion first($columns = ['*'])
*/
class PromotionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'message',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Promotion::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $promotion = $this->create($input);
        return $promotion;
    }

    /**
     * @param $request
     * @param $promotion
     * @return mixed
     */
    public function updateRecord($request, $promotion)
    {
        $input = $request->all();
        $promotion = $this->update($input, $promotion->id);
        return $promotion;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $promotion = $this->delete($id);
        return $promotion;
    }
}
