<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeOrderServiceAddonTrait;
use App\Models\OrderServiceAddon;
use App\Repositories\Admin\OrderServiceAddonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderServiceAddonRepositoryTest extends TestCase
{
    use MakeOrderServiceAddonTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderServiceAddonRepository
     */
    protected $orderServiceAddonRepo;

    public function setUp()
    {
        parent::setUp();
        $this->orderServiceAddonRepo = App::make(OrderServiceAddonRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrderServiceAddon()
    {
        $orderServiceAddon = $this->fakeOrderServiceAddonData();
        $createdOrderServiceAddon = $this->orderServiceAddonRepo->create($orderServiceAddon);
        $createdOrderServiceAddon = $createdOrderServiceAddon->toArray();
        $this->assertArrayHasKey('id', $createdOrderServiceAddon);
        $this->assertNotNull($createdOrderServiceAddon['id'], 'Created OrderServiceAddon must have id specified');
        $this->assertNotNull(OrderServiceAddon::find($createdOrderServiceAddon['id']), 'OrderServiceAddon with given id must be in DB');
        $this->assertModelData($orderServiceAddon, $createdOrderServiceAddon);
    }

    /**
     * @test read
     */
    public function testReadOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $dbOrderServiceAddon = $this->orderServiceAddonRepo->find($orderServiceAddon->id);
        $dbOrderServiceAddon = $dbOrderServiceAddon->toArray();
        $this->assertModelData($orderServiceAddon->toArray(), $dbOrderServiceAddon);
    }

    /**
     * @test update
     */
    public function testUpdateOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $fakeOrderServiceAddon = $this->fakeOrderServiceAddonData();
        $updatedOrderServiceAddon = $this->orderServiceAddonRepo->update($fakeOrderServiceAddon, $orderServiceAddon->id);
        $this->assertModelData($fakeOrderServiceAddon, $updatedOrderServiceAddon->toArray());
        $dbOrderServiceAddon = $this->orderServiceAddonRepo->find($orderServiceAddon->id);
        $this->assertModelData($fakeOrderServiceAddon, $dbOrderServiceAddon->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $resp = $this->orderServiceAddonRepo->delete($orderServiceAddon->id);
        $this->assertTrue($resp);
        $this->assertNull(OrderServiceAddon::find($orderServiceAddon->id), 'OrderServiceAddon should not exist in DB');
    }
}
