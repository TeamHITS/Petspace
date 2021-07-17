<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBannerManagementAPIRequest;
use App\Http\Requests\Api\UpdateBannerManagementAPIRequest;
use App\Models\BannerManagement;
use App\Repositories\Admin\BannerManagementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class BannerManagementController
 * @package App\Http\Controllers\Api
 */

class BannerManagementAPIController extends AppBaseController
{
    /** @var  BannerManagementRepository */
    private $bannerManagementRepository;

    public function __construct(BannerManagementRepository $bannerManagementRepo)
    {
        $this->bannerManagementRepository = $bannerManagementRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/banner-managements",
     *      summary="Get a listing of the BannerManagements.",
     *      tags={"BannerManagement"},
     *      description="Get all BannerManagements",
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
     *                  @SWG\Items(ref="#/definitions/BannerManagement")
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
        $bannerManagements = $this->bannerManagementRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new bannerManagementCriteria($request))
            ->all();

        return $this->sendResponse($bannerManagements->toArray(), 'Banner Managements retrieved successfully');
    }

    /**
     * @param CreateBannerManagementAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/banner-managements",
     *      summary="Store a newly created BannerManagement in storage",
     *      tags={"BannerManagement"},
     *      description="Store BannerManagement",
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
     *          description="BannerManagement that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/BannerManagement")
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
     *                  ref="#/definitions/BannerManagement"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBannerManagementAPIRequest $request)
    {
        $bannerManagements = $this->bannerManagementRepository->saveRecord($request);

        return $this->sendResponse($bannerManagements->toArray(), 'Banner Management saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/banner-managements/{id}",
     *      summary="Display the specified BannerManagement",
     *      tags={"BannerManagement"},
     *      description="Get BannerManagement",
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
     *          description="id of BannerManagement",
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
     *                  ref="#/definitions/BannerManagement"
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
        /** @var BannerManagement $bannerManagement */
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            return $this->sendErrorWithData(['Banner Management not found']);
        }

        return $this->sendResponse($bannerManagement->toArray(), 'Banner Management retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBannerManagementAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/banner-managements/{id}",
     *      summary="Update the specified BannerManagement in storage",
     *      tags={"BannerManagement"},
     *      description="Update BannerManagement",
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
     *          description="id of BannerManagement",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BannerManagement that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/BannerManagement")
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
     *                  ref="#/definitions/BannerManagement"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBannerManagementAPIRequest $request)
    {
        /** @var BannerManagement $bannerManagement */
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            return $this->sendErrorWithData(['Banner Management not found']);
        }

        $bannerManagement = $this->bannerManagementRepository->updateRecord($request, $bannerManagement);

        return $this->sendResponse($bannerManagement->toArray(), 'BannerManagement updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/banner-managements/{id}",
     *      summary="Remove the specified BannerManagement from storage",
     *      tags={"BannerManagement"},
     *      description="Delete BannerManagement",
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
     *          description="id of BannerManagement",
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
        /** @var BannerManagement $bannerManagement */
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            return $this->sendErrorWithData(['Banner Management not found']);
        }

        $this->bannerManagementRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Banner Management deleted successfully');
    }
}
