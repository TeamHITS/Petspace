<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeUserCardTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCardApiTest extends TestCase
{
    use MakeUserCardTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserCard()
    {
        $userCard = $this->fakeUserCardData();
        $this->json('POST', '/api/v1/user-cards', $userCard);

        $this->assertApiResponse($userCard);
    }

    /**
     * @test
     */
    public function testReadUserCard()
    {
        $userCard = $this->makeUserCard();
        $this->json('GET', '/api/v1/user-cards/'.$userCard->id);

        $this->assertApiResponse($userCard->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserCard()
    {
        $userCard = $this->makeUserCard();
        $editedUserCard = $this->fakeUserCardData();

        $this->json('PUT', '/api/v1/user-cards/'.$userCard->id, $editedUserCard);

        $this->assertApiResponse($editedUserCard);
    }

    /**
     * @test
     */
    public function testDeleteUserCard()
    {
        $userCard = $this->makeUserCard();
        $this->json('DELETE', '/api/v1/user-cards/'.$userCard->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/user-cards/'.$userCard->id);

        $this->assertResponseStatus(404);
    }
}
