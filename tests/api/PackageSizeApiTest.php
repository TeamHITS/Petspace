<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePackageSizeTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageSizeApiTest extends TestCase
{
    use MakePackageSizeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePackageSize()
    {
        $packageSize = $this->fakePackageSizeData();
        $this->json('POST', '/api/v1/package-sizes', $packageSize);

        $this->assertApiResponse($packageSize);
    }

    /**
     * @test
     */
    public function testReadPackageSize()
    {
        $packageSize = $this->makePackageSize();
        $this->json('GET', '/api/v1/package-sizes/'.$packageSize->id);

        $this->assertApiResponse($packageSize->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePackageSize()
    {
        $packageSize = $this->makePackageSize();
        $editedPackageSize = $this->fakePackageSizeData();

        $this->json('PUT', '/api/v1/package-sizes/'.$packageSize->id, $editedPackageSize);

        $this->assertApiResponse($editedPackageSize);
    }

    /**
     * @test
     */
    public function testDeletePackageSize()
    {
        $packageSize = $this->makePackageSize();
        $this->json('DELETE', '/api/v1/package-sizes/'.$packageSize->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/package-sizes/'.$packageSize->id);

        $this->assertResponseStatus(404);
    }
}
