<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePackageSizeAPIRequest;
use App\Http\Requests\Api\UpdatePackageSizeAPIRequest;
use App\Models\PackageSize;
use App\Repositories\Admin\PackageSizeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PackageSizeController
 * @package App\Http\Controllers\Api
 */

class PackageSizeAPIController extends AppBaseController
{
    /** @var  PackageSizeRepository */
    private $packageSizeRepository;

    public function __construct(PackageSizeRepository $packageSizeRepo)
    {
        $this->packageSizeRepository = $packageSizeRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-sizes",
     *      summary="Get a listing of the PackageSizes.",
     *      tags={"PackageSize"},
     *      description="Get all PackageSizes",
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
     *                  //@SWG\Items(ref="#/definitions/PackageSize")
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
        $packageSizes = $this->packageSizeRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new packageSizeCriteria($request))
            ->all();

        return $this->sendResponse($packageSizes->toArray(), 'Package Sizes retrieved successfully');
    }

    /**
     * @param CreatePackageSizeAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/package-sizes",
     *      summary="Store a newly created PackageSize in storage",
     *      tags={"PackageSize"},
     *      description="Store PackageSize",
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
     *          description="PackageSize that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageSize")
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
     *                  ref="#/definitions/PackageSize"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePackageSizeAPIRequest $request)
    {
        $packageSizes = $this->packageSizeRepository->saveRecord($request);

        return $this->sendResponse($packageSizes->toArray(), 'Package Size saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-sizes/{id}",
     *      summary="Display the specified PackageSize",
     *      tags={"PackageSize"},
     *      description="Get PackageSize",
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
     *          description="id of PackageSize",
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
     *                  ref="#/definitions/PackageSize"
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
        /** @var PackageSize $packageSize */
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            return $this->sendErrorWithData(['Package Size not found']);
        }

        return $this->sendResponse($packageSize->toArray(), 'Package Size retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePackageSizeAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/package-sizes/{id}",
     *      summary="Update the specified PackageSize in storage",
     *      tags={"PackageSize"},
     *      description="Update PackageSize",
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
     *          description="id of PackageSize",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PackageSize that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageSize")
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
     *                  ref="#/definitions/PackageSize"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePackageSizeAPIRequest $request)
    {
        /** @var PackageSize $packageSize */
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            return $this->sendErrorWithData(['Package Size not found']);
        }

        $packageSize = $this->packageSizeRepository->updateRecord($request, $packageSize);

        return $this->sendResponse($packageSize->toArray(), 'PackageSize updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/package-sizes/{id}",
     *      summary="Remove the specified PackageSize from storage",
     *      tags={"PackageSize"},
     *      description="Delete PackageSize",
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
     *          description="id of PackageSize",
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
        /** @var PackageSize $packageSize */
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            return $this->sendErrorWithData(['Package Size not found']);
        }

        $this->packageSizeRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Package Size deleted successfully');
    }
}
