<?php

namespace App\Http\Controllers\Api;

use App\Criteria\UserAddressCriteria;
use App\Http\Requests\Api\CreateUserAddressAPIRequest;
use App\Http\Requests\Api\UpdateUserAddressAPIRequest;
use App\Models\UserAddress;
use App\Repositories\Admin\UserAddressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class UserAddressController
 * @package App\Http\Controllers\Api
 */

class UserAddressAPIController extends AppBaseController
{
    /** @var  UserAddressRepository */
    private $userAddressRepository;

    public function __construct(UserAddressRepository $userAddressRepo)
    {
        $this->userAddressRepository = $userAddressRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/user-addresses",
     *      summary="Get a listing of the UserAddresses.",
     *      tags={"UserAddress"},
     *      description="Get all UserAddresses",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *     @SWG\Parameter(
     *          name="is_mine",
     *          description="Filter data with current user. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
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
     *                  @SWG\Items(ref="#/definitions/UserAddress")
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
        $userAddresses = $this->userAddressRepository->resetCriteria()
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new UserAddressCriteria([
                'is_mine' => 1]
            ))
            ->all();

        return $this->sendResponse($userAddresses->toArray(), 'User Addresses retrieved successfully');
    }

    /**
     * @param CreateUserAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/user-addresses",
     *      summary="Store a newly created UserAddress in storage",
     *      tags={"UserAddress"},
     *      description="Store UserAddress",
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
     *          description="UserAddress that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserAddress")
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
     *                  ref="#/definitions/UserAddress"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserAddressAPIRequest $request)
    {
        $userAddresses = $this->userAddressRepository->saveRecord($request);

        return $this->sendResponse($userAddresses->toArray(), 'User Address saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/user-addresses/{id}",
     *      summary="Display the specified UserAddress",
     *      tags={"UserAddress"},
     *      description="Get UserAddress",
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
     *          description="id of UserAddress",
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
     *                  ref="#/definitions/UserAddress"
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
        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            return $this->sendErrorWithData(['User Address not found']);
        }

        return $this->sendResponse($userAddress->toArray(), 'User Address retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserAddressAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/user-addresses/{id}",
     *      summary="Update the specified UserAddress in storage",
     *      tags={"UserAddress"},
     *      description="Update UserAddress",
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
     *          description="id of UserAddress",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserAddress that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserAddress")
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
     *                  ref="#/definitions/UserAddress"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserAddressAPIRequest $request)
    {
        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            return $this->sendErrorWithData(['User Address not found']);
        }

        $userAddress = $this->userAddressRepository->updateRecord($request, $userAddress);

        return $this->sendResponse($userAddress->toArray(), 'UserAddress updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/user-addresses/{id}",
     *      summary="Remove the specified UserAddress from storage",
     *      tags={"UserAddress"},
     *      description="Delete UserAddress",
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
     *          description="id of UserAddress",
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
        /** @var UserAddress $userAddress */
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            return $this->sendErrorWithData(['User Address not found']);
        }

        $this->userAddressRepository->deleteRecord($id);

        return $this->sendResponse($id, 'User Address deleted successfully');
    }
}
