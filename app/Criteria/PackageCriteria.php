<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PackageCriteria.
 *
 * @package namespace App\Criteria;
 */
class PackageCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    protected $petspace_id             = null;

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('petspace_id')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('petspace_id','=', $this->petspace_id);
        }

        return $model;
    }
}
