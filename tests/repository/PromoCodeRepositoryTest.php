<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use \Tests\Traits\MakePromoCodeTrait;
use App\Models\PromoCode;
use App\Repositories\Admin\PromoCodeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PromoCodeRepositoryTest extends TestCase
{
    use MakePromoCodeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PromoCodeRepository
     */
    protected $promoCodeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->promoCodeRepo = App::make(PromoCodeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePromoCode()
    {
        $promoCode = $this->fakePromoCodeData();
        $createdPromoCode = $this->promoCodeRepo->create($promoCode);
        $createdPromoCode = $createdPromoCode->toArray();
        $this->assertArrayHasKey('id', $createdPromoCode);
        $this->assertNotNull($createdPromoCode['id'], 'Created PromoCode must have id specified');
        $this->assertNotNull(PromoCode::find($createdPromoCode['id']), 'PromoCode with given id must be in DB');
        $this->assertModelData($promoCode, $createdPromoCode);
    }

    /**
     * @test read
     */
    public function testReadPromoCode()
    {
        $promoCode = $this->makePromoCode();
        $dbPromoCode = $this->promoCodeRepo->find($promoCode->id);
        $dbPromoCode = $dbPromoCode->toArray();
        $this->assertModelData($promoCode->toArray(), $dbPromoCode);
    }

    /**
     * @test update
     */
    public function testUpdatePromoCode()
    {
        $promoCode = $this->makePromoCode();
        $fakePromoCode = $this->fakePromoCodeData();
        $updatedPromoCode = $this->promoCodeRepo->update($fakePromoCode, $promoCode->id);
        $this->assertModelData($fakePromoCode, $updatedPromoCode->toArray());
        $dbPromoCode = $this->promoCodeRepo->find($promoCode->id);
        $this->assertModelData($fakePromoCode, $dbPromoCode->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePromoCode()
    {
        $promoCode = $this->makePromoCode();
        $resp = $this->promoCodeRepo->delete($promoCode->id);
        $this->assertTrue($resp);
        $this->assertNull(PromoCode::find($promoCode->id), 'PromoCode should not exist in DB');
    }
}
