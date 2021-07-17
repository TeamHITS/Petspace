<?php

namespace App\Http\Controllers\Api;

use App\Criteria\PetspaceCriteria;
use App\Http\Requests\Api\CreatePetspaceAPIRequest;
use App\Http\Requests\Api\UpdatePetspaceAPIRequest;
use App\Models\Petspace;
use App\Repositories\Admin\PetspaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use phpDocumentor\Reflection\Types\True_;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PetspaceController
 * @package App\Http\Controllers\Api
 */
class PetspaceAPIController extends AppBaseController
{
    /** @var  PetspaceRepository */
    private $petspaceRepository;

    public function __construct(PetspaceRepository $petspaceRepo)
    {
        $this->petspaceRepository = $petspaceRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/petspaces",
     *      summary="Get a listing of the Petspaces.",
     *      tags={"Petspace"},
     *      description="Get all Petspaces",
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
     *          name="latitude",
     *          description="Search User by User's Current Location.",
     *          type="number",
     *          format="float",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="longitude",
     *          description="Search User by User's Current Location.",
     *          type="number",
     *          format="float",
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
     *                  @SWG\Items(ref="#/definitions/Petspace")
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

        $currentTime = time();
        $checkShop = DB::table('settings')->first();

        if(!$checkShop->is_shops_open){
            return $this->sendResponse([], 'Platform close');
        }
//        if($currentTime <= strtotime($checkShop->start_time) || $currentTime >= strtotime($checkShop->close_time)){
//            return $this->sendResponse([], 'Platform close');
//        }


        $petspaces = $this->petspaceRepository->resetCriteria()
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->pushCriteria(new PetspaceCriteria([
                'latitude'    => $request->get('latitude', null),
                'longitude'   => $request->get('longitude', null),
                'area'        => config('constants.distance_unit'),
                'distance'    => config('constants.min_distance'),
                'is_approved' => true,
            ]))
            ->all();

        return $this->sendResponse($petspaces->toArray(), 'Petspaces retrieved successfully');
    }

    /**
     * @param CreatePetspaceAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/petspaces",
     *      summary="Store a newly created Petspace in storage",
     *      tags={"Petspace"},
     *      description="Store Petspace",
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
     *          description="Petspace that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/Petspace")
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
     *                  ref="#/definitions/Petspace"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePetspaceAPIRequest $request)
    {
        $petspaces = $this->petspaceRepository->saveRecord($request);

        return $this->sendResponse($petspaces->toArray(), 'Petspace saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/petspaces/{id}",
     *      summary="Display the specified Petspace",
     *      tags={"Petspace"},
     *      description="Get Petspace",
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
     *          description="id of Petspace",
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
     *                  ref="#/definitions/Petspace"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id, Request $request)
    {
        /** @var Petspace $petspace */
        $petspace = $this->petspaceRepository
            ->pushCriteria(new PetspaceCriteria(
                ['with_category' => true]
            ))->findWithoutFail($id);

        if (empty($petspace)) {
            return $this->sendErrorWithData(['Petspace not found']);
        }

        return $this->sendResponse($petspace->toArray(), 'Petspace retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePetspaceAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/petspaces/{id}",
     *      summary="Update the specified Petspace in storage",
     *      tags={"Petspace"},
     *      description="Update Petspace",
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
     *          description="id of Petspace",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Petspace that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/Petspace")
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
     *                  ref="#/definitions/Petspace"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePetspaceAPIRequest $request)
    {
        /** @var Petspace $petspace */
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            return $this->sendErrorWithData(['Petspace not found']);
        }

        $petspace = $this->petspaceRepository->updateRecord($request, $petspace);

        return $this->sendResponse($petspace->toArray(), 'Petspace updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/petspaces/{id}",
     *      summary="Remove the specified Petspace from storage",
     *      tags={"Petspace"},
     *      description="Delete Petspace",
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
     *          description="id of Petspace",
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
        /** @var Petspace $petspace */
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            return $this->sendErrorWithData(['Petspace not found']);
        }

        $this->petspaceRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Petspace deleted successfully');
    }
}
