<?php

namespace App\Repositories\Admin;

use App\Models\PackageAddon;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackageAddonRepository
 * @package App\Repositories\Admin
 * @version March 1, 2021, 8:41 pm UTC
 *
 * @method PackageAddon findWithoutFail($id, $columns = ['*'])
 * @method PackageAddon find($id, $columns = ['*'])
 * @method PackageAddon first($columns = ['*'])
*/
class PackageAddonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'description',
        'price',
        'discount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PackageAddon::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $packageAddon = $this->create($input);
        return $packageAddon;
    }

    /**
     * @param $request
     * @param $packageAddon
     * @return mixed
     */
    public function updateRecord($request, $packageAddon)
    {
        $input = $request->all();
        $packageAddon = $this->update($input, $packageAddon->id);
        return $packageAddon;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $packageAddon = $this->delete($id);
        return $packageAddon;
    }
}
