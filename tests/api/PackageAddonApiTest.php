<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePackageAddonTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageAddonApiTest extends TestCase
{
    use MakePackageAddonTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePackageAddon()
    {
        $packageAddon = $this->fakePackageAddonData();
        $this->json('POST', '/api/v1/package-addons', $packageAddon);

        $this->assertApiResponse($packageAddon);
    }

    /**
     * @test
     */
    public function testReadPackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $this->json('GET', '/api/v1/package-addons/'.$packageAddon->id);

        $this->assertApiResponse($packageAddon->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $editedPackageAddon = $this->fakePackageAddonData();

        $this->json('PUT', '/api/v1/package-addons/'.$packageAddon->id, $editedPackageAddon);

        $this->assertApiResponse($editedPackageAddon);
    }

    /**
     * @test
     */
    public function testDeletePackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $this->json('DELETE', '/api/v1/package-addons/'.$packageAddon->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/package-addons/'.$packageAddon->id);

        $this->assertResponseStatus(404);
    }
}
