<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeBannerManagementTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerManagementApiTest extends TestCase
{
    use MakeBannerManagementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBannerManagement()
    {
        $bannerManagement = $this->fakeBannerManagementData();
        $this->json('POST', '/api/v1/banner-managements', $bannerManagement);

        $this->assertApiResponse($bannerManagement);
    }

    /**
     * @test
     */
    public function testReadBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $this->json('GET', '/api/v1/banner-managements/'.$bannerManagement->id);

        $this->assertApiResponse($bannerManagement->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $editedBannerManagement = $this->fakeBannerManagementData();

        $this->json('PUT', '/api/v1/banner-managements/'.$bannerManagement->id, $editedBannerManagement);

        $this->assertApiResponse($editedBannerManagement);
    }

    /**
     * @test
     */
    public function testDeleteBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $this->json('DELETE', '/api/v1/banner-managements/'.$bannerManagement->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/banner-managements/'.$bannerManagement->id);

        $this->assertResponseStatus(404);
    }
}
