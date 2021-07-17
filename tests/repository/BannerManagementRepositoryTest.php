<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeBannerManagementTrait;
use App\Models\BannerManagement;
use App\Repositories\Admin\BannerManagementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerManagementRepositoryTest extends TestCase
{
    use MakeBannerManagementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BannerManagementRepository
     */
    protected $bannerManagementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bannerManagementRepo = App::make(BannerManagementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBannerManagement()
    {
        $bannerManagement = $this->fakeBannerManagementData();
        $createdBannerManagement = $this->bannerManagementRepo->create($bannerManagement);
        $createdBannerManagement = $createdBannerManagement->toArray();
        $this->assertArrayHasKey('id', $createdBannerManagement);
        $this->assertNotNull($createdBannerManagement['id'], 'Created BannerManagement must have id specified');
        $this->assertNotNull(BannerManagement::find($createdBannerManagement['id']), 'BannerManagement with given id must be in DB');
        $this->assertModelData($bannerManagement, $createdBannerManagement);
    }

    /**
     * @test read
     */
    public function testReadBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $dbBannerManagement = $this->bannerManagementRepo->find($bannerManagement->id);
        $dbBannerManagement = $dbBannerManagement->toArray();
        $this->assertModelData($bannerManagement->toArray(), $dbBannerManagement);
    }

    /**
     * @test update
     */
    public function testUpdateBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $fakeBannerManagement = $this->fakeBannerManagementData();
        $updatedBannerManagement = $this->bannerManagementRepo->update($fakeBannerManagement, $bannerManagement->id);
        $this->assertModelData($fakeBannerManagement, $updatedBannerManagement->toArray());
        $dbBannerManagement = $this->bannerManagementRepo->find($bannerManagement->id);
        $this->assertModelData($fakeBannerManagement, $dbBannerManagement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBannerManagement()
    {
        $bannerManagement = $this->makeBannerManagement();
        $resp = $this->bannerManagementRepo->delete($bannerManagement->id);
        $this->assertTrue($resp);
        $this->assertNull(BannerManagement::find($bannerManagement->id), 'BannerManagement should not exist in DB');
    }
}
