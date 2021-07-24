<?php

namespace App\Repositories\Admin;

use App\Models\Petspace;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PetspaceRepository
 * @package App\Repositories\Admin
 * @version February 28, 2021, 6:24 pm UTC
 *
 * @method Petspace findWithoutFail($id, $columns = ['*'])
 * @method Petspace find($id, $columns = ['*'])
 * @method Petspace first($columns = ['*'])
 */
class PetspaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'grooming',
        'is_delivery_fee',
        'is_pick_drop_available',
        'delivery_fee',
        'rating'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Petspace::class;
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
            $input['image'] = Storage::putFile('petspace', $file);
        }

        $petspace = $this->create($input);
        return $petspace;
    }

    /**
     * @param $request
     * @param $petspace
     * @return mixed
     */
    public function updateRecord($request, $petspace)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
            if ($request->hasFile('image')) {
                $file                 = $request->file('image');
                $input['image'] = Storage::putFile('petspace', $file);
            }
        }

        if (isset($input['email'])) {
            unset($input['email']);
        }
        if (isset($input['delivery_fee'])) {
            $input['is_delivery_fee'] = 1;
        }else{
            $input['is_delivery_fee'] = 0;
        }

        if (isset($input['is_temporary_closed'])) {
            $input['is_temporary_closed'] = 1;
        }else{
            $input['is_temporary_closed'] = 0;
        }

        $petspace = $this->update($input, $petspace->id);
        return $petspace;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $petspace = $this->delete($id);
        return $petspace;
    }
}
