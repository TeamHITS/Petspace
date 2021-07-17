<?php

namespace App\Repositories\Admin;

use App\Models\CategoryService;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryServiceRepository
 * @package App\Repositories\Admin
 * @version April 2, 2021, 5:24 pm UTC
 *
 * @method CategoryService findWithoutFail($id, $columns = ['*'])
 * @method CategoryService find($id, $columns = ['*'])
 * @method CategoryService first($columns = ['*'])
 */
class CategoryServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount',
        'service_duration'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryService::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        if ($request->hasFile('image_url')) {
            $file           = $request->file('image_url');
            $input['image'] = Storage::putFile('service', $file);
        }

        $categoryService = $this->create($input);
        return $categoryService;
    }

    /**
     * @param $request
     * @param $categoryService
     * @return mixed
     */
    public function updateRecord($request, $categoryService)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
            if ($request->hasFile('image_url')) {
                $file           = $request->file('image_url');
                $input['image'] = Storage::putFile('service', $file);
            }
        }

        $categoryService = $this->update($input, $categoryService->id);
        return $categoryService;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $categoryService = $this->delete($id);
        return $categoryService;
    }
}
