<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePackageTypeTrait;
use App\Models\PackageType;
use App\Repositories\Admin\PackageTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageTypeRepositoryTest extends TestCase
{
    use MakePackageTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PackageTypeRepository
     */
    protected $packageTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->packageTypeRepo = App::make(PackageTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePackageType()
    {
        $packageType = $this->fakePackageTypeData();
        $createdPackageType = $this->packageTypeRepo->create($packageType);
        $createdPackageType = $createdPackageType->toArray();
        $this->assertArrayHasKey('id', $createdPackageType);
        $this->assertNotNull($createdPackageType['id'], 'Created PackageType must have id specified');
        $this->assertNotNull(PackageType::find($createdPackageType['id']), 'PackageType with given id must be in DB');
        $this->assertModelData($packageType, $createdPackageType);
    }

    /**
     * @test read
     */
    public function testReadPackageType()
    {
        $packageType = $this->makePackageType();
        $dbPackageType = $this->packageTypeRepo->find($packageType->id);
        $dbPackageType = $dbPackageType->toArray();
        $this->assertModelData($packageType->toArray(), $dbPackageType);
    }

    /**
     * @test update
     */
    public function testUpdatePackageType()
    {
        $packageType = $this->makePackageType();
        $fakePackageType = $this->fakePackageTypeData();
        $updatedPackageType = $this->packageTypeRepo->update($fakePackageType, $packageType->id);
        $this->assertModelData($fakePackageType, $updatedPackageType->toArray());
        $dbPackageType = $this->packageTypeRepo->find($packageType->id);
        $this->assertModelData($fakePackageType, $dbPackageType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePackageType()
    {
        $packageType = $this->makePackageType();
        $resp = $this->packageTypeRepo->delete($packageType->id);
        $this->assertTrue($resp);
        $this->assertNull(PackageType::find($packageType->id), 'PackageType should not exist in DB');
    }
}
