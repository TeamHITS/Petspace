<?php

namespace App\Repositories\Admin;

use App\Models\PromoCode;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PromoCodeRepository
 * @package App\Repositories\Admin
 * @version June 11, 2021, 12:20 pm UTC
 *
 * @method PromoCode findWithoutFail($id, $columns = ['*'])
 * @method PromoCode find($id, $columns = ['*'])
 * @method PromoCode first($columns = ['*'])
*/
class PromoCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'discount_percentage',
        'valid_from',
        'valid_to'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PromoCode::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $promoCode = $this->create($input);
        return $promoCode;
    }

    /**
     * @param $request
     * @param $promoCode
     * @return mixed
     */
    public function updateRecord($request, $promoCode)
    {
        $input = $request->all();
        $promoCode = $this->update($input, $promoCode->id);
        return $promoCode;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $promoCode = $this->delete($id);
        return $promoCode;
    }
}
