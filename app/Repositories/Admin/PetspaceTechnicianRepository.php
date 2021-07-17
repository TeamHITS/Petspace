<?php

namespace App\Repositories\Admin;

use App\Models\PetspaceTechnician;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PetspaceTechnicianRepository
 * @package App\Repositories\Admin
 * @version April 6, 2021, 7:57 pm UTC
 *
 * @method PetspaceTechnician findWithoutFail($id, $columns = ['*'])
 * @method PetspaceTechnician find($id, $columns = ['*'])
 * @method PetspaceTechnician first($columns = ['*'])
*/
class PetspaceTechnicianRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'petspace_id',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PetspaceTechnician::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();

            if($request->has('user_status')) {
                $input['status'] = PetspaceTechnician::AVAILABLE;
            }else {
                $input['status'] = PetspaceTechnician::INACTIVE;
            }
        }

        $petspaceTechnician = $this->create($input);
        return $petspaceTechnician;
    }

    /**
     * @param $request
     * @param $petspaceTechnician
     * @return mixed
     */
    public function updateRecord($request, $petspaceTechnician)
    {
        $input = $request->all();

        if($request->has('user_status') &&  $petspaceTechnician->status == PetspaceTechnician::INACTIVE) {
            $input['status'] = PetspaceTechnician::AVAILABLE;
        }else if(!$request->has('user_status')){
            $input['status'] = PetspaceTechnician::INACTIVE;
        }

        $petspaceTechnician = $this->update($input, $petspaceTechnician->id);
        return $petspaceTechnician;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $petspaceTechnician = $this->delete($id);
        return $petspaceTechnician;
    }
}
