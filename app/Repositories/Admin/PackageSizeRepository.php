<?php

namespace App\Repositories\Admin;

use App\Models\PackageSize;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackageSizeRepository
 * @package App\Repositories\Admin
 * @version February 28, 2021, 6:48 pm UTC
 *
 * @method PackageSize findWithoutFail($id, $columns = ['*'])
 * @method PackageSize find($id, $columns = ['*'])
 * @method PackageSize first($columns = ['*'])
*/
class PackageSizeRepository extends BaseRepository
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
        return PackageSize::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $packageSize = $this->create($input);
        return $packageSize;
    }

    /**
     * @param $request
     * @param $packageSize
     * @return mixed
     */
    public function updateRecord($request, $packageSize)
    {
        $input = $request->all();
        $packageSize = $this->update($input, $packageSize->id);
        return $packageSize;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $packageSize = $this->delete($id);
        return $packageSize;
    }
}
