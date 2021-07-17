<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderCriteria.
 *
 * @package namespace App\Criteria;
 */
class OrderCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $user_id      = null;
    protected $with_service = null;
    protected $petspace_id  = null;
    protected $latest       = null;

    public function apply($model, RepositoryInterface $repository)
    {

        if ($this->isset('with_service')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->with('services');
        }

        if ($this->isset('user_id')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('user_id', '=', $this->user_id);
        }

        if ($this->isset('petspace_id')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('petspace_id', '=', $this->petspace_id);
        }

        if ($this->isset('latest')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->orderBy('id', 'desc');
        }

        return $model;
    }
}
