<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePetspaceTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetspaceApiTest extends TestCase
{
    use MakePetspaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePetspace()
    {
        $petspace = $this->fakePetspaceData();
        $this->json('POST', '/api/v1/petspaces', $petspace);

        $this->assertApiResponse($petspace);
    }

    /**
     * @test
     */
    public function testReadPetspace()
    {
        $petspace = $this->makePetspace();
        $this->json('GET', '/api/v1/petspaces/'.$petspace->id);

        $this->assertApiResponse($petspace->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePetspace()
    {
        $petspace = $this->makePetspace();
        $editedPetspace = $this->fakePetspaceData();

        $this->json('PUT', '/api/v1/petspaces/'.$petspace->id, $editedPetspace);

        $this->assertApiResponse($editedPetspace);
    }

    /**
     * @test
     */
    public function testDeletePetspace()
    {
        $petspace = $this->makePetspace();
        $this->json('DELETE', '/api/v1/petspaces/'.$petspace->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/petspaces/'.$petspace->id);

        $this->assertResponseStatus(404);
    }
}
