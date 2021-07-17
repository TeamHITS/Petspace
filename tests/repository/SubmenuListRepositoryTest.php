<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeSubmenuListTrait;
use App\Models\SubmenuList;
use App\Repositories\Admin\SubmenuListRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubmenuListRepositoryTest extends TestCase
{
    use MakeSubmenuListTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SubmenuListRepository
     */
    protected $submenuListRepo;

    public function setUp()
    {
        parent::setUp();
        $this->submenuListRepo = App::make(SubmenuListRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSubmenuList()
    {
        $submenuList = $this->fakeSubmenuListData();
        $createdSubmenuList = $this->submenuListRepo->create($submenuList);
        $createdSubmenuList = $createdSubmenuList->toArray();
        $this->assertArrayHasKey('id', $createdSubmenuList);
        $this->assertNotNull($createdSubmenuList['id'], 'Created SubmenuList must have id specified');
        $this->assertNotNull(SubmenuList::find($createdSubmenuList['id']), 'SubmenuList with given id must be in DB');
        $this->assertModelData($submenuList, $createdSubmenuList);
    }

    /**
     * @test read
     */
    public function testReadSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $dbSubmenuList = $this->submenuListRepo->find($submenuList->id);
        $dbSubmenuList = $dbSubmenuList->toArray();
        $this->assertModelData($submenuList->toArray(), $dbSubmenuList);
    }

    /**
     * @test update
     */
    public function testUpdateSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $fakeSubmenuList = $this->fakeSubmenuListData();
        $updatedSubmenuList = $this->submenuListRepo->update($fakeSubmenuList, $submenuList->id);
        $this->assertModelData($fakeSubmenuList, $updatedSubmenuList->toArray());
        $dbSubmenuList = $this->submenuListRepo->find($submenuList->id);
        $this->assertModelData($fakeSubmenuList, $dbSubmenuList->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSubmenuList()
    {
        $submenuList = $this->makeSubmenuList();
        $resp = $this->submenuListRepo->delete($submenuList->id);
        $this->assertTrue($resp);
        $this->assertNull(SubmenuList::find($submenuList->id), 'SubmenuList should not exist in DB');
    }
}
