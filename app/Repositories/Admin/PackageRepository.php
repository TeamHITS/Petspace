<?php

namespace App\Repositories\Admin;

use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackageRepository
 * @package App\Repositories\Admin
 * @version February 28, 2021, 6:45 pm UTC
 *
 * @method Package findWithoutFail($id, $columns = ['*'])
 * @method Package find($id, $columns = ['*'])
 * @method Package first($columns = ['*'])
*/
class PackageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'petspace_id',
        'name',
        'package_type',
        'description',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Package::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file                 = $request->file('image');
            $input['image'] = Storage::putFile('packages', $file);
        }
        $package = $this->create($input);
        return $package;
    }

    /**
     * @param $request
     * @param $package
     * @return mixed
     */
    public function updateRecord($request, $package)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file                 = $request->file('image');
            $input['image'] = Storage::putFile('packages', $file);
        }
        $package = $this->update($input, $package->id);
        return $package;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $package = $this->delete($id);
        return $package;
    }
}
