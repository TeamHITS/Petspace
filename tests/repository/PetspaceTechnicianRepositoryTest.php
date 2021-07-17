<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePetspaceTechnicianTrait;
use App\Models\PetspaceTechnician;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetspaceTechnicianRepositoryTest extends TestCase
{
    use MakePetspaceTechnicianTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PetspaceTechnicianRepository
     */
    protected $petspaceTechnicianRepo;

    public function setUp()
    {
        parent::setUp();
        $this->petspaceTechnicianRepo = App::make(PetspaceTechnicianRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePetspaceTechnician()
    {
        $petspaceTechnician = $this->fakePetspaceTechnicianData();
        $createdPetspaceTechnician = $this->petspaceTechnicianRepo->create($petspaceTechnician);
        $createdPetspaceTechnician = $createdPetspaceTechnician->toArray();
        $this->assertArrayHasKey('id', $createdPetspaceTechnician);
        $this->assertNotNull($createdPetspaceTechnician['id'], 'Created PetspaceTechnician must have id specified');
        $this->assertNotNull(PetspaceTechnician::find($createdPetspaceTechnician['id']), 'PetspaceTechnician with given id must be in DB');
        $this->assertModelData($petspaceTechnician, $createdPetspaceTechnician);
    }

    /**
     * @test read
     */
    public function testReadPetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $dbPetspaceTechnician = $this->petspaceTechnicianRepo->find($petspaceTechnician->id);
        $dbPetspaceTechnician = $dbPetspaceTechnician->toArray();
        $this->assertModelData($petspaceTechnician->toArray(), $dbPetspaceTechnician);
    }

    /**
     * @test update
     */
    public function testUpdatePetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $fakePetspaceTechnician = $this->fakePetspaceTechnicianData();
        $updatedPetspaceTechnician = $this->petspaceTechnicianRepo->update($fakePetspaceTechnician, $petspaceTechnician->id);
        $this->assertModelData($fakePetspaceTechnician, $updatedPetspaceTechnician->toArray());
        $dbPetspaceTechnician = $this->petspaceTechnicianRepo->find($petspaceTechnician->id);
        $this->assertModelData($fakePetspaceTechnician, $dbPetspaceTechnician->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $resp = $this->petspaceTechnicianRepo->delete($petspaceTechnician->id);
        $this->assertTrue($resp);
        $this->assertNull(PetspaceTechnician::find($petspaceTechnician->id), 'PetspaceTechnician should not exist in DB');
    }
}
