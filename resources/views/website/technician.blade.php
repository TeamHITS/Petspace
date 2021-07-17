@extends('website.layouts.app')
@section('content')

    <div class="dashboard-main-wrap">
        @include('website.layouts.side-bar')
        <div class="main-stage">
            @include('website.layouts.main-header')

                <?php if(!empty($technicians)){?>
            <section class="stage-content-sec technician-sec-2">
                    <div class="container">
                        <div class="technician-list-wrap">
                            <div class="technnician-list-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-status-tab" data-bs-toggle="tab"
                                                data-bs-target="#all-status" type="button" role="tab"
                                                aria-controls="all-status" aria-selected="true">All Status
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="on-delivery-tab" data-bs-toggle="tab"
                                                data-bs-target="#on-delivery" type="button" role="tab"
                                                aria-controls="on-delivery" aria-selected="false">On Delivey
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="in-active-tab" data-bs-toggle="tab"
                                                data-bs-target="#in-active" type="button" role="tab"
                                                aria-controls="in-active" aria-selected="false">Inactive
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="available-tab" data-bs-toggle="tab"
                                                data-bs-target="#available" type="button" role="tab"
                                                aria-controls="available" aria-selected="false">Available
                                        </button>
                                    </li>
                                </ul>
                                <button class="gen-btn btn-add-technician">New Technician</button>
                            </div>
                            <div class="technician-tables-wrap">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="all-status" role="tabpanel"
                                         aria-labelledby="all-status-tab">
                                        <div class="table-box">
                                            <div class="table-responsive">
                                                <table class="table gen-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">NAME</th>
                                                        <th scope="col">MOBILE NUMBER</th>
                                                        <th scope="col">EMAIL</th>
                                                        <th scope="col">STATUS</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($technicians))
                                                        @foreach ($technicians as $technician)

                                                            <tr class="edit-technician-modal" data-id="{{$technician['user_id']}}">
                                                            <td>{{$technician['user']['name']}}</td>
                                                            <td>{{$technician['user']['details']['phone']}}</td>
                                                            <td>{{$technician['user']['email']}}</td>
                                                            <td><span class="pill {{$technician['status_color']}}">{{$technician['status_text']}}</span></td>
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                        <tr >
                                                            <td colspan="5" style="text-align: center;">No Record Found</td>
                                                        </tr>
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="on-delivery" role="tabpanel"
                                         aria-labelledby="on-delivery-tab">
                                        <div class="table-box">
                                            <div class="table-responsive">
                                                <table class="table gen-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">NAME</th>
                                                        <th scope="col">MOBILE NUMBER</th>
                                                        <th scope="col">EMAIL</th>
                                                        <th scope="col">STATUS</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(!empty($deliveryTechnicians))
                                                        @foreach ($deliveryTechnicians as $technician)
                                                            <tr class="edit-technician-modal" data-id="{{$technician['user_id']}}">
                                                                <td>{{$technician['user']['name']}}</td>
                                                                <td>{{$technician['user']['details']['phone']}}</td>
                                                                <td>{{$technician['user']['email']}}</td>
                                                                <td><span class="pill
{{$technician['status_color']}}">{{$technician['status_text']}}</span></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                            <tr >
                                                                <td colspan="5" style="text-align: center;">No Record Found</td>
                                                            </tr>
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="in-active" role="tabpanel"
                                         aria-labelledby="in-active-tab">
                                        <div class="table-box">
                                            <div class="table-responsive">
                                                <table class="table gen-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">NAME</th>
                                                        <th scope="col">MOBILE NUMBER</th>
                                                        <th scope="col">EMAIL</th>
                                                        <th scope="col">STATUS</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($inactiveTechnicians))
                                                        @foreach ($inactiveTechnicians as $technician)
                                                        <tr class="edit-technician-modal" data-id="{{$technician['user_id']}}">
                                                            <td>{{$technician['user']['name']}}</td>
                                                            <td>{{$technician['user']['details']['phone']}}</td>
                                                            <td>{{$technician['user']['email']}}</td>
                                                            <td><span class="pill {{$technician['status_color']}}">{{$technician['status_text']}}</span></td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr >
                                                            <td colspan="5" style="text-align: center;">No Record Found</td>
                                                        </tr>
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="available" role="tabpanel"
                                         aria-labelledby="available-tab">
                                        <div class="table-box gen-table">
                                            <div class="table-responsive">
                                                <table class="table gen-table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">NAME</th>
                                                        <th scope="col">MOBILE NUMBER</th>
                                                        <th scope="col">EMAIL</th>
                                                        <th scope="col">STATUS</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($availableTechnicians))
                                                        @foreach ($availableTechnicians as $technician)
                                                        <tr class="edit-technician-modal" data-id="{{$technician['user_id']}}">
                                                            <td>{{$technician['user']['name']}}</td>
                                                            <td>{{$technician['user']['details']['phone']}}</td>
                                                            <td>{{$technician['user']['email']}}</td>
                                                            <td><span class="pill {{$technician['status_color']}}">{{$technician['status_text']}}</span></td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr >
                                                            <td colspan="5" style="text-align: center;">No Record Found</td>
                                                        </tr>
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                <?php }else{ ?>
            <section class="stage-content-sec empty-stage technician-sec-2">
                    <div class="container">
                        <div class="gen-text-box mw-490 m-0-auto text-center">
                            <p class="heading">Get started by adding Technicians to your store</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                            <button class="gen-btn btn-add-technician">Add
                                Technician
                            </button>
                        </div>
                    </div>
            </section>
                <?php }?>

        </div>
    </div>


    <!-- ADD TECHNICIAN MODAL -->
    <div class="modal fade gen-modal technician-modal" id="addTechnicianModal" tabindex="-1" aria-hidden="true">
    </div>
    <!-- EDIT TECHNICIAN MODAL -->
    <div class="modal fade gen-modal technician-modal" id="editTechnicianModal" tabindex="-1" aria-hidden="true">
    </div>
    <!-- DELETE TECHNICIAN MODAL -->
    <div class="modal fade gen-modal technician-modal" id="deleteTechnicianModal" tabindex="-1" aria-hidden="true">

    </div>
@endsection
@push('scripts')
    <script>
        //Passenger Modal
        $(".btn-add-technician").click(function () {

            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{URL::to("/add-tech-modal")}}";
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#addTechnicianModal").html(data.data);
                    // cloneRow();
                    $('#addTechnicianModal').modal('show');
                } else {

                    // $('#passenger-added-alert').css('display', 'block');
                    // $('#passenger-added-alert').removeClass('alert-success');
                    // $('#passenger-added-alert').addClass('alert-danger');
                    //var err = [];

                    //$('#passenger-added-alert').html(data.responseJSON.message);
                }
            });
        });

        $(".edit-technician-modal").click(function () {

            var techId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{URL::to("/edit-tech-modal")}}/"+techId;
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#editTechnicianModal").html(data.data);
                    // cloneRow();
                    $('#editTechnicianModal').modal('show');
                } else {

                    // $('#passenger-added-alert').css('display', 'block');
                    // $('#passenger-added-alert').removeClass('alert-success');
                    // $('#passenger-added-alert').addClass('alert-danger');
                    //var err = [];

                    //$('#passenger-added-alert').html(data.responseJSON.message);
                }
            });

        });

        $('body').on('click', '.delete-technician-modal', function() {
            var techId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{URL::to("/delete-tech-modal")}}/"+techId;
            ajaxGet(url, "", (status, data) => {
                if (status) {
                    $('#editTechnicianModal').modal('hide');

                    $("#deleteTechnicianModal").html(data.data);
                    // cloneRow();
                    $('#deleteTechnicianModal').modal('show');
                } else {

                    // $('#passenger-added-alert').css('display', 'block');
                    // $('#passenger-added-alert').removeClass('alert-success');
                    // $('#passenger-added-alert').addClass('alert-danger');
                    //var err = [];

                    //$('#passenger-added-alert').html(data.responseJSON.message);
                }
            });

        });

        function checkfields() {
            var errors = [];
            /*if ($('input[name=age_group]:checked').val() == "") {

                $("#modal_name,#modal_pnr,#modal_service,#modal_membership_type,#modal_card_issuer,#modal_card_number,#modal_phone", $('#reservation-form')).each(function () {
                    if ($(this).val() == "") {
                        errors.push($(this).data('required'));
                    }
                });
                if ($('#modal_card_issuer') == "" || $('#modal_card_issuer') == "") {
                    if ($("#modal_client_id").val() == "") {
                        errors.push($(this).data('required'));
                    }
                }
            } else if ($('input[name=age_group]:checked').val() == "") {

                $("#modal_name,#modal_pnr,#modal_service", $('#reservation-form')).each(function () {
                    if ($(this).val() == "") {
                        errors.push($(this).data('required'));
                    }
                });
            }*/
            return errors;
        }

        /* ajax post form submit */
        $('body').on('submit', '#technician-form', function (e) {
            // $('.alert').css('display', 'none');

            e.preventDefault();
            var that = $(this);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var form_data = new FormData($(this)[0]);
            var error = checkfields();

            if (error.length === 0) {

                ajaxPost(url, form_data, (status, data) => {
                    if (status) {

                        // $('#passenger-added-alert').css('display', 'block');
                        // $('#passenger-added-alert').removeClass('alert-danger');
                        // $('#passenger-added-alert').addClass('alert-success');
                        // $('#passenger-added-alert').html(data.message);
                        $('body #technician-modal').modal('hide');

                        location.reload();
                        // reservation_datatables.row.add([data.data.name, data.data.pnr, data.data.age_group, data.data.service, data.data.phone, data.data.type, data.data.issuer_name, data.data.card_number, '<button type="button" data-id="' + (data.data.index - 1) + '" class="btn passenger-delete"><i class="fas fa-times-circle"></i></button>']);
                        // reservation_datatables.draw();


                    } else {

                        $('#modal-response-alert').css('display', 'block');
                        $('#modal-response-alert').removeClass('d-none');
                        $('#modal-response-alert').removeClass('alert-success');
                        $('#modal-response-alert').addClass('alert-danger');

                        $('#modal-response-alert').html(data.responseJSON.message);

                        $('#modal-response-alert')[0].scrollIntoView({behavior: "smooth"});
                        // $('html,body').animate({
                        //     scrollTop: $("#response-alert").offset().top - 500
                        // }, 'slow');

                    }
                });
            } else {

                $('#modal-response-alert').css('display', 'block');
                $('#modal-response-alert').removeClass('d-none');
                $('#modal-response-alert').removeClass('alert-success');
                $('#modal-response-alert').addClass('alert-danger');
                $('#modal-response-alert').html("");
                $.each(error, function (key, value) {

                    $('#modal-response-alert').append(value + "<br />");
                });

                $('#modal-response-alert')[0].scrollIntoView({behavior: "smooth"});
            }


        });
    </script>
@endpush
