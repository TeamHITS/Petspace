<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePackageTypeAPIRequest;
use App\Http\Requests\Api\UpdatePackageTypeAPIRequest;
use App\Models\PackageType;
use App\Repositories\Admin\PackageTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PackageTypeController
 * @package App\Http\Controllers\Api
 */

class PackageTypeAPIController extends AppBaseController
{
    /** @var  PackageTypeRepository */
    private $packageTypeRepository;

    public function __construct(PackageTypeRepository $packageTypeRepo)
    {
        $this->packageTypeRepository = $packageTypeRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-types",
     *      summary="Get a listing of the PackageTypes.",
     *      tags={"PackageType"},
     *      description="Get all PackageTypes",
     *      produces={"application/json"},
     *      ////@SWG\Parameter(
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
     *                  //@SWG\Items(ref="#/definitions/PackageType")
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
        $packageTypes = $this->packageTypeRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new packageTypeCriteria($request))
            ->all();

        return $this->sendResponse($packageTypes->toArray(), 'Package Types retrieved successfully');
    }

    /**
     * @param CreatePackageTypeAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/package-types",
     *      summary="Store a newly created PackageType in storage",
     *      tags={"PackageType"},
     *      description="Store PackageType",
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
     *          description="PackageType that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageType")
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
     *                  ref="#/definitions/PackageType"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePackageTypeAPIRequest $request)
    {
        $packageTypes = $this->packageTypeRepository->saveRecord($request);

        return $this->sendResponse($packageTypes->toArray(), 'Package Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-types/{id}",
     *      summary="Display the specified PackageType",
     *      tags={"PackageType"},
     *      description="Get PackageType",
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
     *          description="id of PackageType",
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
     *                  ref="#/definitions/PackageType"
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
        /** @var PackageType $packageType */
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            return $this->sendErrorWithData(['Package Type not found']);
        }

        return $this->sendResponse($packageType->toArray(), 'Package Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePackageTypeAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/package-types/{id}",
     *      summary="Update the specified PackageType in storage",
     *      tags={"PackageType"},
     *      description="Update PackageType",
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
     *          description="id of PackageType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PackageType that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageType")
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
     *                  ref="#/definitions/PackageType"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePackageTypeAPIRequest $request)
    {
        /** @var PackageType $packageType */
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            return $this->sendErrorWithData(['Package Type not found']);
        }

        $packageType = $this->packageTypeRepository->updateRecord($request, $packageType);

        return $this->sendResponse($packageType->toArray(), 'PackageType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/package-types/{id}",
     *      summary="Remove the specified PackageType from storage",
     *      tags={"PackageType"},
     *      description="Delete PackageType",
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
     *          description="id of PackageType",
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
        /** @var PackageType $packageType */
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            return $this->sendErrorWithData(['Package Type not found']);
        }

        $this->packageTypeRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Package Type deleted successfully');
    }
}
