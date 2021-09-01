<?php

namespace App\Http\Controllers\Api;

use App\Criteria\PromoCodeCriteria;
use App\Http\Requests\Api\CreatePromoCodeAPIRequest;
use App\Http\Requests\Api\UpdatePromoCodeAPIRequest;
use App\Models\PromoCode;
use App\Repositories\Admin\PromoCodeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PromoCodeController
 * @package App\Http\Controllers\Api
 */
class PromoCodeAPIController extends AppBaseController
{
    /** @var  PromoCodeRepository */
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepo)
    {
        $this->promoCodeRepository = $promoCodeRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/promo-codes",
     *      summary="Get a listing of the PromoCodes.",
     *      tags={"PromoCode"},
     *      description="Get all PromoCodes",
     *      produces={"application/json"},
     *      //@SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      //@SWG\Parameter(
     *          name="code",
     *          description="Pass the property code you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *     //@SWG\Parameter(
     *          name="orderBy",
     *          description="Pass the property name you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      //@SWG\Parameter(
     *          name="sortedBy",
     *          description="Pass 'asc' or 'desc' to define the sorting method. If not found, 'asc' will be used by default",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      //@SWG\Parameter(
     *          name="limit",
     *          description="Change the Default Record Count. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *     //@SWG\Parameter(
     *          name="offset",
     *          description="Change the Default Offset of the Query. If not found, 0 will be used.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              //@SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  //@SWG\Items(ref="#/definitions/PromoCode")
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $promoCodes = $this->promoCodeRepository->resetCriteria()
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new PromoCodeCriteria([
                'code' => $request->get('code', null)]))
            ->all();

        return $this->sendResponse($promoCodes->toArray(), 'Promo Codes retrieved successfully');
    }

    /**
     * @param CreatePromoCodeAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/promo-codes",
     *      summary="Store a newly created PromoCode in storage",
     *      tags={"PromoCode"},
     *      description="Store PromoCode",
     *      produces={"application/json"},
     *      //@SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PromoCode that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PromoCode")
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              //@SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PromoCode"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePromoCodeAPIRequest $request)
    {
        $promoCodes = $this->promoCodeRepository->saveRecord($request);

        return $this->sendResponse($promoCodes->toArray(), 'Promo Code saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/promo-codes/{code}",
     *      summary="Display the specified PromoCode",
     *      tags={"PromoCode"},
     *      description="Get PromoCode",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="code",
     *          description="id of PromoCode",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PromoCode"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($code)
    {
        /** @var PromoCode $promoCode */

        $promoCode = $this->promoCodeRepository->findWhere(array("code" => $code));
        if (empty($promoCode[0])) {
            return $this->sendErrorWithData(['Promo Code not found']);
        }

        $promoCodeValidity = DB::table('promo_codes')
            ->where('code', '=', $code)
            ->where('valid_to', '>=', Carbon::now())
            ->where('valid_from', '<=', Carbon::now())
            ->first();

        if (empty($promoCodeValidity)) {
            return $this->sendErrorWithData(['Promo Code expired']);
        }

        $checkUsed = DB::table('used_promo_codes')
            ->where('user_id', '=', \Auth::id())
            ->where('promo_code_id', '=', $promoCode[0]['id'])
            ->first();

        if (!empty($checkUsed)) {
            return $this->sendErrorWithData(['Promo Code already used']);
        }
        
        return $this->sendResponse($promoCode->toArray(), 'Promo Code retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePromoCodeAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/promo-codes/{id}",
     *      summary="Update the specified PromoCode in storage",
     *      tags={"PromoCode"},
     *      description="Update PromoCode",
     *      produces={"application/json"},
     *      //@SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      //@SWG\Parameter(
     *          name="id",
     *          description="id of PromoCode",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PromoCode that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PromoCode")
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              //@SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PromoCode"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePromoCodeAPIRequest $request)
    {
        /** @var PromoCode $promoCode */
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            return $this->sendErrorWithData(['Promo Code not found']);
        }

        $promoCode = $this->promoCodeRepository->updateRecord($request, $promoCode);

        return $this->sendResponse($promoCode->toArray(), 'PromoCode updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/promo-codes/{id}",
     *      summary="Remove the specified PromoCode from storage",
     *      tags={"PromoCode"},
     *      description="Delete PromoCode",
     *      produces={"application/json"},
     *      //@SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      //@SWG\Parameter(
     *          name="id",
     *          description="id of PromoCode",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              //@SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var PromoCode $promoCode */
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            return $this->sendErrorWithData(['Promo Code not found']);
        }

        $this->promoCodeRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Promo Code deleted successfully');
    }
}
