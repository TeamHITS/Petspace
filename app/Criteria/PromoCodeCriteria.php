<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PromoCodeCriteria.
 *
 * @package namespace App\Criteria;
 */
class PromoCodeCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    protected $code = null;
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('code')) {
            $model = $model->where('code', '=', $this->code);
        }

        return $model;
    }
}
