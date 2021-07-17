<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeOrderProgressTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderProgressApiTest extends TestCase
{
    use MakeOrderProgressTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrderProgress()
    {
        $orderProgress = $this->fakeOrderProgressData();
        $this->json('POST', '/api/v1/order-progresses', $orderProgress);

        $this->assertApiResponse($orderProgress);
    }

    /**
     * @test
     */
    public function testReadOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $this->json('GET', '/api/v1/order-progresses/'.$orderProgress->id);

        $this->assertApiResponse($orderProgress->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $editedOrderProgress = $this->fakeOrderProgressData();

        $this->json('PUT', '/api/v1/order-progresses/'.$orderProgress->id, $editedOrderProgress);

        $this->assertApiResponse($editedOrderProgress);
    }

    /**
     * @test
     */
    public function testDeleteOrderProgress()
    {
        $orderProgress = $this->makeOrderProgress();
        $this->json('DELETE', '/api/v1/order-progresses/'.$orderProgress->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/order-progresses/'.$orderProgress->id);

        $this->assertResponseStatus(404);
    }
}
