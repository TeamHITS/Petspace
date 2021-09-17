<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\OrderDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOrderRequest;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Repositories\Admin\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use App\Repositories\Admin\PetspaceRepository;
use App\Repositories\Admin\OrderServiceAddonRepository;
use App\Repositories\Admin\OrderServiceRepository;
use App\Repositories\Admin\TransactionRepository;
use App\Criteria\PetspaceCriteria;
use Illuminate\Http\Request;
use App\Models\SubmenuService;
use App\Models\UserCard;
use App\Models\UserDetail;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\OrderReference;
use App\Models\Transaction;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\DB;
use Session;
class OrderController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderServiceAddonRepository */
    private $orderServiceAddonRepository;

    /** @var  OrderServiceRepository */
    private $orderServiceRepository;

    /** @var  PetspaceRepository */
    private $petspaceRepository;

    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(OrderRepository $orderRepo, 
        PetspaceRepository $petspaceRepo,
        OrderServiceAddonRepository $orderServiceAddonRepository,
        OrderServiceRepository $orderServiceRepository,
        TransactionRepository $transactionRepo
    )
    {
        $this->orderRepository = $orderRepo;
        $this->ModelName = 'orders';
        $this->BreadCrumbName = 'Orders';
        $this->petspaceRepository = $petspaceRepo;
        $this->orderServiceAddonRepository = $orderServiceAddonRepository;
        $this->orderServiceRepository = $orderServiceRepository;
        $this->transactionRepository = $transactionRepo;

    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $orderDataTable->render('admin.orders.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.orders.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $order = $this->orderRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.orders.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.orders.edit', $order->id));
        } else {
            $redirect_to = redirect(route('admin.orders.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $transactions = $this->transactionRepository->getTransactionByOrderId($id,$code=2);

        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.orders.index'));
        }
        $usercards = UserCard::where('user_id',$order->user_id)->get();
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $order);
        return view('admin.orders.show')->with(['order' => $order, 'title' => $this->BreadCrumbName, 'transactions' => $transactions, 'usercards' => $usercards]);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        

        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.orders.index'));
        }
        $id = $order->petspace_id;
        $user_id = $order->user_id;
        $usercards = UserCard::where('user_id',$user_id)->get();
        /** @var Petspace $petspace */
        $petspace = $this->petspaceRepository
            ->pushCriteria(new PetspaceCriteria(
                ['with_category' => true]
            ))->findWithoutFail($id);
        $petspace = $petspace->toArray();
        //$this->checkSession($order->total);
        $total = OrderHistory::where('order_id',$order->id)->first();
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $order);
        return view('admin.orders.cart')->with([
             'order' => $order, 
             'petspace' => $petspace, 
             'title' => $this->BreadCrumbName, 
             'usercards' => $usercards,
             'old_total' => $total['total']
         ]);
    }

    public function checkSession($total)
    {
        if (!session()->exists('visits'))
           
           { 
              session(['visits' => 0]);
               
               $visits = session('visits');
               
               $newVisits = $visits + 1;
               
               session(['visits' => $newVisits]);

               $visits = session('visits');

               if ($visits > 1)
               {
                   session(['order_amount' => $total]);
               }
            }
    }
    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.orders.index'));
        }

        $order = $this->orderRepository->updateRecord($request, $order);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.orders.create'));
        } else {
            $redirect_to = redirect(route('admin.orders.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.orders.index'));
        }

        $this->orderRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.orders.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function removeOrderServicesAddon($id,$type)
    {

        if ($type == 1) {
            $addons = array('order_service_id' => $id);
            $this->orderServiceRepository->deleteRecord($id);
            $this->orderServiceAddonRepository->deleteWhere($addons);
        } else {
            $this->orderServiceAddonRepository->deleteRecord($id);
        }

        return true;
    }

    public function updateOrderServicesAddon($request)
    {
        $services = $request->services;
        $order_id = $request->order_id;
        $deleted_items = $request->deleted_items;
                               // dd($deleted_items);

        if($deleted_items!=""){
            foreach ($deleted_items as $key => $delItem) {
                $delItem = json_decode($delItem,true);
                $id = $delItem['id'];
                $type = $delItem['type'];
                $this->removeOrderServicesAddon($id,$type);
            }
        }

        if($services!="" && $services!=null){
            foreach ($services as $key => $service)
                {
                        $service = json_decode($service,true);
        
                        $service_price  = $service['service_price'];
                        $service_id     = $service['service_id'];
                        $service_duration = $service['service_duration'];
                        $petid          = $service['petid'];
                        $petsize        = $service['petsize'];
                        $order_id       = $service['order_id'];
                        $submenu_service_price      = $service['submenu_service_price'];
                        $submenu_service_duration   = $service['submenu_service_duration'];
                        $submenu_sevice_id  = $service['submenu_sevice_id'];
                        //$cart_subtotal      = $service[''];
                        $addons             = isset($service['addons']) ? $service['addons'] : ''; 
                
                        $service_data = array(
                                "order_id"   => $order_id,
                                "pet_id"     => $petid,
                                "service_id" => $service_id,
                                "duration"   => $service_duration,
                                "price"      => $service_price
                
                            );
                
                        $orderService = $this->orderServiceRepository->saveRecord($service_data);
                        
                        $submenu_service_data = array(
                                "order_service_id"   => $orderService->id,                                
                                "submenu_service_id" => $submenu_sevice_id,
                                "duration"   => $submenu_service_duration,
                                "price"      => $submenu_service_price
                
                            );
                        $submenuOrderService = $this->orderServiceAddonRepository->saveRecord($submenu_service_data);

                        //$addon_price = 0;
                        if (isset($addons) && $addons!="") {
                                foreach ($addons as $addon) {
                                    $submenu_service = SubmenuService::where('id',$addons)->first();
                                    //dd($submenu_service);
                                    //$addon_price+=$submenu_service['price'];
                
                                    $addon_data         = array(
                                        "order_service_id"   => $orderService->id,
                                        "submenu_service_id" => $submenu_service['id'],
                                        "duration"           => $submenu_service['service_duration'],
                                        "price"              => $submenu_service['price']
                                    );
                                    $orderServiceAddons = $this->orderServiceAddonRepository->saveRecord($addon_data);
                                }
                        }
                
                       /* $addon_data = array(
                                        "order_service_id"   => $orderService->id,
                                        "submenu_service_id" => $submenu_sevice_id,
                                        "duration"           => $submenu_service_duration,
                                        "price"              => $submenu_service_price
                            );
                        $orderServiceAddons = $this->orderServiceAddonRepository->saveRecord($addon_data);*/
            }
        }

        $order = $this->orderRepository->findWithoutFail($order_id);
        $subtotal = $request->grosstotal;
        $tax = $request->finaltax;
        $finalamount = $request->finalamount;
        //$subtotal = $cart_subtotal + $addon_price + $service_price + $submenu_service_price;
        $orderRequest['tax'] = $tax;
        $orderRequest['sub_total'] = $subtotal;
        $orderRequest['total'] = $finalamount;// + $tax + $order->delivery_fee;


        $order = $this->orderRepository->updateRecord($orderRequest, $order);
        return true;
    }

    public function makePayment(Request $request)
    {
        $card_status = $request->payment;
        $ref = $request->user_cards;
        $order = $this->orderRepository->findWithoutFail($request->order_id);
        $amount = $order->total;

        $transactions = $this->transactionRepository->getTransactionByOrderId($order->id,$code=null);
        if(!empty($transactions)) {
           $ref = $transactions->transaction_id;
           $id = $transactions->id;
           $this->releasePayment($amount,$ref,$id);
        }


        if($this->updateOrderServicesAddon($request)){

        
        $order = $this->orderRepository->findWithoutFail($request->order_id);
        $cartid = random_int(100000, 999999);
        $orderreq['cart_id'] = $cartid;
        $orderUpdate = $this->orderRepository->updateRecord($orderreq, $order);
        $userdetail = collect(\DB::select('SELECT * FROM user_details WHERE user_id = ?' , [$order->user_id]))->first();

        $useraddress = UserAddress::where('user_id', $order->user_id)->first();
        //$phone = isset($userdetail->phone) ? $userdetail->phone : '+971544879391';
        //$address = isset($useraddress->address) ? $useraddress->address : '100 Financial Center Rd , Za\'abeelZa\'abeel 2';
        if ($card_status == 'oldcard') {
            $URL = 'https://secure.telr.com/gateway/remote.xml';
            $HTTPHEADER = array(
                'Content-Type: application/xml'
              );
            $POSTFIELDS = '<?xml version="1.0" encoding="UTF-8"?>
                            <remote>
                                <store>25561</store>
                                <key>VCV28@KRkF^hsgTv</key>
                                <tran>
                                    <type>auth</type>
                                    <class>cont</class>
                                    <cartid>'.$cartid.'</cartid>
                                    <description>Order Payment</description>
                                    <test>1</test>
                                    <currency>AED</currency>
                                    <amount>'.$order->total.'</amount>
                                    <ref>'.$ref.'</ref>
                                </tran>
                            </remote>';

        } else {
            $URL = 'https://secure.telr.com/gateway/order.json';
            $HTTPHEADER = array(
                'Content-Type: application/json'
              );
            $POSTFIELDS = '{
                "method": "create",
                "store": 25561,
                "authkey": "6mZ3^zXMFb-8pmxz",
                "order": {
                    "cartid": '.$cartid.',
                    "test": 1,
                    "amount": '.$order->total.',
                    "currency": "AED",
                    "description": "Order Payment",
                    "trantype": "auth"
                },
                "customer": {
                    "email": "'.$order->user->email.'",
                    "phone": "'.$userdetail->phone.'",
                    "name": {
                        "forenames": "'.$userdetail->first_name.'",
                        "surname": "'.$userdetail->last_name.'"
                    },
                    "address": {
                        "line1": "'.$useraddress->address.'",
                        "city": "Dubai",
                        "country": "AE"
                    }
                },
                "return": {
                    "authorised": "https://petspace.app/payment-authorized",
                    "declined": "https://petspace.app/payment-declined",
                    "cancelled": "https://petspace.app/payment-cancelled"
                }
            }';
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$POSTFIELDS,
          CURLOPT_HTTPHEADER => $HTTPHEADER,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if($card_status == 'oldcard') {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $arr = json_decode($json,true);

            $temp = array();
            foreach($arr as $k=>$v) {
              foreach($v as $k1=>$v1) {
                $temp[$k][$k1] = $v1;
              }
            }

            $response = $temp;

            $transact = [
                'user_id' => $order->user_id,
                'order_id'       => $order->id,
                'transaction_id' => $response['auth']['tranref'],
                'card_type'      => 'Visa Credit',
                'currency'       => 'AED',
                'status_code'    => $response['auth']['status'],
                'status_text'    => $response['auth']['message'],
                'message'        => $response['payment']['description'],
                'amount'         => $order->total
            ];
            $transactions = $this->transactionRepository->saveRecord($transact);
            $orderRef = UserCard::updateOrCreate(
                ['user_id' => $order->user_id,'ref' => $ref],
                ['ref' => $response['auth']['tranref']]
            );

        } else {
            $response = json_decode($response,true);
            if(isset($response['order'])){
                $orderRef = OrderReference::updateOrCreate(
                    ['order_id' => $order->id],
                    ['reference' => $response['order']['ref']]
                ); 
            }
        }
        $orderHistory = OrderHistory::updateOrCreate(
                ['order_id' => $order->id],
                ['total' => $order->total]
            );
        return view('admin.orders.payment_status')->with(['order' => $order, 'response' => $response, 'title' => $this->BreadCrumbName, 'card_status' => $card_status]);
        }
    }
    public function releasePayment($amount,$ref,$id)
    {
        $cartid = random_int(100000, 999999);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://secure.telr.com/gateway/remote.xml',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="UTF-8"?>
                            <remote>
                             <store>25561</store>
                             <key>VCV28@KRkF^hsgTv</key>
                             <tran>
                              <type>release</type>
                              <class>ecom</class>
                              <cartid>'.$cartid.'</cartid>
                              <description>Release Payment</description>
                              <test>1</test>
                              <currency>AED</currency>
                              <amount>'.$amount.'</amount>
                              <ref>'.$ref.'</ref>
                             </tran>
                            </remote>',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $transact = Transaction::destroy($id);

        return $response;
    }

    public function confirmPayment(Request $request)
    {
        $orderid = $request->orderid;
        $order = $this->orderRepository->findWithoutFail($orderid);

        $order_ref = OrderReference::where('order_id',$orderid)->first();
        $count = OrderReference::where('order_id',$orderid)->count();

        if($count > 0) {

            $ref = $order_ref->reference;
            $cartid = random_int(100000, 999999);
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://secure.telr.com/gateway/order.json',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "method": "check",
                "store": 25561,
                "authkey": "6mZ3^zXMFb-8pmxz",
                "order": {
                    "ref": "'.$ref.'"
                }
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);
            $res = json_decode($response,true);
            curl_close($curl);
            if(isset($res['order']) && $res['order']['status']['code'] == 2) {
            $transact = [
                'user_id' => $order->user_id,
                'order_id'       => $order->id,
                'transaction_id' => $res['order']['transaction']['ref'],
                'card_type'      => $res['order']['card']['type'],
                'currency'       => $res['order']['currency'],
                'status_code'    => $res['order']['status']['code'],
                'status_text'    => $res['order']['status']['text'],
                'message'        => 'sometimes',
                'amount'         => $res['order']['amount']
            ];
                $transactions = $this->transactionRepository->saveRecord($transact);
            }

            $resp = ['code' => $res['order']['status']['code']];
        } else {

            $resp = ['code' => 1];
        }
        return response()->json($resp);

    }


    public function makeLatePayment(Request $request)
    {
        $card_status = $request->payment;
        $ref = $request->user_cards;
        $order = $this->orderRepository->findWithoutFail($request->order_id);
        $amount = $order->total;   

        $cartid = random_int(100000, 999999);
        $userdetail = collect(\DB::select('SELECT * FROM user_details WHERE user_id = ?' , [$order->user_id]))->first();

        $useraddress = UserAddress::where('user_id', $order->user_id)->first();
        if ($card_status == 'oldcard') {
            $URL = 'https://secure.telr.com/gateway/remote.xml';
            $HTTPHEADER = array(
                'Content-Type: application/xml'
              );
            $POSTFIELDS = '<?xml version="1.0" encoding="UTF-8"?>
                            <remote>
                                <store>25561</store>
                                <key>VCV28@KRkF^hsgTv</key>
                                <tran>
                                    <type>auth</type>
                                    <class>cont</class>
                                    <cartid>'.$cartid.'</cartid>
                                    <description>Order Payment</description>
                                    <test>1</test>
                                    <currency>AED</currency>
                                    <amount>'.$order->total.'</amount>
                                    <ref>'.$ref.'</ref>
                                </tran>
                            </remote>';

        } else {
            $URL = 'https://secure.telr.com/gateway/order.json';
            $HTTPHEADER = array(
                'Content-Type: application/json'
              );
            $POSTFIELDS = '{
                "method": "create",
                "store": 25561,
                "authkey": "6mZ3^zXMFb-8pmxz",
                "order": {
                    "cartid": '.$cartid.',
                    "test": 1,
                    "amount": '.$order->total.',
                    "currency": "AED",
                    "description": "Order Payment",
                    "trantype": "auth"
                },
                "customer": {
                    "email": "'.$order->user->email.'",
                    "phone": "'.$userdetail->phone.'",
                    "name": {
                        "forenames": "'.$userdetail->first_name.'",
                        "surname": "'.$userdetail->last_name.'"
                    },
                    "address": {
                        "line1": "'.$useraddress->address.'",
                        "city": "Dubai",
                        "country": "AE"
                    }
                },
                "return": {
                    "authorised": "https://petspace.app/payment-authorized",
                    "declined": "https://petspace.app/payment-declined",
                    "cancelled": "https://petspace.app/payment-cancelled"
                }
            }';
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$POSTFIELDS,
          CURLOPT_HTTPHEADER => $HTTPHEADER,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if($card_status == 'oldcard') {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $arr = json_decode($json,true);

            $temp = array();
            foreach($arr as $k=>$v) {
              foreach($v as $k1=>$v1) {
                $temp[$k][$k1] = $v1;
              }
            }

            $response = $temp;
            if(isset($response['auth'])){
                $transact = [
                    'user_id' => $order->user_id,
                    'order_id'       => $order->id,
                    'transaction_id' => $response['auth']['tranref'],
                    'card_type'      => 'Visa Credit',
                    'currency'       => 'AED',
                    'status_code'    => $response['auth']['status'],
                    'status_text'    => $response['auth']['message'],
                    'message'        => $response['payment']['description'],
                    'amount'         => $order->total
                ];
                $transactions = $this->transactionRepository->saveRecord($transact);
                $orderRef = UserCard::updateOrCreate(
                    ['user_id' => $order->user_id,'ref' => $ref],
                    ['ref' => $response['auth']['tranref']]
                );
            }

        } else {
            $response = json_decode($response,true);

            if(isset($response['order'])){

                $orderRef = OrderReference::updateOrCreate(
                    ['order_id' => $order->id],
                    ['reference' => $response['order']['ref']]
                );
            }
        }

        return view('admin.orders.payment_status')->with(['order' => $order, 'response' => $response, 'title' => $this->BreadCrumbName, 'card_status' => $card_status]);
    }
}
