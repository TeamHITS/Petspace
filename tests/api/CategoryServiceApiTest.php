<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakeCategoryServiceTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryServiceApiTest extends TestCase
{
    use MakeCategoryServiceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategoryService()
    {
        $categoryService = $this->fakeCategoryServiceData();
        $this->json('POST', '/api/v1/category-services', $categoryService);

        $this->assertApiResponse($categoryService);
    }

    /**
     * @test
     */
    public function testReadCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $this->json('GET', '/api/v1/category-services/'.$categoryService->id);

        $this->assertApiResponse($categoryService->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $editedCategoryService = $this->fakeCategoryServiceData();

        $this->json('PUT', '/api/v1/category-services/'.$categoryService->id, $editedCategoryService);

        $this->assertApiResponse($editedCategoryService);
    }

    /**
     * @test
     */
    public function testDeleteCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $this->json('DELETE', '/api/v1/category-services/'.$categoryService->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/category-services/'.$categoryService->id);

        $this->assertResponseStatus(404);
    }
}
