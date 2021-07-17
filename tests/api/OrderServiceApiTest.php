<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeOrderServiceTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderServiceApiTest extends TestCase
{
    use MakeOrderServiceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrderService()
    {
        $orderService = $this->fakeOrderServiceData();
        $this->json('POST', '/api/v1/order-services', $orderService);

        $this->assertApiResponse($orderService);
    }

    /**
     * @test
     */
    public function testReadOrderService()
    {
        $orderService = $this->makeOrderService();
        $this->json('GET', '/api/v1/order-services/'.$orderService->id);

        $this->assertApiResponse($orderService->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrderService()
    {
        $orderService = $this->makeOrderService();
        $editedOrderService = $this->fakeOrderServiceData();

        $this->json('PUT', '/api/v1/order-services/'.$orderService->id, $editedOrderService);

        $this->assertApiResponse($editedOrderService);
    }

    /**
     * @test
     */
    public function testDeleteOrderService()
    {
        $orderService = $this->makeOrderService();
        $this->json('DELETE', '/api/v1/order-services/'.$orderService->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/order-services/'.$orderService->id);

        $this->assertResponseStatus(404);
    }
}
