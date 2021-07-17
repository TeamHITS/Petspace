<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSubmenuServiceAPIRequest;
use App\Http\Requests\Api\UpdateSubmenuServiceAPIRequest;
use App\Models\SubmenuService;
use App\Repositories\Admin\SubmenuServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class SubmenuServiceController
 * @package App\Http\Controllers\Api
 */

class SubmenuServiceAPIController extends AppBaseController
{
    /** @var  SubmenuServiceRepository */
    private $submenuServiceRepository;

    public function __construct(SubmenuServiceRepository $submenuServiceRepo)
    {
        $this->submenuServiceRepository = $submenuServiceRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/submenu-services",
     *      summary="Get a listing of the SubmenuServices.",
     *      tags={"SubmenuService"},
     *      description="Get all SubmenuServices",
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
     *          name="orderBy",
     *          description="Pass the property name you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      //@SWG\Parameter(
     *          name="sortedBy",
     *          description="Pass 'asc' or 'desc' to define the sorting method. If not found, 'asc' will be used by default",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      //@SWG\Parameter(
     *          name="limit",
     *          description="Change the Default Record Count. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *     //@SWG\Parameter(
     *          name="offset",
     *          description="Change the Default Offset of the Query. If not found, 0 will be used.",
     *          type="integer",
     *          required=false,
     *          in="query"
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
     *                  type="array",
     *                  //@SWG\Items(ref="#/definitions/SubmenuService")
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $submenuServices = $this->submenuServiceRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new submenuServiceCriteria($request))
            ->all();

        return $this->sendResponse($submenuServices->toArray(), 'Submenu Services retrieved successfully');
    }

    /**
     * @param CreateSubmenuServiceAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/submenu-services",
     *      summary="Store a newly created SubmenuService in storage",
     *      tags={"SubmenuService"},
     *      description="Store SubmenuService",
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
     *          description="SubmenuService that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/SubmenuService")
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
     *                  ref="#/definitions/SubmenuService"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSubmenuServiceAPIRequest $request)
    {
        $submenuServices = $this->submenuServiceRepository->saveRecord($request);

        return $this->sendResponse($submenuServices->toArray(), 'Submenu Service saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/submenu-services/{id}",
     *      summary="Display the specified SubmenuService",
     *      tags={"SubmenuService"},
     *      description="Get SubmenuService",
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
     *          description="id of SubmenuService",
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
     *                  ref="#/definitions/SubmenuService"
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
        /** @var SubmenuService $submenuService */
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            return $this->sendErrorWithData(['Submenu Service not found']);
        }

        return $this->sendResponse($submenuService->toArray(), 'Submenu Service retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSubmenuServiceAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/submenu-services/{id}",
     *      summary="Update the specified SubmenuService in storage",
     *      tags={"SubmenuService"},
     *      description="Update SubmenuService",
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
     *          description="id of SubmenuService",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SubmenuService that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/SubmenuService")
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
     *                  ref="#/definitions/SubmenuService"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSubmenuServiceAPIRequest $request)
    {
        /** @var SubmenuService $submenuService */
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            return $this->sendErrorWithData(['Submenu Service not found']);
        }

        $submenuService = $this->submenuServiceRepository->updateRecord($request, $submenuService);

        return $this->sendResponse($submenuService->toArray(), 'SubmenuService updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/submenu-services/{id}",
     *      summary="Remove the specified SubmenuService from storage",
     *      tags={"SubmenuService"},
     *      description="Delete SubmenuService",
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
     *          description="id of SubmenuService",
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
        /** @var SubmenuService $submenuService */
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            return $this->sendErrorWithData(['Submenu Service not found']);
        }

        $this->submenuServiceRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Submenu Service deleted successfully');
    }
}
