<?php

namespace App\Repositories\Admin;

use App\Models\UserPet;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPetRepository
 * @package App\Repositories\Admin
 * @version February 9, 2021, 7:34 pm UTC
 *
 * @method UserPet findWithoutFail($id, $columns = ['*'])
 * @method UserPet find($id, $columns = ['*'])
 * @method UserPet first($columns = ['*'])
*/
class UserPetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'name',
        'type',
        'gender',
        'breed',
        'weight',
        'color',
        'chip_id_num',
        'image',
        'birthdate',
        'neutered',
        'instruction'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPet::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::id();
        if ($request->hasFile('image')) {
            $file           = $request->file('image');
            $input['image'] = Storage::putFile('pets', $file);
        }
        $userPet = $this->create($input);

        $user = \Auth::user();
        $user->is_pet_added = 1;
        $user->save();

        return $userPet;
    }

    /**
     * @param $request
     * @param $userPet
     * @return mixed
     */
    public function updateRecord($request, $userPet)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file           = $request->file('image');
            $input['image'] = Storage::putFile('pets', $file);
        }
        
        $userPet = $this->update($input, $userPet->id);

        $user = \Auth::user();
        $user->is_pet_added = 1;
        $user->save();
        
        return $userPet;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $userPet = $this->delete($id);
        return $userPet;
    }
}
