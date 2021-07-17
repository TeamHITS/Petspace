<?php

namespace App\Repositories\Admin;

use App\Models\SubmenuService;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SubmenuServiceRepository
 * @package App\Repositories\Admin
 * @version April 2, 2021, 5:28 pm UTC
 *
 * @method SubmenuService findWithoutFail($id, $columns = ['*'])
 * @method SubmenuService find($id, $columns = ['*'])
 * @method SubmenuService first($columns = ['*'])
*/
class SubmenuServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'submenu_id',
        'name',
        'description',
        'price',
        'discount',
        'service_duration'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SubmenuService::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $submenuService = $this->create($input);
        return $submenuService;
    }

    /**
     * @param $request
     * @param $submenuService
     * @return mixed
     */
    public function updateRecord($request, $submenuService)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $submenuService = $this->update($input, $submenuService->id);
        return $submenuService;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $submenuService = $this->delete($id);
        return $submenuService;
    }
}
