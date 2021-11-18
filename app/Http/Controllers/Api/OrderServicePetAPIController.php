<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderServicePetAPIRequest;
use App\Http\Requests\Api\UpdateOrderServicePetAPIRequest;
use App\Models\OrderServicePet;
use App\Repositories\Admin\OrderServicePetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class OrderServicePetController
 * @package App\Http\Controllers\Api
 */

class OrderServicePetAPIController extends AppBaseController
{
    /** @var  OrderServicePetRepository */
    private $orderServicePetRepository;

    public function __construct(OrderServicePetRepository $orderServicePetRepo)
    {
        $this->orderServicePetRepository = $orderServicePetRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-service-pets",
     *      summary="Get a listing of the OrderServicePets.",
     *      tags={"OrderServicePet"},
     *      description="Get all OrderServicePets",
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
     *          name="orderBy",
     *          description="Pass the property name you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="sortedBy",
     *          description="Pass 'asc' or 'desc' to define the sorting method. If not found, 'asc' will be used by default",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="limit",
     *          description="Change the Default Record Count. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="offset",
     *          description="Change the Default Offset of the Query. If not found, 0 will be used.",
     *          type="integer",
     *          required=false,
     *          in="query"
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/OrderServicePet")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $orderServicePets = $this->orderServicePetRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new orderServicePetCriteria($request))
            ->all();

        return $this->sendResponse($orderServicePets->toArray(), 'Order Service Pets retrieved successfully');
    }

    /**
     * @param CreateOrderServicePetAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/order-service-pets",
     *      summary="Store a newly created OrderServicePet in storage",
     *      tags={"OrderServicePet"},
     *      description="Store OrderServicePet",
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
     *          name="body",
     *          in="body",
     *          description="OrderServicePet that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderServicePet")
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
     *                  ref="#/definitions/OrderServicePet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderServicePetAPIRequest $request)
    {
        $orderServicePets = $this->orderServicePetRepository->saveRecord($request);

        return $this->sendResponse($orderServicePets->toArray(), 'Order Service Pet saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-service-pets/{id}",
     *      summary="Display the specified OrderServicePet",
     *      tags={"OrderServicePet"},
     *      description="Get OrderServicePet",
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
     *          name="id",
     *          description="id of OrderServicePet",
     *          type="integer",
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
     *                  ref="#/definitions/OrderServicePet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var OrderServicePet $orderServicePet */
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            return $this->sendErrorWithData(['Order Service Pet not found']);
        }

        return $this->sendResponse($orderServicePet->toArray(), 'Order Service Pet retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderServicePetAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/order-service-pets/{id}",
     *      summary="Update the specified OrderServicePet in storage",
     *      tags={"OrderServicePet"},
     *      description="Update OrderServicePet",
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
     *          name="id",
     *          description="id of OrderServicePet",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderServicePet that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderServicePet")
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
     *                  ref="#/definitions/OrderServicePet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderServicePetAPIRequest $request)
    {
        /** @var OrderServicePet $orderServicePet */
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            return $this->sendErrorWithData(['Order Service Pet not found']);
        }

        $orderServicePet = $this->orderServicePetRepository->updateRecord($request, $orderServicePet);

        return $this->sendResponse($orderServicePet->toArray(), 'OrderServicePet updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/order-service-pets/{id}",
     *      summary="Remove the specified OrderServicePet from storage",
     *      tags={"OrderServicePet"},
     *      description="Delete OrderServicePet",
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
     *          name="id",
     *          description="id of OrderServicePet",
     *          type="integer",
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var OrderServicePet $orderServicePet */
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            return $this->sendErrorWithData(['Order Service Pet not found']);
        }

        $this->orderServicePetRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Order Service Pet deleted successfully');
    }
}
