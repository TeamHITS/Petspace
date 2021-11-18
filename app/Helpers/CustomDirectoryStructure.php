<?php


namespace App\Helpers;

use App\Models\Business;
use App\Models\Opportunity;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

class CustomDirectoryStructure implements \Spatie\MediaLibrary\PathGenerator\PathGenerator
{

    public function getPath(Media $media): string
    {
        if ($media->model_type == 'App\\Models\\Opportunity') {
            $opportunity = Opportunity::find($media->model_id);
            $business = Business::find($opportunity->business_id);

            return 'opportunity/' . Str::slug($business->title) . '/' . $opportunity->opportunity_id . '/' . $media->collection_name . '/';
        } else {
            $arr = explode("\\", $media->collection_name);
            return end($arr) . '/' . $media->model_id . '/';
        }
    }

    public function getPathForConversions(Media $media): string
    {
        if ($media->model_type == 'App\\Models\\Opportunity') {
            $opportunity = Opportunity::find($media->model_id);
            $business = Business::find($opportunity->business_id);

            return 'opportunity/' . Str::slug($business->title) . '/' . $opportunity->opportunity_id . '/' . $media->collection_name . '/c/';
        } else {
            $arr = explode("\\", $media->collection_name);
            return end($arr) . '/' . $media->model_id . '/c/';
        }
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        if ($media->model_type == 'App\\Models\\Opportunity') {
            $opportunity = Opportunity::find($media->model_id);
            $business = Business::find($opportunity->business_id);

            return 'opportunity/' . Str::slug($business->title) . '/' . $opportunity->opportunity_id . '/' . $media->collection_name . '/c/';
        } else {
            $arr = explode("\\", $media->collection_name);
            return end($arr) . '/' . $media->model_id . '/c/';
        }
    }
}
