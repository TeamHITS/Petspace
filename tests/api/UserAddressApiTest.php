<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeUserAddressTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAddressApiTest extends TestCase
{
    use MakeUserAddressTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserAddress()
    {
        $userAddress = $this->fakeUserAddressData();
        $this->json('POST', '/api/v1/user-addresses', $userAddress);

        $this->assertApiResponse($userAddress);
    }

    /**
     * @test
     */
    public function testReadUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $this->json('GET', '/api/v1/user-addresses/'.$userAddress->id);

        $this->assertApiResponse($userAddress->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $editedUserAddress = $this->fakeUserAddressData();

        $this->json('PUT', '/api/v1/user-addresses/'.$userAddress->id, $editedUserAddress);

        $this->assertApiResponse($editedUserAddress);
    }

    /**
     * @test
     */
    public function testDeleteUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $this->json('DELETE', '/api/v1/user-addresses/'.$userAddress->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/user-addresses/'.$userAddress->id);

        $this->assertResponseStatus(404);
    }
}
