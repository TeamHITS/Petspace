<?php

namespace App\Http\Controllers\Api;

use App\Criteria\UserPetCriteria;
use App\Http\Requests\Api\CreateUserPetAPIRequest;
use App\Http\Requests\Api\UpdateUserPetAPIRequest;
use App\Models\UserPet;
use App\Repositories\Admin\UserPetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class UserPetController
 * @package App\Http\Controllers\Api
 */

class UserPetAPIController extends AppBaseController
{
    /** @var  UserPetRepository */
    private $userPetRepository;

    public function __construct(UserPetRepository $userPetRepo)
    {
        $this->userPetRepository = $userPetRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/user-pets",
     *      summary="Get a listing of the UserPets.",
     *      tags={"UserPet"},
     *      description="Get all UserPets",
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
     *                  @SWG\Items(ref="#/definitions/UserPet")
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
        $userPets = $this->userPetRepository->resetCriteria()
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new UserPetCriteria([
                'is_mine' => 1]))
            ->all();

        return $this->sendResponse($userPets->toArray(), 'User Pets retrieved successfully');
    }

    /**
     * @param CreateUserPetAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/user-pets",
     *      summary="Store a newly created UserPet in storage",
     *      tags={"UserPet"},
     *      description="Store UserPet",
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
     *          description="UserPet that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserPet")
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
     *                  ref="#/definitions/UserPet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserPetAPIRequest $request)
    {
        $userPets = $this->userPetRepository->saveRecord($request);

        return $this->sendResponse($userPets->toArray(), 'User Pet saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/user-pets/{id}",
     *      summary="Display the specified UserPet",
     *      tags={"UserPet"},
     *      description="Get UserPet",
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
     *          description="id of UserPet",
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
     *                  ref="#/definitions/UserPet"
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
        /** @var UserPet $userPet */
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            return $this->sendErrorWithData(['User Pet not found']);
        }

        return $this->sendResponse($userPet->toArray(), 'User Pet retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserPetAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/user-pets/{id}",
     *      summary="Update the specified UserPet in storage",
     *      tags={"UserPet"},
     *      description="Update UserPet",
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
     *          description="id of UserPet",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserPet that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserPet")
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
     *                  ref="#/definitions/UserPet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserPetAPIRequest $request)
    {
        /** @var UserPet $userPet */
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            return $this->sendErrorWithData(['User Pet not found']);
        }

        $userPet = $this->userPetRepository->updateRecord($request, $userPet);

        return $this->sendResponse($userPet->toArray(), 'UserPet updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/user-pets/{id}",
     *      summary="Remove the specified UserPet from storage",
     *      tags={"UserPet"},
     *      description="Delete UserPet",
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
     *          description="id of UserPet",
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
        /** @var UserPet $userPet */
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            return $this->sendErrorWithData(['User Pet not found']);
        }

        $this->userPetRepository->deleteRecord($id);

        return $this->sendResponse($id, 'User Pet deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pets-new",
     *      summary="Store a newly created UserPet in storage",
     *      tags={"UserPet"},
     *      description="Store or Update UserPet",
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
     *          description="UserPet that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserPet")
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
     *                  ref="#/definitions/UserPet"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function creatOrUpdate(Request $request)
    {
        if ($request->has('id')){

            $userPet = $this->userPetRepository->findWithoutFail($request->get('id', 0));
            if (empty($userPet)) {
                return $this->sendErrorWithData(['User Pet not found']);
            }
            $userPet = $this->userPetRepository->updateRecord($request, $userPet);

            return $this->sendResponse($userPet->toArray(), 'UserPet updated successfully');
        }else{
            $userPets = $this->userPetRepository->saveRecord($request);

            /*adding pet to user profile*/
            $user = \Auth::user();
            $user->is_pet_added = 1;
            $user->save();

            return $this->sendResponse($userPets->toArray(), 'User Pet saved successfully');
        }
    }
}
