<?php

namespace App\Repositories\Admin;

use App\Models\SubmenuList;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SubmenuListRepository
 * @package App\Repositories\Admin
 * @version April 2, 2021, 5:27 pm UTC
 *
 * @method SubmenuList findWithoutFail($id, $columns = ['*'])
 * @method SubmenuList find($id, $columns = ['*'])
 * @method SubmenuList first($columns = ['*'])
*/
class SubmenuListRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cat_service_id',
        'name',
        'decription',
        'condition_option',
        'select_count'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SubmenuList::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $submenuList = $this->create($input);
        return $submenuList;
    }

    /**
     * @param $request
     * @param $submenuList
     * @return mixed
     */
    public function updateRecord($request, $submenuList)
    {
        $input = $request->all();
        $submenuList = $this->update($input, $submenuList->id);
        return $submenuList;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $submenuList = $this->delete($id);
        return $submenuList;
    }
}
