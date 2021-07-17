<?php

namespace App\Repositories\Admin;

use App\Models\PackageType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackageTypeRepository
 * @package App\Repositories\Admin
 * @version February 28, 2021, 7:02 pm UTC
 *
 * @method PackageType findWithoutFail($id, $columns = ['*'])
 * @method PackageType find($id, $columns = ['*'])
 * @method PackageType first($columns = ['*'])
*/
class PackageTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PackageType::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $packageType = $this->create($input);
        return $packageType;
    }

    /**
     * @param $request
     * @param $packageType
     * @return mixed
     */
    public function updateRecord($request, $packageType)
    {
        $input = $request->all();
        $packageType = $this->update($input, $packageType->id);
        return $packageType;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $packageType = $this->delete($id);
        return $packageType;
    }
}
