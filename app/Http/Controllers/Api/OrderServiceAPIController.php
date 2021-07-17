<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderServiceAPIRequest;
use App\Http\Requests\Api\UpdateOrderServiceAPIRequest;
use App\Models\OrderService;
use App\Repositories\Admin\OrderServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class OrderServiceController
 * @package App\Http\Controllers\Api
 */

class OrderServiceAPIController extends AppBaseController
{
    /** @var  OrderServiceRepository */
    private $orderServiceRepository;

    public function __construct(OrderServiceRepository $orderServiceRepo)
    {
        $this->orderServiceRepository = $orderServiceRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-services",
     *      summary="Get a listing of the OrderServices.",
     *      tags={"OrderService"},
     *      description="Get all OrderServices",
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
     *                  @SWG\Items(ref="#/definitions/OrderService")
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
        $orderServices = $this->orderServiceRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new orderServiceCriteria($request))
            ->all();

        return $this->sendResponse($orderServices->toArray(), 'Order Services retrieved successfully');
    }

    /**
     * @param CreateOrderServiceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/order-services",
     *      summary="Store a newly created OrderService in storage",
     *      tags={"OrderService"},
     *      description="Store OrderService",
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
     *          description="OrderService that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderService")
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
     *                  ref="#/definitions/OrderService"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderServiceAPIRequest $request)
    {
        $orderServices = $this->orderServiceRepository->saveRecord($request);

        return $this->sendResponse($orderServices->toArray(), 'Order Service saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-services/{id}",
     *      summary="Display the specified OrderService",
     *      tags={"OrderService"},
     *      description="Get OrderService",
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
     *          description="id of OrderService",
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
     *                  ref="#/definitions/OrderService"
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
        /** @var OrderService $orderService */
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            return $this->sendErrorWithData(['Order Service not found']);
        }

        return $this->sendResponse($orderService->toArray(), 'Order Service retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderServiceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/order-services/{id}",
     *      summary="Update the specified OrderService in storage",
     *      tags={"OrderService"},
     *      description="Update OrderService",
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
     *          description="id of OrderService",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderService that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderService")
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
     *                  ref="#/definitions/OrderService"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderServiceAPIRequest $request)
    {
        /** @var OrderService $orderService */
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            return $this->sendErrorWithData(['Order Service not found']);
        }

        $orderService = $this->orderServiceRepository->updateRecord($request, $orderService);

        return $this->sendResponse($orderService->toArray(), 'OrderService updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/order-services/{id}",
     *      summary="Remove the specified OrderService from storage",
     *      tags={"OrderService"},
     *      description="Delete OrderService",
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
     *          description="id of OrderService",
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
        /** @var OrderService $orderService */
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            return $this->sendErrorWithData(['Order Service not found']);
        }

        $this->orderServiceRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Order Service deleted successfully');
    }
}
