<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryServiceCriteria.
 *
 * @package namespace App\Criteria;
 */
class CategoryServiceCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $with_submenu = null;
    protected $category_id = null;

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('with_submenu')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->with('submenu');
        }

        if ($this->isset('category_id')) {
            // If with_media Property is set,
            //  execute with method to include media too.
            $model = $model->where('id', '=', $this->category_id);
        }

        return $model;
    }
}
