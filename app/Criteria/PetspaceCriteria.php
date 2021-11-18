<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PetspaceCriteria.
 *
 * @package namespace App\Criteria;
 */
class PetspaceCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    protected $petspace_id   = null;
    protected $with_category = null;
    protected $latitude      = null;
    protected $longitude     = null;
    protected $area          = null;
    protected $distance      = null;
    protected $is_approved   = null;

    private $distance_query = '( ? * acos ( cos ( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin ( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance';

    public function apply($model, RepositoryInterface $repository)
    {

        if ($this->isset('with_category')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->with('category');
        }


        if ($this->isset('petspace_id')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('id', '=', $this->petspace_id);
        }
        if ($this->isset('is_approved')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('is_approved', '=', $this->is_approved);
        }

        if ($this->isset('latitude') && $this->isset('longitude')) {
            // else if query property is not set and location properties are set
            // then we would only add distance query.
            $latitude      = $this->latitude;
            $longitude     = $this->longitude;
            $area          = $this->area;
            $distance      = $this->distance;
            $distanceQuery = $this->distance_query;
            //commented only for development purpose

            $model = $model->select('*')->selectRaw($distanceQuery, [$area, $latitude, $longitude, $latitude])->having('distance', '<', $distance);

        }

        $model = $model->orderBy('is_temporary_closed', 'ASC');
//        dd($model->getBindings());
//        dd($model->toSql());
        return $model;
    }
}
