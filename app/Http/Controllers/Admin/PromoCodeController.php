<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PromoCodeDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePromoCodeRequest;
use App\Http\Requests\Admin\UpdatePromoCodeRequest;
use App\Repositories\Admin\PromoCodeRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PromoCodeController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PromoCodeRepository */
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepo)
    {
        $this->promoCodeRepository = $promoCodeRepo;
        $this->ModelName = 'promo-codes';
        $this->BreadCrumbName = 'Promo Codes';
    }

    /**
     * Display a listing of the PromoCode.
     *
     * @param PromoCodeDataTable $promoCodeDataTable
     * @return Response
     */
    public function index(PromoCodeDataTable $promoCodeDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $promoCodeDataTable->render('admin.promo_codes.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PromoCode.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.promo_codes.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PromoCode in storage.
     *
     * @param CreatePromoCodeRequest $request
     *
     * @return Response
     */
    public function store(CreatePromoCodeRequest $request)
    {
        $promoCode = $this->promoCodeRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.promo-codes.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.promo-codes.edit', $promoCode->id));
        } else {
            $redirect_to = redirect(route('admin.promo-codes.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PromoCode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promo-codes.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $promoCode);
        return view('admin.promo_codes.show')->with(['promoCode' => $promoCode, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PromoCode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promo-codes.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $promoCode);
        return view('admin.promo_codes.edit')->with(['promoCode' => $promoCode, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PromoCode in storage.
     *
     * @param  int              $id
     * @param UpdatePromoCodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromoCodeRequest $request)
    {
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promo-codes.index'));
        }

        $promoCode = $this->promoCodeRepository->updateRecord($request, $promoCode);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.promo-codes.create'));
        } else {
            $redirect_to = redirect(route('admin.promo-codes.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PromoCode from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promoCode = $this->promoCodeRepository->findWithoutFail($id);

        if (empty($promoCode)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promo-codes.index'));
        }

        $this->promoCodeRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.promo-codes.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
