<?php

namespace App\Http\Controllers\Api;

use App\Criteria\CategoryServiceCriteria;
use App\Http\Requests\Api\CreateCategoryServiceAPIRequest;
use App\Http\Requests\Api\UpdateCategoryServiceAPIRequest;
use App\Models\CategoryService;
use App\Repositories\Admin\CategoryServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class CategoryServiceController
 * @package App\Http\Controllers\Api
 */

class CategoryServiceAPIController extends AppBaseController
{
    /** @var  CategoryServiceRepository */
    private $categoryServiceRepository;

    public function __construct(CategoryServiceRepository $categoryServiceRepo)
    {
        $this->categoryServiceRepository = $categoryServiceRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * //@SWG\Get(
     *      path="/category-services",
     *      summary="Get a listing of the CategoryServices.",
     *      tags={"CategoryService"},
     *      description="Get all CategoryServices",
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
     *                  //@SWG\Items(ref="#/definitions/CategoryService")
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
        $categoryServices = $this->categoryServiceRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new categoryServiceCriteria($request))
            ->all();

        return $this->sendResponse($categoryServices->toArray(), 'Category Services retrieved successfully');
    }

    /**
     * @param CreateCategoryServiceAPIRequest $request
     * @return Response
     *
     * //@SWG\Post(
     *      path="/category-services",
     *      summary="Store a newly created CategoryService in storage",
     *      tags={"CategoryService"},
     *      description="Store CategoryService",
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
     *          description="CategoryService that should be stored",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/CategoryService")
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
     *                  ref="#/definitions/CategoryService"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoryServiceAPIRequest $request)
    {
        $categoryServices = $this->categoryServiceRepository->saveRecord($request);

        return $this->sendResponse($categoryServices->toArray(), 'Category Service saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/category-services/{id}",
     *      summary="Display the specified CategoryService",
     *      tags={"CategoryService"},
     *      description="Get CategoryService",
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
     *          description="id of CategoryService",
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
     *                  ref="#/definitions/CategoryService"
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
        /** @var CategoryService $categoryService */
        $categoryService = $this->categoryServiceRepository->resetCriteria()
            ->pushCriteria(new CategoryServiceCriteria(
                [
                    'with_submenu' => true,
                    'category_id' => $id
                ]
            ))->get();

        if (empty($categoryService)) {
            return $this->sendErrorWithData(['Category Service not found']);
        }

        return $this->sendResponse($categoryService->toArray(), 'Category Service retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCategoryServiceAPIRequest $request
     * @return Response
     *
     * //@SWG\Put(
     *      path="/category-services/{id}",
     *      summary="Update the specified CategoryService in storage",
     *      tags={"CategoryService"},
     *      description="Update CategoryService",
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
     *          description="id of CategoryService",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      //@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategoryService that should be updated",
     *          required=false,
     *          //@SWG\Schema(ref="#/definitions/CategoryService")
     *      ),
     *      //@SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          //@SWG\Schema(
     *              type="object",
     *              //@SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),//
     *              //@SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/CategoryService"
     *              ),
     *              //@SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoryServiceAPIRequest $request)
    {
        /** @var CategoryService $categoryService */
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            return $this->sendErrorWithData(['Category Service not found']);
        }

        $categoryService = $this->categoryServiceRepository->updateRecord($request, $categoryService);

        return $this->sendResponse($categoryService->toArray(), 'CategoryService updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * //@SWG\Delete(
     *      path="/category-services/{id}",
     *      summary="Remove the specified CategoryService from storage",
     *      tags={"CategoryService"},
     *      description="Delete CategoryService",
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
     *          description="id of CategoryService",
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
        /** @var CategoryService $categoryService */
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            return $this->sendErrorWithData(['Category Service not found']);
        }

        $this->categoryServiceRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Category Service deleted successfully');
    }
}
