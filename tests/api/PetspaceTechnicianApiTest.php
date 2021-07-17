<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePetspaceTechnicianTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetspaceTechnicianApiTest extends TestCase
{
    use MakePetspaceTechnicianTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePetspaceTechnician()
    {
        $petspaceTechnician = $this->fakePetspaceTechnicianData();
        $this->json('POST', '/api/v1/petspace-technicians', $petspaceTechnician);

        $this->assertApiResponse($petspaceTechnician);
    }

    /**
     * @test
     */
    public function testReadPetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $this->json('GET', '/api/v1/petspace-technicians/'.$petspaceTechnician->id);

        $this->assertApiResponse($petspaceTechnician->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $editedPetspaceTechnician = $this->fakePetspaceTechnicianData();

        $this->json('PUT', '/api/v1/petspace-technicians/'.$petspaceTechnician->id, $editedPetspaceTechnician);

        $this->assertApiResponse($editedPetspaceTechnician);
    }

    /**
     * @test
     */
    public function testDeletePetspaceTechnician()
    {
        $petspaceTechnician = $this->makePetspaceTechnician();
        $this->json('DELETE', '/api/v1/petspace-technicians/'.$petspaceTechnician->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/petspace-technicians/'.$petspaceTechnician->id);

        $this->assertResponseStatus(404);
    }
}
