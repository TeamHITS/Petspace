<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePackageAddonTrait;
use App\Models\PackageAddon;
use App\Repositories\Admin\PackageAddonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackageAddonRepositoryTest extends TestCase
{
    use MakePackageAddonTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PackageAddonRepository
     */
    protected $packageAddonRepo;

    public function setUp()
    {
        parent::setUp();
        $this->packageAddonRepo = App::make(PackageAddonRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePackageAddon()
    {
        $packageAddon = $this->fakePackageAddonData();
        $createdPackageAddon = $this->packageAddonRepo->create($packageAddon);
        $createdPackageAddon = $createdPackageAddon->toArray();
        $this->assertArrayHasKey('id', $createdPackageAddon);
        $this->assertNotNull($createdPackageAddon['id'], 'Created PackageAddon must have id specified');
        $this->assertNotNull(PackageAddon::find($createdPackageAddon['id']), 'PackageAddon with given id must be in DB');
        $this->assertModelData($packageAddon, $createdPackageAddon);
    }

    /**
     * @test read
     */
    public function testReadPackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $dbPackageAddon = $this->packageAddonRepo->find($packageAddon->id);
        $dbPackageAddon = $dbPackageAddon->toArray();
        $this->assertModelData($packageAddon->toArray(), $dbPackageAddon);
    }

    /**
     * @test update
     */
    public function testUpdatePackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $fakePackageAddon = $this->fakePackageAddonData();
        $updatedPackageAddon = $this->packageAddonRepo->update($fakePackageAddon, $packageAddon->id);
        $this->assertModelData($fakePackageAddon, $updatedPackageAddon->toArray());
        $dbPackageAddon = $this->packageAddonRepo->find($packageAddon->id);
        $this->assertModelData($fakePackageAddon, $dbPackageAddon->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePackageAddon()
    {
        $packageAddon = $this->makePackageAddon();
        $resp = $this->packageAddonRepo->delete($packageAddon->id);
        $this->assertTrue($resp);
        $this->assertNull(PackageAddon::find($packageAddon->id), 'PackageAddon should not exist in DB');
    }
}
