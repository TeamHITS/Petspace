<?php

namespace App\Http\Controllers\Api;

use App\Criteria\UserCardCriteria;
use App\Http\Requests\Api\CreateUserCardAPIRequest;
use App\Http\Requests\Api\UpdateUserCardAPIRequest;
use App\Models\UserCard;
use App\Repositories\Admin\TransactionRepository;
use App\Repositories\Admin\UserCardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class UserCardController
 * @package App\Http\Controllers\Api
 */
class UserCardAPIController extends AppBaseController
{
    /** @var  UserCardRepository */
    private $userCardRepository;
    private $transactionRepository;

    public function __construct(UserCardRepository $userCardRepo, TransactionRepository $transactionRepo)
    {
        $this->userCardRepository    = $userCardRepo;
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/user-cards",
     *      summary="Get a listing of the UserCards.",
     *      tags={"UserCard"},
     *      description="Get all UserCards",
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
     *                  @SWG\Items(ref="#/definitions/UserCard")
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
        $userCards = $this->userCardRepository->resetCriteria()
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new UserCardCriteria([
                'is_mine' => 1]))
            ->all();

        return $this->sendResponse($userCards->toArray(), 'User Cards retrieved successfully');
    }

    /**
     * @param CreateUserCardAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/user-cards",
     *      summary="Store a newly created UserCard in storage",
     *      tags={"UserCard"},
     *      description="Store UserCard",
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
     *          description="UserCard that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/UserCard")
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
     *                  ref="#/definitions/UserCard"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserCardAPIRequest $request)
    {
        $userCards = $this->userCardRepository->saveRecord($request);

        return $this->sendResponse($userCards->toArray(), 'User Card saved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/check-transaction",
     *      summary="Store a newly created UserCard in storage",
     *      tags={"UserCard"},
     *      description="Store UserCard",
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
     *          description="UserCard that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserCard")
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
     *                  ref="#/definitions/UserCard"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function checkTransaction(Request $request)
    {
        $input = $request->all();

        $data = array(
            "ivp_method"  => "check",
            "ivp_store"   => 25561,
            "ivp_authkey" => "6mZ3^zXMFb-8pmxz",
            "order_ref"   => $input['order_ref']
        );

        $ch = curl_init('https://secure.telr.com/gateway/order.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt_array($ch, array(
            CURLOPT_POST       => 1,
            CURLOPT_POSTFIELDS => $data
        ));
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            $result = json_decode(json_encode($result), true);

            if ($result['order']['status']['text'] == "Authorised") {
                if($input['save_card'] == 1 ){
                    $cardDetail = array(
                        "user_id"      => \Auth::id(),
                        "ref"          => $result['order']['transaction']['ref'],
                        "type"         => $result['order']['card']['type'],
                        "first_digits" => $result['order']['card']['first6'],
                        "last_digits"  => $result['order']['card']['last4'],
                        "country"      => $result['order']['card']['country'],
                        "expire_month" => $result['order']['card']['expiry']['month'],
                        "expire_year"  => $result['order']['card']['expiry']['year']
                    );

                    $userCards = $this->userCardRepository->saveRecord($cardDetail);
                }

                $transactionDetail = array(
                    "user_id"        => \Auth::id(),
                    "order_id"       => $input['order_id'],
                    "transaction_id" => $result['order']['transaction']['ref'],
                    "card_type"      => $result['order']['card']['type'],
                    "amount"         => $result['order']['amount'],
                    "currency"       => $result['order']['currency'],
                    "status_code"    => $result['order']['status']['code'],
                    "status_text"    => $result['order']['status']['text']
                );
                $transactionResult = $this->transactionRepository->saveRecord($transactionDetail);
            }else{
                return $this->sendErrorWithData(['User transaction not found']);
            }
        }

        return $this->sendResponse($transactionResult->toArray(), 'User Card and Transaction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/user-cards/{id}",
     *      summary="Display the specified UserCard",
     *      tags={"UserCard"},
     *      description="Get UserCard",
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
     *          description="id of UserCard",
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
     *                  ref="#/definitions/UserCard"
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
        /** @var UserCard $userCard */
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            return $this->sendErrorWithData(['User Card not found']);
        }

        return $this->sendResponse($userCard->toArray(), 'User Card retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserCardAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/user-cards/{id}",
     *      summary="Update the specified UserCard in storage",
     *      tags={"UserCard"},
     *      description="Update UserCard",
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
     *          description="id of UserCard",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserCard that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/UserCard")
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
     *                  ref="#/definitions/UserCard"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserCardAPIRequest $request)
    {
        /** @var UserCard $userCard */
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            return $this->sendErrorWithData(['User Card not found']);
        }

        $userCard = $this->userCardRepository->updateRecord($request, $userCard);

        return $this->sendResponse($userCard->toArray(), 'UserCard updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/user-cards/{id}",
     *      summary="Remove the specified UserCard from storage",
     *      tags={"UserCard"},
     *      description="Delete UserCard",
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
     *          description="id of UserCard",
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
        /** @var UserCard $userCard */
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            return $this->sendErrorWithData(['User Card not found']);
        }

        $this->userCardRepository->deleteRecord($id);

        return $this->sendResponse($id, 'User Card deleted successfully');
    }
}
