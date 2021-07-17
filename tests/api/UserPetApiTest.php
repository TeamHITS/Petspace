<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeUserPetTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserPetApiTest extends TestCase
{
    use MakeUserPetTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserPet()
    {
        $userPet = $this->fakeUserPetData();
        $this->json('POST', '/api/v1/user-pets', $userPet);

        $this->assertApiResponse($userPet);
    }

    /**
     * @test
     */
    public function testReadUserPet()
    {
        $userPet = $this->makeUserPet();
        $this->json('GET', '/api/v1/user-pets/'.$userPet->id);

        $this->assertApiResponse($userPet->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserPet()
    {
        $userPet = $this->makeUserPet();
        $editedUserPet = $this->fakeUserPetData();

        $this->json('PUT', '/api/v1/user-pets/'.$userPet->id, $editedUserPet);

        $this->assertApiResponse($editedUserPet);
    }

    /**
     * @test
     */
    public function testDeleteUserPet()
    {
        $userPet = $this->makeUserPet();
        $this->json('DELETE', '/api/v1/user-pets/'.$userPet->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/user-pets/'.$userPet->id);

        $this->assertResponseStatus(404);
    }
}
