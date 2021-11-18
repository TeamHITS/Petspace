<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    public function uploadFile($file = null, $location = null, $storage = 'public')
    {
        $path = '';
        if (!is_null($file) && !is_null($location)) {
            if ($storage == 'storage') {
                $path = \Storage::disk('public')->putFile($location, $file);
                $path = storage::url($path);
            } else {
                $path = $file->store('public/' . $location);
            }

            return $path;
        }

        return $path;
    }

    public function createImageFromBase64($file_data, $folder)
    {
        @list($type, $file_data) = explode(';', $file_data);

        $ext = array_reverse(explode('/', $type))[0];

        if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
            $file_name = 'image_' . time() . '.png'; //generating unique file name;
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") { // storing image in storage/app/public Folder
                \Storage::disk('public')->put('businesses/' . $folder . "/" . $file_name, base64_decode($file_data));
                $path = storage::url('businesses/' . $folder . "/" . $file_name);
                return $path;
            }
        }

        return null;
    }

    public function storeBusinessImageFile($file, $folder)
    {
        $file_name = 'image_' . time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('businesses/' . $folder . "/" . $file_name, $file);
        $path = storage::url('businesses/' . $folder . "/" . $file_name);
        return $path;
    }

    public function sendEmail($data)
    {
        $email_template = 'email-templates.' . $data['template'];

        Mail::send($email_template, $data, function ($message) use ($data) {
            $message
                ->to($data['email'], $data['firstName'] . ' ' . $data['lastName'])
                ->subject($data['subject']);
            $message
                ->from(
                    env('MAIL_FROM_ADDRESS'),
                    env('MAIL_FROM_NAME')
                );
        });

        return true;
    }

    /**
     * Limit the number of words in a string.
     *
     * @param string $value
     * @param int $words
     * @param string $end
     * @return string
     */
    public function words($value, $words = 100, $end = '...')
    {
        return Str::words($value, $words, $end);
    }

    /**
     * Create unique slug
     *
     * @param string $title
     * @param array $slugs
     */

    public function createSlug($title, $slugs)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;
        while (in_array($slug, $slugs->toArray())) {
            $slug = "$original-" . $count++;
        }
        return $slug;
    }

    public static function generateRandomString($limit = 10)
    {
        return Str::random($limit);
    }
}
