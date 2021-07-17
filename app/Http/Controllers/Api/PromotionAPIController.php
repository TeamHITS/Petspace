<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePromotionAPIRequest;
use App\Http\Requests\Api\UpdatePromotionAPIRequest;
use App\Models\Promotion;
use App\Repositories\Admin\PromotionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PromotionController
 * @package App\Http\Controllers\Api
 */

class PromotionAPIController extends AppBaseController
{
    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(PromotionRepository $promotionRepo)
    {
        $this->promotionRepository = $promotionRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/promotions",
     *      summary="Get a listing of the Promotions.",
     *      tags={"Promotion"},
     *      description="Get all Promotions",
     *      produces={"application/json"},
     *      //@SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      //@SWG\Parameter(//
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
     *                  //@SWG\Items(ref="#/definitions/Promotion")
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
        $promotions = $this->promotionRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new promotionCriteria($request))
            ->all();

        return $this->sendResponse($promotions->toArray(), 'Promotions retrieved successfully');
    }

    /**
     * @param CreatePromotionAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/promotions",
     *      summary="Store a newly created Promotion in storage",
     *      tags={"Promotion"},
     *      description="Store Promotion",
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
     *          description="Promotion that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/Promotion")
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
     *                  ref="#/definitions/Promotion"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePromotionAPIRequest $request)
    {
        $promotions = $this->promotionRepository->saveRecord($request);

        return $this->sendResponse($promotions->toArray(), 'Promotion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/promotions/{id}",
     *      summary="Display the specified Promotion",
     *      tags={"Promotion"},
     *      description="Get Promotion",
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
     *          description="id of Promotion",
     *          type="integer",
     *          required=true,//
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
     *                  ref="#/definitions/Promotion"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            return $this->sendErrorWithData(['Promotion not found']);
        }

        return $this->sendResponse($promotion->toArray(), 'Promotion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePromotionAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/promotions/{id}",
     *      summary="Update the specified Promotion in storage",
     *      tags={"Promotion"},
     *      description="Update Promotion",
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
     *          description="id of Promotion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Promotion that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/Promotion")
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
     *                  ref="#/definitions/Promotion"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePromotionAPIRequest $request)
    {
        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            return $this->sendErrorWithData(['Promotion not found']);
        }

        $promotion = $this->promotionRepository->updateRecord($request, $promotion);

        return $this->sendResponse($promotion->toArray(), 'Promotion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/promotions/{id}",
     *      summary="Remove the specified Promotion from storage",
     *      tags={"Promotion"},
     *      description="Delete Promotion",
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
     *          description="id of Promotion",
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
        /** @var Promotion $promotion */
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            return $this->sendErrorWithData(['Promotion not found']);
        }

        $this->promotionRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Promotion deleted successfully');
    }
}
