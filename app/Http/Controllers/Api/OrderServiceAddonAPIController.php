<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrderServiceAddonAPIRequest;
use App\Http\Requests\Api\UpdateOrderServiceAddonAPIRequest;
use App\Models\OrderServiceAddon;
use App\Repositories\Admin\OrderServiceAddonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class OrderServiceAddonController
 * @package App\Http\Controllers\Api
 */

class OrderServiceAddonAPIController extends AppBaseController
{
    /** @var  OrderServiceAddonRepository */
    private $orderServiceAddonRepository;

    public function __construct(OrderServiceAddonRepository $orderServiceAddonRepo)
    {
        $this->orderServiceAddonRepository = $orderServiceAddonRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-service-addons",
     *      summary="Get a listing of the OrderServiceAddons.",
     *      tags={"OrderServiceAddon"},
     *      description="Get all OrderServiceAddons",
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
     *                  @SWG\Items(ref="#/definitions/OrderServiceAddon")
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
        $orderServiceAddons = $this->orderServiceAddonRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new orderServiceAddonCriteria($request))
            ->all();

        return $this->sendResponse($orderServiceAddons->toArray(), 'Order Service Addons retrieved successfully');
    }

    /**
     * @param CreateOrderServiceAddonAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/order-service-addons",
     *      summary="Store a newly created OrderServiceAddon in storage",
     *      tags={"OrderServiceAddon"},
     *      description="Store OrderServiceAddon",
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
     *          description="OrderServiceAddon that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderServiceAddon")
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
     *                  ref="#/definitions/OrderServiceAddon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderServiceAddonAPIRequest $request)
    {
        $orderServiceAddons = $this->orderServiceAddonRepository->saveRecord($request);

        return $this->sendResponse($orderServiceAddons->toArray(), 'Order Service Addon saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/order-service-addons/{id}",
     *      summary="Display the specified OrderServiceAddon",
     *      tags={"OrderServiceAddon"},
     *      description="Get OrderServiceAddon",
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
     *          description="id of OrderServiceAddon",
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
     *                  ref="#/definitions/OrderServiceAddon"
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
        /** @var OrderServiceAddon $orderServiceAddon */
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            return $this->sendErrorWithData(['Order Service Addon not found']);
        }

        return $this->sendResponse($orderServiceAddon->toArray(), 'Order Service Addon retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderServiceAddonAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/order-service-addons/{id}",
     *      summary="Update the specified OrderServiceAddon in storage",
     *      tags={"OrderServiceAddon"},
     *      description="Update OrderServiceAddon",
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
     *          description="id of OrderServiceAddon",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderServiceAddon that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderServiceAddon")
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
     *                  ref="#/definitions/OrderServiceAddon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderServiceAddonAPIRequest $request)
    {
        /** @var OrderServiceAddon $orderServiceAddon */
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            return $this->sendErrorWithData(['Order Service Addon not found']);
        }

        $orderServiceAddon = $this->orderServiceAddonRepository->updateRecord($request, $orderServiceAddon);

        return $this->sendResponse($orderServiceAddon->toArray(), 'OrderServiceAddon updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/order-service-addons/{id}",
     *      summary="Remove the specified OrderServiceAddon from storage",
     *      tags={"OrderServiceAddon"},
     *      description="Delete OrderServiceAddon",
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
     *          description="id of OrderServiceAddon",
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
        /** @var OrderServiceAddon $orderServiceAddon */
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            return $this->sendErrorWithData(['Order Service Addon not found']);
        }

        $this->orderServiceAddonRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Order Service Addon deleted successfully');
    }
}
