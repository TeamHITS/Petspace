<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeOrderProgressTrait;
use App\Models\OrderProgress;
use App\Repositories\Admin\OrderProgressRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderProgressRepositoryTest extends TestCase
{
    use MakeOrderProgressTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderProgressRepository
     */
    protected $orderProgressRepo;

    public function setUp()
    {
        parent::setUp();
        $this->orderProgressRepo = App::make(OrderProgressRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrderProgress()
    {
        $orderProgress = $this->fakeOrderProgressData();
        $createdOrderProgress = $this->orderProgressRepo->create($orderProgress);
        $createdOrderProgress = $createdOrderProgress->toArray();
        $this->assertArrayHasKey('id', $createdOrderProgress);
        $this->assertNotNull($createdOrderProgress['id'], 'Created OrderProgress must have id specified');
        $this->assertNotNull(OrderProgress::find($createdOrderProgress['id']), 'OrderProgress with given id must be in DB');
        $this->assertModelData($orderProgress, $createdOrderProgress);
    }

    /**
     * @test read
     */
    public function testReadOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $dbOrderProgress = $this->orderProgressRepo->find($orderProgress->id);
        $dbOrderProgress = $dbOrderProgress->toArray();
        $this->assertModelData($orderProgress->toArray(), $dbOrderProgress);
    }

    /**
     * @test update
     */
    public function testUpdateOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $fakeOrderProgress = $this->fakeOrderProgressData();
        $updatedOrderProgress = $this->orderProgressRepo->update($fakeOrderProgress, $orderProgress->id);
        $this->assertModelData($fakeOrderProgress, $updatedOrderProgress->toArray());
        $dbOrderProgress = $this->orderProgressRepo->find($orderProgress->id);
        $this->assertModelData($fakeOrderProgress, $dbOrderProgress->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $resp = $this->orderProgressRepo->delete($orderProgress->id);
        $this->assertTrue($resp);
        $this->assertNull(OrderProgress::find($orderProgress->id), 'OrderProgress should not exist in DB');
    }
}
