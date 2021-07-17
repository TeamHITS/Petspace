<?php

namespace App\Repositories\Admin;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserDetailRepository
 * @package App\Repositories\Admin
 * @version April 2, 2018, 9:11 am UTC
 *
 * @method UserDetail findWithoutFail($id, $columns = ['*'])
 * @method UserDetail find($id, $columns = ['*'])
 * @method UserDetail first($columns = ['*'])
 */
class UserDetailRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserDetail::class;
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function saveRecord($id, $request)
    {
        $userDetailData         = $request->only(['name', 'first_name', 'last_name', 'password', 'phone', 'address', 'email_updates', 'image', 'technician_color', 'service_assignment','is_verified']);
        $userDetails['user_id'] = $id;
        if ($request->has('name')) {

            $names                     = $request->get('name', "");
            $name                      = explode(" ", $names, 2);
            $userDetails['first_name'] = ucwords($name[0]);

            if (isset($name[1])) {
                $userDetails['last_name'] = ucwords($name[1]);
            } else {
                $userDetails['last_name'] = '';
            }

        } else if ($request->has('first_name')) {
            $userDetails['first_name'] = ucwords($userDetailData['name']);
            $userDetails['last_name']  = isset($userDetailData['last_name']) ? ucwords($userDetailData['last_name']) : null;
        }

//
        $userDetails['phone']         = isset($userDetailData['phone']) ? $userDetailData['phone'] : null;
        $userDetails['gender']        = isset($userDetailData['gender']) ? $userDetailData['gender'] : null;
        $userDetails['address']       = isset($userDetailData['address']) ? $userDetailData['address'] : null;
        $userDetails['date_of_birth'] = isset($userDetailData['date_of_birth']) ? $userDetailData['date_of_birth'] : null;
        $userDetails['email_updates'] = isset($userDetailData['email_updates']) ? $userDetailData['email_updates'] : 1;
        $userDetails['image']         = null;
        //for technicians
//        $userDetails['store_unique_id'] = isset($userDetailData['store_unique_id']) ? $userDetailData['store_unique_id'] : null;
        $userDetails['technician_color']   = isset($userDetailData['technician_color']) ? $userDetailData['technician_color'] : null;
        $userDetails['service_assignment'] = isset($userDetailData['service_assignment']) ? $userDetailData['service_assignment'] : null;

        if ($request->hasFile('image')) {
            $file                 = $request->file('image');
            $userDetails['image'] = Storage::putFile('users', $file);
        }

        if(isset($request->roles)){
            if (in_array(6, $request->roles)) {
                $userDetails['is_verified'] = 1;
            }

        }

        $userDetails = $this->create($userDetails);
        return $userDetails;
    }

    /**
     * @param $id
     * @param $request
     * @return mixed
     */
    public function updateRecord($id, $request)
    {
        $updateData  = [];
        $userDetails = $this->findWhere(['user_id' => $id])->first();
        if ($userDetails) {

            $updateData = $request->all();

//            if ($request->has('name')) {
//                $updateData['first_name'] = $request->get('name');
//            }


            if ($request->has('name')) {

                $names                    = $request->get('name', "");
                $name                     = explode(" ", $names, 2);
                $updateData['first_name'] = ucwords($name[0]);

                if (isset($name[1])) {
                    $updateData['last_name'] = ucwords($name[1]);
                } else {
                    $updateData['last_name'] = '';
                }

            }

            if ($request->hasFile('image')) {
                $file                = $request->file('image');
                $updateData['image'] = Storage::putFile('users', $file);
            }

            $userDetails = $userDetails->update($updateData);
        }
        /*if ($request->hasFile('image')) {
            $file = $request->file('image');
            $userDetails['image'] = Storage::putFile('users', $file);
        }

        $userDetails = $this->update($request, $id);*/
        return $userDetails;
    }
}