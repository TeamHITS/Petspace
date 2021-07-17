<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeSubmenuListTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubmenuListApiTest extends TestCase
{
    use MakeSubmenuListTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSubmenuList()
    {
        $submenuList = $this->fakeSubmenuListData();
        $this->json('POST', '/api/v1/submenu-lists', $submenuList);

        $this->assertApiResponse($submenuList);
    }

    /**
     * @test
     */
    public function testReadSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $this->json('GET', '/api/v1/submenu-lists/'.$submenuList->id);

        $this->assertApiResponse($submenuList->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $editedSubmenuList = $this->fakeSubmenuListData();

        $this->json('PUT', '/api/v1/submenu-lists/'.$submenuList->id, $editedSubmenuList);

        $this->assertApiResponse($editedSubmenuList);
    }

    /**
     * @test
     */
    public function testDeleteSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $this->json('DELETE', '/api/v1/submenu-lists/'.$submenuList->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/submenu-lists/'.$submenuList->id);

        $this->assertResponseStatus(404);
    }
}
