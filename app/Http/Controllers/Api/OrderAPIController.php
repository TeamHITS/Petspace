<?php

namespace App\Http\Controllers\Api;

use App\Criteria\OrderCriteria;
use App\Criteria\PetspaceCriteria;
use App\Http\Requests\Api\CreateOrderAPIRequest;
use App\Http\Requests\Api\UpdateOrderAPIRequest;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderServiceAddon;
use App\Models\UserPet;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\OrderServiceAddonRepository;
use App\Repositories\Admin\OrderServicePetRepository;
use App\Repositories\Admin\OrderServiceRepository;
use App\Repositories\Admin\PetspaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;
use App\Models\OrderHistory;
use App\Models\OrderReference;
use App\Models\Petspace;
use App\Models\PetspaceTechnician;
use App\Services\FirebaseService;

/**
 * Class OrderController
 * @package App\Http\Controllers\Api
 */
class OrderAPIController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $orderServiceRepository;
    private $orderServiceAddonRepository;
    private $petspaceRepository;
    private $orderServicePetRepository;

    public function __construct(OrderRepository $orderRepo,
                                OrderServiceRepository $orderServiceRepo,
                                OrderServiceAddonRepository $orderServiceAddonRepo,
                                PetspaceRepository $petspaceRepo,
                                OrderServicePetRepository $orderServicePetRepo
    )
    {
        $this->orderRepository             = $orderRepo;
        $this->orderServiceRepository      = $orderServiceRepo;
        $this->orderServiceAddonRepository = $orderServiceAddonRepo;
        $this->petspaceRepository          = $petspaceRepo;
        $this->orderServicePetRepository   = $orderServicePetRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/orders",
     *      summary="Get a listing of the Orders.",
     *      tags={"Order"},
     *      description="Get all Orders",
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
     *                  @SWG\Items(ref="#/definitions/Order")
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
        $orders = $this->orderRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new OrderCriteria([
                'user_id' => \Auth::id()
            ]))
            ->all();

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * @param CreateOrderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orders",
     *      summary="Store a newly created Order in storage",
     *      tags={"Order"},
     *      description="Store Order",
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
     *          description="Order that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
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
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderAPIRequest $request)
    {
        $input = $request->toArray();
        $order = array(
            "user_id"         => \Auth::id(),
            "cart_id"         => $input['cart_id'],
            "petspace_id"     => $input['petspace_id'],
            "user_address_id" => $input['user_address_id'],
            "slot_id"         => $input['slot_id'],
            "status"          => Order::SCHEDULE,
            "date_time"       => $input['date_time'],
            "sub_total"       => $input['sub_total'],
            "delivery_fee"    => $input['delivery_fee'],
            "tax"             => $input['tax'],
            "total"           => $input['total'],
            "note"            => $input['note']
        );

        if (isset($input['promo_code'])) {
            $order['promo_code'] = $input['promo_code'];
            DB::table('used_promo_codes')->insert([
                'user_id'       => \Auth::id(),
                'promo_code_id' => $input['promo_code'],
            ]);
        }

        if (isset($input['min_order'])) {
            $order['min_order'] = $input['min_order'];
        }

        $orders = $this->orderRepository->saveRecord($order);

        $petspace = Petspace::where('id', $input['petspace_id'])->first();
        $user_id  = $petspace->user_id;
        $title    = __('notifications.order.order_created.title');
        $message  = __('notifications.order.order_created.message');

        Notification::create_notification($user_id, $title, $message);
        FirebaseService::sendBellNotification($user_id, $title, $message);

        $OrderHistory = new OrderHistory;

        $OrderHistory->order_id = $orders->id;

        $OrderHistory->total = $orders->total;

        $OrderHistory->save();
        if (isset($input['services'])) {
            foreach ($input['services'] as $service) {

                $userPet = UserPet::where('id', $service['pet_id'])->first();

                $servicePet      = array(
                    "user_id"     => $userPet['user_id'],
                    "name"        => $userPet['name'],
                    "type"        => $userPet['type'],
                    "gender"      => $userPet['gender'],
                    "breed"       => $userPet['breed'],
                    "weight"      => $userPet['weight'],
                    "color"       => $userPet['color'],
                    "chip_id_num" => $userPet['chip_id_num'],
                    "image"       => $userPet['image'],
                    "birthdate"   => $userPet['birthdate'],
                    "neutered"    => $userPet['neutered'],
                    "instruction" => $userPet['instruction'],
                );
                $orderServicePet = $this->orderServicePetRepository->saveRecord($servicePet);

                $service_data = array(
                    "order_id"   => $orders->id,
                    "pet_id"     => $orderServicePet->id,
                    "service_id" => $service['service_id'],
                    "name"       => $service['name'],
                    "duration"   => $service['service_duration'],
                    "price"      => $service['price'],
                    "discount"   => $service['discount']

                );

                $orderService = $this->orderServiceRepository->saveRecord($service_data);
                if (isset($service['addons'])) {
                    foreach ($service['addons'] as $addon) {
                        $addon_data         = array(
                            "order_service_id"   => $orderService->id,
                            "submenu_service_id" => $addon['submenu_service_id'],
                            "name"               => $addon['name'],
                            "duration"           => $addon['service_duration'],
                            "price"              => $addon['price'],
                            "discount"           => $addon['discount']
                        );
                        $orderServiceAddons = $this->orderServiceAddonRepository->saveRecord($addon_data);
                    }
                }
            }
        }
        $orders = $this->orderRepository->findWithoutFail($orders->id);
        return $this->sendResponse($orders->toArray(), 'Order saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orders/{id}",
     *      summary="Display the specified Order",
     *      tags={"Order"},
     *      description="Get Order",
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
     *          description="id of Order",
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
     *                  ref="#/definitions/Order"
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
        /** @var Order $order */
        $order = $this->orderRepository
            ->pushCriteria(new OrderCriteria(
                ['with_service' => true]
            ))
            ->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }

        return $this->sendResponse($order->toArray(), 'Order retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orders/{id}",
     *      summary="Update the specified Order in storage",
     *      tags={"Order"},
     *      description="Update Order",
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
     *          description="id of Order",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
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
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }

        $order = $this->orderRepository->updateRecord($request, $order);

        $petspace = Petspace::where('id', $order->petspace_id)->first();
        $user_id  = $petspace->user_id;
        $title    = __('notifications.order.order_updated.title');
        $message  = __('notifications.order.order_updated.message');

        Notification::create_notification($user_id, $title, $message);
        FirebaseService::sendBellNotification($user_id, $title, $message);

        if ($order->technician_id) {

            $technicians   = PetspaceTechnician::where('id', $order->technician_id)->first();
            $technician_id = $technicians->user_id;
            $title         = __('notifications.order.order_updated.title');
            $message       = __('notifications.order.order_updated.message');

            Notification::create_notification($technician_id, $title, $message);
            FirebaseService::sendBellNotification($technician_id, $title, $message);
        }

        return $this->sendResponse($order->toArray(), 'Order updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orders/{id}",
     *      summary="Remove the specified Order from storage",
     *      tags={"Order"},
     *      description="Delete Order",
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
     *          description="id of Order",
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
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }

        $this->orderRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Order deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cancel-order",
     *      summary="cancel a newly created Order in storage",
     *      tags={"Order"},
     *      description="Store Order",
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
     *          description="Order that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
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
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function cancel(Request $request)
    {
        /** @var Order $order */
        $input = $request->toArray();


        $order = $this->orderRepository->findWithoutFail($input['order_id']);

        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }
        $request = array(
            "status" => Order::CANCEL
        );
        $order   = $this->orderRepository->updateRecord($request, $order);

        return $this->sendResponse($order->toArray(), 'Order cancel successfully');
    }


    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orders/rating",
     *      summary="Store a newly created Order in storage",
     *      tags={"Order"},
     *      description="Store Order",
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
     *          description="Order that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order")
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
     *                  ref="#/definitions/Order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function addRating(Request $request)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($request->id);
        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }

        $order = $this->orderRepository->updateRecord($request, $order);

        $petspace_id = $order->petspace_id;
        $rating      = DB::select(DB::raw("SELECT COUNT(id) as count, SUM(rating) as total FROM orders WHERE petspace_id = '$petspace_id' AND (rating > 0 OR rating_comment) IS NOT NULL group by petspace_id"));

        $petspaceRating = $rating[0]->total / $rating[0]->count;

        $petspace        = $this->petspaceRepository->findWithoutFail($petspace_id);
        $petspaceUpdated = $this->petspaceRepository->updateRecord(array("rating" => $petspaceRating), $petspace);
//        dd($petspaceUpdated);
        return $this->sendResponse($order->toArray(), 'Order rating added successfully');
    }

    public function orderReference(Request $request)
    {
        $orderid = $request->order_id;
        $ref     = $request->reference;
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($orderid);

        if (empty($order)) {
            return $this->sendErrorWithData(['Order not found']);
        }

        $orderRef = OrderReference::updateOrCreate(
            ['order_id' => $orderid],
            ['reference' => $ref]
        );

        return $this->sendResponse($orderRef->toArray(), 'Order reference added successfully');
    }
}
