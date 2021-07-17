<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeUserAddressTrait;
use App\Models\UserAddress;
use App\Repositories\Admin\UserAddressRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAddressRepositoryTest extends TestCase
{
    use MakeUserAddressTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserAddressRepository
     */
    protected $userAddressRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userAddressRepo = App::make(UserAddressRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserAddress()
    {
        $userAddress = $this->fakeUserAddressData();
        $createdUserAddress = $this->userAddressRepo->create($userAddress);
        $createdUserAddress = $createdUserAddress->toArray();
        $this->assertArrayHasKey('id', $createdUserAddress);
        $this->assertNotNull($createdUserAddress['id'], 'Created UserAddress must have id specified');
        $this->assertNotNull(UserAddress::find($createdUserAddress['id']), 'UserAddress with given id must be in DB');
        $this->assertModelData($userAddress, $createdUserAddress);
    }

    /**
     * @test read
     */
    public function testReadUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $dbUserAddress = $this->userAddressRepo->find($userAddress->id);
        $dbUserAddress = $dbUserAddress->toArray();
        $this->assertModelData($userAddress->toArray(), $dbUserAddress);
    }

    /**
     * @test update
     */
    public function testUpdateUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $fakeUserAddress = $this->fakeUserAddressData();
        $updatedUserAddress = $this->userAddressRepo->update($fakeUserAddress, $userAddress->id);
        $this->assertModelData($fakeUserAddress, $updatedUserAddress->toArray());
        $dbUserAddress = $this->userAddressRepo->find($userAddress->id);
        $this->assertModelData($fakeUserAddress, $dbUserAddress->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserAddress()
    {
        $userAddress = $this->makeUserAddress();
        $resp = $this->userAddressRepo->delete($userAddress->id);
        $this->assertTrue($resp);
        $this->assertNull(UserAddress::find($userAddress->id), 'UserAddress should not exist in DB');
    }
}
