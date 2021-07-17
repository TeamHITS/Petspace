<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserPetCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserPetCriteria extends BaseCriteria  implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    protected $is_mine              = null;

    public function apply($model, RepositoryInterface $repository)
    {
        // Check if is_mine Property is set
        if ($this->isset('is_mine')) {
            // If is_mine Property is set,
            //  add a condition to include only those data which have user_id=\Auth::id()
            $model = $model->where(['user_id' => \Auth::id()]);
        }

        return $model;
    }
}
