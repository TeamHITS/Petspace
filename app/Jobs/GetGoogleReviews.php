<?php

namespace App\Jobs;

use App\Models\Petspace;
use App\Repositories\Admin\PetspaceRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetGoogleReviews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $shops = Petspace::all();
        $shops = $shops->toArray();

        foreach ($shops as $shop) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $shop['name'] . "&inputtype=textquery&fields=photos,formatted_address,name,opening_hours,rating&locationbias=circle:2000@" . $shop['latitude'] . "," . $shop['longitude'] . "&key=AIzaSyAtE6o_3Gvd8ud0Xt_NJcpAiNPik03Ubuk",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "GET",
                CURLOPT_POSTFIELDS     => "",
                CURLOPT_HTTPHEADER     => array(
                    "Postman-Token: ed685e3b-46b1-41fd-bbde-bc7233a4d3c7",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err      = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);
                if ($response->candidates) {

                    $partner = Petspace::find($shop['id'] );
                    $partner->google_rating = $response->candidates[0]->rating;
                    $partner->save();
                    echo "Shop Name: " . $shop['name'] . "    --- Rating: " . $response->candidates[0]->rating;
                }

            }
        }
    }
}
