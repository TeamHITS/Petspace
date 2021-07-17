<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeUserPetTrait;
use App\Models\UserPet;
use App\Repositories\Admin\UserPetRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserPetRepositoryTest extends TestCase
{
    use MakeUserPetTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserPetRepository
     */
    protected $userPetRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userPetRepo = App::make(UserPetRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserPet()
    {
        $userPet = $this->fakeUserPetData();
        $createdUserPet = $this->userPetRepo->create($userPet);
        $createdUserPet = $createdUserPet->toArray();
        $this->assertArrayHasKey('id', $createdUserPet);
        $this->assertNotNull($createdUserPet['id'], 'Created UserPet must have id specified');
        $this->assertNotNull(UserPet::find($createdUserPet['id']), 'UserPet with given id must be in DB');
        $this->assertModelData($userPet, $createdUserPet);
    }

    /**
     * @test read
     */
    public function testReadUserPet()
    {
        $userPet = $this->makeUserPet();
        $dbUserPet = $this->userPetRepo->find($userPet->id);
        $dbUserPet = $dbUserPet->toArray();
        $this->assertModelData($userPet->toArray(), $dbUserPet);
    }

    /**
     * @test update
     */
    public function testUpdateUserPet()
    {
        $userPet = $this->makeUserPet();
        $fakeUserPet = $this->fakeUserPetData();
        $updatedUserPet = $this->userPetRepo->update($fakeUserPet, $userPet->id);
        $this->assertModelData($fakeUserPet, $updatedUserPet->toArray());
        $dbUserPet = $this->userPetRepo->find($userPet->id);
        $this->assertModelData($fakeUserPet, $dbUserPet->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserPet()
    {
        $userPet = $this->makeUserPet();
        $resp = $this->userPetRepo->delete($userPet->id);
        $this->assertTrue($resp);
        $this->assertNull(UserPet::find($userPet->id), 'UserPet should not exist in DB');
    }
}
