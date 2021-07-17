<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePetspaceTrait;
use App\Models\Petspace;
use App\Repositories\Admin\PetspaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetspaceRepositoryTest extends TestCase
{
    use MakePetspaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PetspaceRepository
     */
    protected $petspaceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->petspaceRepo = App::make(PetspaceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePetspace()
    {
        $petspace = $this->fakePetspaceData();
        $createdPetspace = $this->petspaceRepo->create($petspace);
        $createdPetspace = $createdPetspace->toArray();
        $this->assertArrayHasKey('id', $createdPetspace);
        $this->assertNotNull($createdPetspace['id'], 'Created Petspace must have id specified');
        $this->assertNotNull(Petspace::find($createdPetspace['id']), 'Petspace with given id must be in DB');
        $this->assertModelData($petspace, $createdPetspace);
    }

    /**
     * @test read
     */
    public function testReadPetspace()
    {
        $petspace = $this->makePetspace();
        $dbPetspace = $this->petspaceRepo->find($petspace->id);
        $dbPetspace = $dbPetspace->toArray();
        $this->assertModelData($petspace->toArray(), $dbPetspace);
    }

    /**
     * @test update
     */
    public function testUpdatePetspace()
    {
        $petspace = $this->makePetspace();
        $fakePetspace = $this->fakePetspaceData();
        $updatedPetspace = $this->petspaceRepo->update($fakePetspace, $petspace->id);
        $this->assertModelData($fakePetspace, $updatedPetspace->toArray());
        $dbPetspace = $this->petspaceRepo->find($petspace->id);
        $this->assertModelData($fakePetspace, $dbPetspace->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePetspace()
    {
        $petspace = $this->makePetspace();
        $resp = $this->petspaceRepo->delete($petspace->id);
        $this->assertTrue($resp);
        $this->assertNull(Petspace::find($petspace->id), 'Petspace should not exist in DB');
    }
}
