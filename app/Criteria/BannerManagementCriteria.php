<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BannerManagementCriteria.
 *
 * @package namespace App\Criteria;
 */
class BannerManagementCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $status       = null;

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('status')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('status', '=', $this->status );
        }
        return $model;
    }
}
