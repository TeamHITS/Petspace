<?php

namespace App\Repositories\Admin;

use App\Models\UserCard;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCardRepository
 * @package App\Repositories\Admin
 * @version June 26, 2021, 12:59 pm UTC
 *
 * @method UserCard findWithoutFail($id, $columns = ['*'])
 * @method UserCard find($id, $columns = ['*'])
 * @method UserCard first($columns = ['*'])
 */
class UserCardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'ref',
        'type',
        'last_digits'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCard::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        if (is_array($request)) {
            $input = $request;

        } else {
            $input = $request->all();
        }
        $validate = array(
            "user_id"      => $input['user_id'],
            "type"         => $input['type'],
            "first_digits" => $input['first_digits'],
            "last_digits"  => $input['last_digits'],
            "country"      => $input['country'],
            "expire_month" => $input['expire_month'],
            "expire_year"  => $input['expire_year']
        );
        $userCard = $this->updateOrCreate($validate, $input);
        return $userCard;
    }

    /**
     * @param $request
     * @param $userCard
     * @return mixed
     */
    public function updateRecord($request, $userCard)
    {
        $input    = $request->all();
        $userCard = $this->update($input, $userCard->id);
        return $userCard;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $userCard = $this->delete($id);
        return $userCard;
    }
}
