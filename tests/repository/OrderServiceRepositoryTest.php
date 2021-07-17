<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeOrderServiceTrait;
use App\Models\OrderService;
use App\Repositories\Admin\OrderServiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderServiceRepositoryTest extends TestCase
{
    use MakeOrderServiceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderServiceRepository
     */
    protected $orderServiceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->orderServiceRepo = App::make(OrderServiceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrderService()
    {
        $orderService = $this->fakeOrderServiceData();
        $createdOrderService = $this->orderServiceRepo->create($orderService);
        $createdOrderService = $createdOrderService->toArray();
        $this->assertArrayHasKey('id', $createdOrderService);
        $this->assertNotNull($createdOrderService['id'], 'Created OrderService must have id specified');
        $this->assertNotNull(OrderService::find($createdOrderService['id']), 'OrderService with given id must be in DB');
        $this->assertModelData($orderService, $createdOrderService);
    }

    /**
     * @test read
     */
    public function testReadOrderService()
    {
        $orderService = $this->makeOrderService();
        $dbOrderService = $this->orderServiceRepo->find($orderService->id);
        $dbOrderService = $dbOrderService->toArray();
        $this->assertModelData($orderService->toArray(), $dbOrderService);
    }

    /**
     * @test update
     */
    public function testUpdateOrderService()
    {
        $orderService = $this->makeOrderService();
        $fakeOrderService = $this->fakeOrderServiceData();
        $updatedOrderService = $this->orderServiceRepo->update($fakeOrderService, $orderService->id);
        $this->assertModelData($fakeOrderService, $updatedOrderService->toArray());
        $dbOrderService = $this->orderServiceRepo->find($orderService->id);
        $this->assertModelData($fakeOrderService, $dbOrderService->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrderService()
    {
        $orderService = $this->makeOrderService();
        $resp = $this->orderServiceRepo->delete($orderService->id);
        $this->assertTrue($resp);
        $this->assertNull(OrderService::find($orderService->id), 'OrderService should not exist in DB');
    }
}
