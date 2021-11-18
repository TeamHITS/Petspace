@extends('website.layouts.app')
@push('css')
    <style>
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }
    </style>
    @endpush
@section('content')
    <div class="dashboard-main-wrap">

        <div class="main-stage" style="width: 100%;">
            <section class="auth-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-3">
                            <p class="pg-title">Store Setting</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="stage-content-sec dashboard-content-stage">
                <div class="container">
                    <div class="delivery-map-card">
                        <div class="card-top">
                            <div class="card-text">
                                <p class="card-title">Delivery areas & fees</p>
                                <p class="card-sub-title">Select areas you want to serve.</p>
                            </div>
                            <div class="card-btn">
                                {{--<button class="gen-btn">Save</button>--}}
                                <a href="{{route('admin.petspaces.show', $petspace['id'])}}" class="gen-btn cancel-btn">Cancel</a>
                            </div>
                        </div>
                        <div class="map-wrap" style="width: 927px; height: 780px;">
                            <div class="map-input" style="right: 10px; top: 90px;">
                                <div class="map-input-inner">
                                    <img src="{{ url('/public/assets/images/icon-search.png') }}" alt="icon" class="img-fluid">
                                    <input  id="pac-input" style="padding: 0px 11px 0px 35px !important;"
                                            type="text" placeholder="Search for locations">
                                </div>
                            </div>
                            <div class="map-form">
                                <form id="area-form" action="{{URL::to('admin/add-area')}}" method="POST">
                                    <div class="form-head">
                                        <p class="form-title">New Technician</p>
                                    </div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Technician</label>
                                                    <select name="technician_id" id="technician_id" class="gen-input">
                                                        <option value="">Select A Technician</option>
                                                        @foreach($technicians as $tech)
                                                            <option value="{{$tech['id']}}">
                                                                {{$tech['user']['name']}}
                                                            </option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Minimum order</label>
                                                    <input name="min_order" type="text" class="gen-input" placeholder="AED 00" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Delivery fee</label>
                                                    <input name="delivery_fee" type="text" class="gen-input" placeholder="AED 00" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" class="submit" value="Create Area"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="map"></div>
                            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.218933311935!2d55.175033514482315!3d25.094449242020616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6b7968da356d%3A0xb3819e83095b067d!2sAuris%20Inn%20Al%20Muhanna%20Hotel!5e0!3m2!1sen!2s!4v1622040980960!5m2!1sen!2s"--}}
                                    {{--style="border:0;" allowfullscreen="" loading="lazy"></iframe>--}}
                        </div>
                    </div>
                </div>
            </section>
            <section>

            </section>
        </div>
    </div>
@endsection
@push('scripts')
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtE6o_3Gvd8ud0Xt_NJcpAiNPik03Ubuk&callback=initialize&libraries=places,drawing&v=weekly"
            async
    ></script>
    <script>
        function initialize() {
            initAutocomplete();
            initMap();
        }
        var map;
        let infoWindow;
        var polygonArr = [];
        var polygons = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 25.245715365888806, lng: 55.35981726693953 },
                zoom: 8,
            });
            const drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.MARKER,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                        // google.maps.drawing.OverlayType.MARKER,
                        // google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.POLYGON,
                        // google.maps.drawing.OverlayType.POLYLINE,
                        // google.maps.drawing.OverlayType.RECTANGLE,
                    ],
                },
                markerOptions: {
                    icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                },
                circleOptions: {
                    fillColor: "#ffff00",
                    fillOpacity: 1,
                    strokeWeight: 5,
                    clickable: true,
                    editable: true,
                    zIndex: 1,
                },
            });


            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type == 'polygon') {

                    var vertices = event.overlay.getPath();
                    // Iterate over the vertices.
                    let contentString = "";
                    polygonArr = [];
                    for (let i = 0; i < vertices.getLength(); i++) {
                        const xy = vertices.getAt(i);
                        polygonArr.push([xy.lat(), xy.lng()]) ;
                        // contentString += "<br>" + "Coordinate " + i + ":<br>" + xy.lat() + "," + xy.lng();
                    }
                }
            });
            drawingManager.setMap(map);




        }

        function showArrays(event) {
            // Since this polygon has only one path, we can call getPath() to return the
            // MVCArray of LatLngs.
            const polygon = this;
            const vertices = polygon.getPath();
            let contentString =
                "<b>Bermuda Triangle polygon</b><br>" +
                "Clicked location: <br>" +
                event.latLng.lat() +
                "," +
                event.latLng.lng() +
                "<br>";

            // Iterate over the vertices.
            for (let i = 0; i < vertices.getLength(); i++) {
                const xy = vertices.getAt(i);
                contentString +=
                    "<br>" + "Coordinate " + i + ":<br>" + xy.lat() + "," + xy.lng();
            }
            // Replace the info window's content and position.
            infoWindow.setContent(contentString);
            infoWindow.setPosition(event.latLng);
            infoWindow.open(map);
        }

        function initAutocomplete() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 25.245715365888806, lng: 55.35981726693953 },
                zoom: 13,
                mapTypeId: "roadmap",
            });
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

        $('body #area-form').submit(function (e) {
            e.preventDefault();
            if(polygonArr.length !== 0){

                if($('#technician_id').val() != "" && $('#technician_id').val() != "undefined"){
                    var that = $(this);
                    var url = $(this).attr('action');
                    var method = $(this).attr('method');
                    var form_data = new FormData($(this)[0]);
                    form_data.append('polygon', JSON.stringify(polygonArr));
                    ajaxPost(url, form_data, (status, data) => {
                        if (status) {

                            {{--if (data.data.hasOwnProperty('url')) {--}}
                            {{--setTimeout(function () {--}}
                            {{--window.location.href = "{{URL::to('/')}}/" + data.data.url;--}}
                            {{--}, 2000);--}}
                            {{--}--}}
                            location.reload();

                        } else {
                            alert("Unable to add.")
                        }
                    });
                }else{
                    alert("Select technician first")
                }


            }else{
                alert("Create area first")
            }
        });

        var Polygon = new google.maps.Polygon();


        $('#technician_id').on('change', function() {

            $.each(polygons, function( index, value ) {
                value.setMap(null);
            });

            if(this.value != ""){
                var url = "{{url('admin/get-areas').'/'}}"+this.value;
                ajaxGet(url, null, (status, data) => {
                    if (status) {

                        var areas = data.data.areas
                        for(var i = 0 ; i < areas.length; i++){

                            var cordinates = JSON.parse(areas[i].cordinates);
                            var destination = new google.maps.MVCArray();
                            $.each(cordinates, function( index, value ) {
                                destination.push(new google.maps.LatLng(value[0],value[1]))
                            });
                            var id = areas[i].id;
                            var polygonOption = {path: destination,content: id};
                            var Polygon = new google.maps.Polygon(polygonOption);

                            polygons.push(Polygon);
                            Polygon.setMap(map);
                            var obj = {
                                    'id': id
                                };
                            Polygon.objInfo = obj;

                            google.maps.event.addListener(Polygon, 'click', function(event,id) {

                                var delid = this.objInfo.id;

                		 var delurl = "{{url('admin/del-areas').'/'}}"+delid;
                		   var r = confirm("Are you sure you want to delete this area?");
					  if (r == true) {
					    ajaxGet(delurl, null, (status, data) => {
				                     if (status) {
				                        alert("Area deleted successfully");
				                        this.setMap(null);
				                     }
				                });
					  } else {
					    console.log('');
					  }
                                
                            });
                        }
                    } else {
                        alert( "Not Found" );
                    }
                });

            }

        });

    </script>
@endpush

