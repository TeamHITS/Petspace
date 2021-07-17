<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePackageAddonAPIRequest;
use App\Http\Requests\Api\UpdatePackageAddonAPIRequest;
use App\Models\PackageAddon;
use App\Repositories\Admin\PackageAddonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class PackageAddonController
 * @package App\Http\Controllers\Api
 */

class PackageAddonAPIController extends AppBaseController
{
    /** @var  PackageAddonRepository */
    private $packageAddonRepository;

    public function __construct(PackageAddonRepository $packageAddonRepo)
    {
        $this->packageAddonRepository = $packageAddonRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-addons",
     *      summary="Get a listing of the PackageAddons.",
     *      tags={"PackageAddon"},
     *      description="Get all PackageAddons",
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
     *                  //@SWG\Items(ref="#/definitions/PackageAddon")
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
        $packageAddons = $this->packageAddonRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new packageAddonCriteria($request))
            ->all();

        return $this->sendResponse($packageAddons->toArray(), 'Package Addons retrieved successfully');
    }

    /**
     * @param CreatePackageAddonAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/package-addons",
     *      summary="Store a newly created PackageAddon in storage",
     *      tags={"PackageAddon"},
     *      description="Store PackageAddon",
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
     *          description="PackageAddon that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageAddon")
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
     *                  ref="#/definitions/PackageAddon"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePackageAddonAPIRequest $request)
    {
        $packageAddons = $this->packageAddonRepository->saveRecord($request);

        return $this->sendResponse($packageAddons->toArray(), 'Package Addon saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Get(
     *      path="/package-addons/{id}",
     *      summary="Display the specified PackageAddon",
     *      tags={"PackageAddon"},
     *      description="Get PackageAddon",
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
     *          description="id of PackageAddon",
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
     *                  ref="#/definitions/PackageAddon"
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
        /** @var PackageAddon $packageAddon */
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            return $this->sendErrorWithData(['Package Addon not found']);
        }

        return $this->sendResponse($packageAddon->toArray(), 'Package Addon retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePackageAddonAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/package-addons/{id}",
     *      summary="Update the specified PackageAddon in storage",
     *      tags={"PackageAddon"},
     *      description="Update PackageAddon",
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
     *          description="id of PackageAddon",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PackageAddon that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/PackageAddon")
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"//
     *              ),
     *              //@SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PackageAddon"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePackageAddonAPIRequest $request)
    {
        /** @var PackageAddon $packageAddon */
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            return $this->sendErrorWithData(['Package Addon not found']);
        }

        $packageAddon = $this->packageAddonRepository->updateRecord($request, $packageAddon);

        return $this->sendResponse($packageAddon->toArray(), 'PackageAddon updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/package-addons/{id}",
     *      summary="Remove the specified PackageAddon from storage",
     *      tags={"PackageAddon"},
     *      description="Delete PackageAddon",
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
     *          description="id of PackageAddon",
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
        /** @var PackageAddon $packageAddon */
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            return $this->sendErrorWithData(['Package Addon not found']);
        }

        $this->packageAddonRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Package Addon deleted successfully');
    }
}
