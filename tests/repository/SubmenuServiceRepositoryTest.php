<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeSubmenuServiceTrait;
use App\Models\SubmenuService;
use App\Repositories\Admin\SubmenuServiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubmenuServiceRepositoryTest extends TestCase
{
    use MakeSubmenuServiceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SubmenuServiceRepository
     */
    protected $submenuServiceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->submenuServiceRepo = App::make(SubmenuServiceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSubmenuService()
    {
        $submenuService = $this->fakeSubmenuServiceData();
        $createdSubmenuService = $this->submenuServiceRepo->create($submenuService);
        $createdSubmenuService = $createdSubmenuService->toArray();
        $this->assertArrayHasKey('id', $createdSubmenuService);
        $this->assertNotNull($createdSubmenuService['id'], 'Created SubmenuService must have id specified');
        $this->assertNotNull(SubmenuService::find($createdSubmenuService['id']), 'SubmenuService with given id must be in DB');
        $this->assertModelData($submenuService, $createdSubmenuService);
    }

    /**
     * @test read
     */
    public function testReadSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $dbSubmenuService = $this->submenuServiceRepo->find($submenuService->id);
        $dbSubmenuService = $dbSubmenuService->toArray();
        $this->assertModelData($submenuService->toArray(), $dbSubmenuService);
    }

    /**
     * @test update
     */
    public function testUpdateSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $fakeSubmenuService = $this->fakeSubmenuServiceData();
        $updatedSubmenuService = $this->submenuServiceRepo->update($fakeSubmenuService, $submenuService->id);
        $this->assertModelData($fakeSubmenuService, $updatedSubmenuService->toArray());
        $dbSubmenuService = $this->submenuServiceRepo->find($submenuService->id);
        $this->assertModelData($fakeSubmenuService, $dbSubmenuService->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSubmenuService()
    {
        $submenuService = $this->makeSubmenuService();
        $resp = $this->submenuServiceRepo->delete($submenuService->id);
        $this->assertTrue($resp);
        $this->assertNull(SubmenuService::find($submenuService->id), 'SubmenuService should not exist in DB');
    }
}
