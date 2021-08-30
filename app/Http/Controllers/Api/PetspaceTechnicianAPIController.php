<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePetspaceTechnicianAPIRequest;
use App\Http\Requests\Api\UpdatePetspaceTechnicianAPIRequest;
use App\Models\PetspaceTechnician;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;
use Location\Coordinate;
use Location\Polygon;
use DB;
/**
 * Class PetspaceTechnicianController
 * @package App\Http\Controllers\Api
 */

class PetspaceTechnicianAPIController extends AppBaseController
{
    /** @var  PetspaceTechnicianRepository */
    private $petspaceTechnicianRepository;

    public function __construct(PetspaceTechnicianRepository $petspaceTechnicianRepo)
    {
        $this->petspaceTechnicianRepository = $petspaceTechnicianRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/petspace-technicians",
     *      summary="Get a listing of the PetspaceTechnicians.",
     *      tags={"PetspaceTechnician"},
     *      description="Get all PetspaceTechnicians",
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
     *                  @SWG\Items(ref="#/definitions/PetspaceTechnician")
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
        $petspaceTechnicians = $this->petspaceTechnicianRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            //->pushCriteria(new petspaceTechnicianCriteria($request))
            ->all();

        return $this->sendResponse($petspaceTechnicians->toArray(), 'Petspace Technicians retrieved successfully');
    }

    /**
     * @param CreatePetspaceTechnicianAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/petspace-technicians",
     *      summary="Store a newly created PetspaceTechnician in storage",
     *      tags={"PetspaceTechnician"},
     *      description="Store PetspaceTechnician",
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
     *          description="PetspaceTechnician that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PetspaceTechnician")
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
     *                  ref="#/definitions/PetspaceTechnician"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePetspaceTechnicianAPIRequest $request)
    {
        $petspaceTechnicians = $this->petspaceTechnicianRepository->saveRecord($request);

        return $this->sendResponse($petspaceTechnicians->toArray(), 'Petspace Technician saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/petspace-technicians/{id}",
     *      summary="Display the specified PetspaceTechnician",
     *      tags={"PetspaceTechnician"},
     *      description="Get PetspaceTechnician",
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
     *          description="id of PetspaceTechnician",
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
     *                  ref="#/definitions/PetspaceTechnician"
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
        /** @var PetspaceTechnician $petspaceTechnician */
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            return $this->sendErrorWithData(['Petspace Technician not found']);
        }

        return $this->sendResponse($petspaceTechnician->toArray(), 'Petspace Technician retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePetspaceTechnicianAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/petspace-technicians/{id}",
     *      summary="Update the specified PetspaceTechnician in storage",
     *      tags={"PetspaceTechnician"},
     *      description="Update PetspaceTechnician",
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
     *          description="id of PetspaceTechnician",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PetspaceTechnician that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PetspaceTechnician")
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
     *                  ref="#/definitions/PetspaceTechnician"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePetspaceTechnicianAPIRequest $request)
    {
        /** @var PetspaceTechnician $petspaceTechnician */
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            return $this->sendErrorWithData(['Petspace Technician not found']);
        }

        $petspaceTechnician = $this->petspaceTechnicianRepository->updateRecord($request, $petspaceTechnician);

        return $this->sendResponse($petspaceTechnician->toArray(), 'PetspaceTechnician updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/petspace-technicians/{id}",
     *      summary="Remove the specified PetspaceTechnician from storage",
     *      tags={"PetspaceTechnician"},
     *      description="Delete PetspaceTechnician",
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
     *          description="id of PetspaceTechnician",
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
        /** @var PetspaceTechnician $petspaceTechnician */
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            return $this->sendErrorWithData(['Petspace Technician not found']);
        }

        $this->petspaceTechnicianRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Petspace Technician deleted successfully');
    }

    public function getRestrictedTechnicians(Request $request)
    {
        $latitude   = $request->latitude;
        
        $longitude  = $request->longitude;
        $techniciansArray = [];

        $technicians = DB::table('petspace_technicians')
            ->select('petspace_technicians.id', 'users.name')
            ->join('users', 'users.id', '=', 'petspace_technicians.user_id')
            ->where('petspace_technicians.petspace_id', $request->petspace_id)
            ->where('petspace_technicians.status', '!=', 20)
            ->get();
        
        $techarray = $technicians->toArray();
        
        foreach($techarray as $tech) {
            $techniciansArray[] = $tech;
        }
        //dd($techniciansArray);
        $technicians = $this->getGeoFencing($latitude, $longitude, $techniciansArray);
        $message = false;
        if(!empty($technicians)) {
            $message = true;
        }
        return $this->sendResponse($technicians, $message);
    }

    public function getGeoFencing($latitude, $longitude, $technicians)
    {
        $insidePoint = new Coordinate($latitude, $longitude);
        $technicianids = [];
        $min_order = 0;
        $techArray = [];
        foreach($technicians as $tech){

           $techId =  $tech->id;

           $areas = DB::table('technician_areas')
                        ->where('technician_id', '=', $techId)
                        ->get();

           $geofence = new Polygon();

           foreach ($areas as $key => $coord) {
           $coordinates =  json_decode($coord->cordinates, true);
               foreach($coordinates as $coordinate) {
                    $lat = $coordinate[0];
                    $lng = $coordinate[1];
                $geofence->addPoint(new Coordinate($lat,$lng));

               }
                
            if($geofence->contains($insidePoint)){
                //if($coord->min_order > $min_order){
                    //$min_order = $coord->min_order;

                    $technicianids['id'] = $techId;
                    $technicianids['name'] = $tech->name;
                    $technicianids['min_order'] = $coord->min_order;
                    $technicianids['delivery_fee'] = $coord->delivery_fee;
                //}
                    array_push($techArray,$technicianids);

               }
           }
           // array_push($techArray,$technicianids);

        }
        $finalarray = [];
        foreach ($techArray as $key => $value) {
            if($value['min_order'] > $min_order) {
                $min_order = $value['min_order'];
                $finalarray = $techArray[$key];
            }
        }
        return $finalarray;

    }
}
