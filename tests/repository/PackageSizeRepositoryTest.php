<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePackageSizeTrait;
use App\Models\PackageSize;
use App\Repositories\Admin\PackageSizeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageSizeRepositoryTest extends TestCase
{
    use MakePackageSizeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PackageSizeRepository
     */
    protected $packageSizeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->packageSizeRepo = App::make(PackageSizeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePackageSize()
    {
        $packageSize = $this->fakePackageSizeData();
        $createdPackageSize = $this->packageSizeRepo->create($packageSize);
        $createdPackageSize = $createdPackageSize->toArray();
        $this->assertArrayHasKey('id', $createdPackageSize);
        $this->assertNotNull($createdPackageSize['id'], 'Created PackageSize must have id specified');
        $this->assertNotNull(PackageSize::find($createdPackageSize['id']), 'PackageSize with given id must be in DB');
        $this->assertModelData($packageSize, $createdPackageSize);
    }

    /**
     * @test read
     */
    public function testReadPackageSize()
    {
        $packageSize = $this->makePackageSize();
        $dbPackageSize = $this->packageSizeRepo->find($packageSize->id);
        $dbPackageSize = $dbPackageSize->toArray();
        $this->assertModelData($packageSize->toArray(), $dbPackageSize);
    }

    /**
     * @test update
     */
    public function testUpdatePackageSize()
    {
        $packageSize = $this->makePackageSize();
        $fakePackageSize = $this->fakePackageSizeData();
        $updatedPackageSize = $this->packageSizeRepo->update($fakePackageSize, $packageSize->id);
        $this->assertModelData($fakePackageSize, $updatedPackageSize->toArray());
        $dbPackageSize = $this->packageSizeRepo->find($packageSize->id);
        $this->assertModelData($fakePackageSize, $dbPackageSize->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePackageSize()
    {
        $packageSize = $this->makePackageSize();
        $resp = $this->packageSizeRepo->delete($packageSize->id);
        $this->assertTrue($resp);
        $this->assertNull(PackageSize::find($packageSize->id), 'PackageSize should not exist in DB');
    }
}
