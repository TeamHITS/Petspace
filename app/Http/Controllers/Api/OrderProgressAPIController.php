<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderProgressAPIRequest;
use App\Http\Requests\Api\UpdateOrderProgressAPIRequest;
use App\Models\OrderProgress;
use App\Repositories\Admin\OrderProgressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class OrderProgressController
 * @package App\Http\Controllers\Api
 */

class OrderProgressAPIController extends AppBaseController
{
    /** @var  OrderProgressRepository */
    private $orderProgressRepository;

    public function __construct(OrderProgressRepository $orderProgressRepo)
    {
        $this->orderProgressRepository = $orderProgressRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-progresses",
     *      summary="Get a listing of the OrderProgresses.",
     *      tags={"OrderProgress"},
     *      description="Get all OrderProgresses",
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
     *                  @SWG\Items(ref="#/definitions/OrderProgress")
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
        $orderProgresses = $this->orderProgressRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new orderProgressCriteria($request))
            ->all();

        return $this->sendResponse($orderProgresses->toArray(), 'Order Progresses retrieved successfully');
    }

    /**
     * @param CreateOrderProgressAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/order-progresses",
     *      summary="Store a newly created OrderProgress in storage",
     *      tags={"OrderProgress"},
     *      description="Store OrderProgress",
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
     *          description="OrderProgress that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProgress")
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
     *                  ref="#/definitions/OrderProgress"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderProgressAPIRequest $request)
    {
        $orderProgresses = $this->orderProgressRepository->saveRecord($request);

        return $this->sendResponse($orderProgresses->toArray(), 'Order Progress saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-progresses/{id}",
     *      summary="Display the specified OrderProgress",
     *      tags={"OrderProgress"},
     *      description="Get OrderProgress",
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
     *          description="id of OrderProgress",
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
     *                  ref="#/definitions/OrderProgress"
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
        /** @var OrderProgress $orderProgress */
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            return $this->sendErrorWithData(['Order Progress not found']);
        }

        return $this->sendResponse($orderProgress->toArray(), 'Order Progress retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderProgressAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/order-progresses/{id}",
     *      summary="Update the specified OrderProgress in storage",
     *      tags={"OrderProgress"},
     *      description="Update OrderProgress",
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
     *          description="id of OrderProgress",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderProgress that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderProgress")
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
     *                  ref="#/definitions/OrderProgress"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderProgressAPIRequest $request)
    {
        /** @var OrderProgress $orderProgress */
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            return $this->sendErrorWithData(['Order Progress not found']);
        }

        $orderProgress = $this->orderProgressRepository->updateRecord($request, $orderProgress);

        return $this->sendResponse($orderProgress->toArray(), 'OrderProgress updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/order-progresses/{id}",
     *      summary="Remove the specified OrderProgress from storage",
     *      tags={"OrderProgress"},
     *      description="Delete OrderProgress",
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
     *          description="id of OrderProgress",
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
        /** @var OrderProgress $orderProgress */
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            return $this->sendErrorWithData(['Order Progress not found']);
        }

        $this->orderProgressRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Order Progress deleted successfully');
    }
}
