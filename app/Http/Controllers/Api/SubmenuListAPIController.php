<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSubmenuListAPIRequest;
use App\Http\Requests\Api\UpdateSubmenuListAPIRequest;
use App\Models\SubmenuList;
use App\Repositories\Admin\SubmenuListRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class SubmenuListController
 * @package App\Http\Controllers\Api
 */

class SubmenuListAPIController extends AppBaseController
{
    /** @var  SubmenuListRepository */
    private $submenuListRepository;

    public function __construct(SubmenuListRepository $submenuListRepo)
    {
        $this->submenuListRepository = $submenuListRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/submenu-lists",
     *      summary="Get a listing of the SubmenuLists.",
     *      tags={"SubmenuList"},
     *      description="Get all SubmenuLists",
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
     *                  //@SWG\Items(ref="#/definitions/SubmenuList")
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
        $submenuLists = $this->submenuListRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new submenuListCriteria($request))
            ->all();

        return $this->sendResponse($submenuLists->toArray(), 'Submenu Lists retrieved successfully');
    }

    /**
     * @param CreateSubmenuListAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/submenu-lists",
     *      summary="Store a newly created SubmenuList in storage",
     *      tags={"SubmenuList"},
     *      description="Store SubmenuList",
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
     *          description="SubmenuList that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/SubmenuList")
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
     *                  ref="#/definitions/SubmenuList"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSubmenuListAPIRequest $request)
    {
        $submenuLists = $this->submenuListRepository->saveRecord($request);

        return $this->sendResponse($submenuLists->toArray(), 'Submenu List saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/submenu-lists/{id}",
     *      summary="Display the specified SubmenuList",
     *      tags={"SubmenuList"},
     *      description="Get SubmenuList",
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
     *          description="id of SubmenuList",
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
     *                  ref="#/definitions/SubmenuList"
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
        /** @var SubmenuList $submenuList */
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            return $this->sendErrorWithData(['Submenu List not found']);
        }

        return $this->sendResponse($submenuList->toArray(), 'Submenu List retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSubmenuListAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/submenu-lists/{id}",
     *      summary="Update the specified SubmenuList in storage",
     *      tags={"SubmenuList"},
     *      description="Update SubmenuList",
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
     *          description="id of SubmenuList",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SubmenuList that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/SubmenuList")
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
     *                  ref="#/definitions/SubmenuList"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSubmenuListAPIRequest $request)
    {
        /** @var SubmenuList $submenuList */
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            return $this->sendErrorWithData(['Submenu List not found']);
        }

        $submenuList = $this->submenuListRepository->updateRecord($request, $submenuList);

        return $this->sendResponse($submenuList->toArray(), 'SubmenuList updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/submenu-lists/{id}",
     *      summary="Remove the specified SubmenuList from storage",
     *      tags={"SubmenuList"},
     *      description="Delete SubmenuList",
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
     *          description="id of SubmenuList",
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
        /** @var SubmenuList $submenuList */
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            return $this->sendErrorWithData(['Submenu List not found']);
        }

        $this->submenuListRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Submenu List deleted successfully');
    }
}
