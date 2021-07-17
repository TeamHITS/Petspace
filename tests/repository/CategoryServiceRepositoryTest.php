<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakeCategoryServiceTrait;
use App\Models\CategoryService;
use App\Repositories\Admin\CategoryServiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryServiceRepositoryTest extends TestCase
{
    use MakeCategoryServiceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryServiceRepository
     */
    protected $categoryServiceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoryServiceRepo = App::make(CategoryServiceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategoryService()
    {
        $categoryService = $this->fakeCategoryServiceData();
        $createdCategoryService = $this->categoryServiceRepo->create($categoryService);
        $createdCategoryService = $createdCategoryService->toArray();
        $this->assertArrayHasKey('id', $createdCategoryService);
        $this->assertNotNull($createdCategoryService['id'], 'Created CategoryService must have id specified');
        $this->assertNotNull(CategoryService::find($createdCategoryService['id']), 'CategoryService with given id must be in DB');
        $this->assertModelData($categoryService, $createdCategoryService);
    }

    /**
     * @test read
     */
    public function testReadCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $dbCategoryService = $this->categoryServiceRepo->find($categoryService->id);
        $dbCategoryService = $dbCategoryService->toArray();
        $this->assertModelData($categoryService->toArray(), $dbCategoryService);
    }

    /**
     * @test update
     */
    public function testUpdateCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $fakeCategoryService = $this->fakeCategoryServiceData();
        $updatedCategoryService = $this->categoryServiceRepo->update($fakeCategoryService, $categoryService->id);
        $this->assertModelData($fakeCategoryService, $updatedCategoryService->toArray());
        $dbCategoryService = $this->categoryServiceRepo->find($categoryService->id);
        $this->assertModelData($fakeCategoryService, $dbCategoryService->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategoryService()
    {
        $categoryService = $this->makeCategoryService();
        $resp = $this->categoryServiceRepo->delete($categoryService->id);
        $this->assertTrue($resp);
        $this->assertNull(CategoryService::find($categoryService->id), 'CategoryService should not exist in DB');
    }
}
