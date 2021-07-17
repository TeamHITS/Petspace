<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeOrderServiceAddonTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderServiceAddonApiTest extends TestCase
{
    use MakeOrderServiceAddonTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrderServiceAddon()
    {
        $orderServiceAddon = $this->fakeOrderServiceAddonData();
        $this->json('POST', '/api/v1/order-service-addons', $orderServiceAddon);

        $this->assertApiResponse($orderServiceAddon);
    }

    /**
     * @test
     */
    public function testReadOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $this->json('GET', '/api/v1/order-service-addons/'.$orderServiceAddon->id);

        $this->assertApiResponse($orderServiceAddon->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $editedOrderServiceAddon = $this->fakeOrderServiceAddonData();

        $this->json('PUT', '/api/v1/order-service-addons/'.$orderServiceAddon->id, $editedOrderServiceAddon);

        $this->assertApiResponse($editedOrderServiceAddon);
    }

    /**
     * @test
     */
    public function testDeleteOrderServiceAddon()
    {
        $orderServiceAddon = $this->makeOrderServiceAddon();
        $this->json('DELETE', '/api/v1/order-service-addons/'.$orderServiceAddon->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/order-service-addons/'.$orderServiceAddon->id);

        $this->assertResponseStatus(404);
    }
}
