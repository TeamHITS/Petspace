<?php

namespace Tests\Api;

use Tests\ApiTestTrait;
use Tests\TestCase;
use Tests\Traits\MakePromoCodeTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PromoCodeApiTest extends TestCase
{
    use MakePromoCodeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePromoCode()
    {
        $promoCode = $this->fakePromoCodeData();
        $this->json('POST', '/api/v1/promo-codes', $promoCode);

        $this->assertApiResponse($promoCode);
    }

    /**
     * @test
     */
    public function testReadPromoCode()
    {
        $promoCode = $this->makePromoCode();
        $this->json('GET', '/api/v1/promo-codes/'.$promoCode->id);

        $this->assertApiResponse($promoCode->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePromoCode()
    {
        $promoCode = $this->makePromoCode();
        $editedPromoCode = $this->fakePromoCodeData();

        $this->json('PUT', '/api/v1/promo-codes/'.$promoCode->id, $editedPromoCode);

        $this->assertApiResponse($editedPromoCode);
    }

    /**
     * @test
     */
    public function testDeletePromoCode()
    {
        $promoCode = $this->makePromoCode();
        $this->json('DELETE', '/api/v1/promo-codes/'.$promoCode->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/promo-codes/'.$promoCode->id);

        $this->assertResponseStatus(404);
    }
}
