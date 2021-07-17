<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePackageTypeTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageTypeApiTest extends TestCase
{
    use MakePackageTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePackageType()
    {
        $packageType = $this->fakePackageTypeData();
        $this->json('POST', '/api/v1/package-types', $packageType);

        $this->assertApiResponse($packageType);
    }

    /**
     * @test
     */
    public function testReadPackageType()
    {
        $packageType = $this->makePackageType();
        $this->json('GET', '/api/v1/package-types/'.$packageType->id);

        $this->assertApiResponse($packageType->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePackageType()
    {
        $packageType = $this->makePackageType();
        $editedPackageType = $this->fakePackageTypeData();

        $this->json('PUT', '/api/v1/package-types/'.$packageType->id, $editedPackageType);

        $this->assertApiResponse($editedPackageType);
    }

    /**
     * @test
     */
    public function testDeletePackageType()
    {
        $packageType = $this->makePackageType();
        $this->json('DELETE', '/api/v1/package-types/'.$packageType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/package-types/'.$packageType->id);

        $this->assertResponseStatus(404);
    }
}
