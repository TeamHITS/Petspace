<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeSubmenuServiceTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubmenuServiceApiTest extends TestCase
{
    use MakeSubmenuServiceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSubmenuService()
    {
        $submenuService = $this->fakeSubmenuServiceData();
        $this->json('POST', '/api/v1/submenu-services', $submenuService);

        $this->assertApiResponse($submenuService);
    }

    /**
     * @test
     */
    public function testReadSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $this->json('GET', '/api/v1/submenu-services/'.$submenuService->id);

        $this->assertApiResponse($submenuService->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $editedSubmenuService = $this->fakeSubmenuServiceData();

        $this->json('PUT', '/api/v1/submenu-services/'.$submenuService->id, $editedSubmenuService);

        $this->assertApiResponse($editedSubmenuService);
    }

    /**
     * @test
     */
    public function testDeleteSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $this->json('DELETE', '/api/v1/submenu-services/'.$submenuService->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/submenu-services/'.$submenuService->id);

        $this->assertResponseStatus(404);
    }
}
