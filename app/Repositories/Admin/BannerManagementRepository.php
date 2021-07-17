<?php

namespace App\Repositories\Admin;

use App\Models\BannerManagement;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BannerManagementRepository
 * @package App\Repositories\Admin
 * @version June 18, 2021, 8:57 pm UTC
 *
 * @method BannerManagement findWithoutFail($id, $columns = ['*'])
 * @method BannerManagement find($id, $columns = ['*'])
 * @method BannerManagement first($columns = ['*'])
*/
class BannerManagementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BannerManagement::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file                 = $request->file('image');
            $input['image'] = Storage::putFile('banners', $file);
        }
        $bannerManagement = $this->create($input);
        return $bannerManagement;
    }

    /**
     * @param $request
     * @param $bannerManagement
     * @return mixed
     */
    public function updateRecord($request, $bannerManagement)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file                 = $request->file('image');
            $input['image'] = Storage::putFile('banners', $file);
        }
        $bannerManagement = $this->update($input, $bannerManagement->id);
        return $bannerManagement;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $bannerManagement = $this->delete($id);
        return $bannerManagement;
    }
}
