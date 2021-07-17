<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeUserCardTrait;
use App\Models\UserCard;
use App\Repositories\Admin\UserCardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCardRepositoryTest extends TestCase
{
    use MakeUserCardTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserCardRepository
     */
    protected $userCardRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userCardRepo = App::make(UserCardRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserCard()
    {
        $userCard = $this->fakeUserCardData();
        $createdUserCard = $this->userCardRepo->create($userCard);
        $createdUserCard = $createdUserCard->toArray();
        $this->assertArrayHasKey('id', $createdUserCard);
        $this->assertNotNull($createdUserCard['id'], 'Created UserCard must have id specified');
        $this->assertNotNull(UserCard::find($createdUserCard['id']), 'UserCard with given id must be in DB');
        $this->assertModelData($userCard, $createdUserCard);
    }

    /**
     * @test read
     */
    public function testReadUserCard()
    {
        $userCard = $this->makeUserCard();
        $dbUserCard = $this->userCardRepo->find($userCard->id);
        $dbUserCard = $dbUserCard->toArray();
        $this->assertModelData($userCard->toArray(), $dbUserCard);
    }

    /**
     * @test update
     */
    public function testUpdateUserCard()
    {
        $userCard = $this->makeUserCard();
        $fakeUserCard = $this->fakeUserCardData();
        $updatedUserCard = $this->userCardRepo->update($fakeUserCard, $userCard->id);
        $this->assertModelData($fakeUserCard, $updatedUserCard->toArray());
        $dbUserCard = $this->userCardRepo->find($userCard->id);
        $this->assertModelData($fakeUserCard, $dbUserCard->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserCard()
    {
        $userCard = $this->makeUserCard();
        $resp = $this->userCardRepo->delete($userCard->id);
        $this->assertTrue($resp);
        $this->assertNull(UserCard::find($userCard->id), 'UserCard should not exist in DB');
    }
}
