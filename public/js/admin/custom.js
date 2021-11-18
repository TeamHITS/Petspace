function confirmDelete(form) {
    console.log(form);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            $(form).submit();
        }
    });
}

function formatFaIcon(state) {
    if (!state.id) return state.text; // optgroup
    return "<i class='fa fa-" + state.id + "'></i> " + state.text;
}

function defaultFormat(state) {
    return state.text;
}

$(function () {
    $('input:checkbox, input:radio').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    /* $('.select2').each(function () {
         var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
         $(this).select2({
             theme: "bootstrap",
             templateResult: window[format],
             templateSelection: window[format],
             escapeMarkup: function (m) {
                 return m;
             }
         });
     });*/

    $('input:checkbox.checkall').on('ifToggled', function (event) {
        var newState = $(this).is(":checked") ? 'check' : 'uncheck';
        var css = $(this).data('check');
        $('input:checkbox.' + css).iCheck(newState);
    });

    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();

    $('.select2').css('width', '100%');

    // dependent select 2
    $.fn.customLoad = function () {
        //Timepicker
        // $('.timepicker').timepicker({
        //     showInputs: false,
        //     containerClass: 'bootstrap-timepicker',
        //     timeFormat: 'HH:mm:ss p'
        // });

        $('.select2').each(function () {
            var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
            var thisSelectElement = this;
            var options = {
                theme: "bootstrap",
                templateResult: window[format],
                templateSelection: window[format],
                escapeMarkup: function (m) {
                    return m;
                }
            };

            if ($(thisSelectElement).data('url')) {
                var depends;
                if ($(thisSelectElement).data('depends')) {
                    depends = $('[name=' + $(thisSelectElement).data('depends') + ']');
                    depends.on('change', function () {
                        $(thisSelectElement).val(null).trigger('change')
                        // $(thisSelectElement).trigger('change');
                    });
                }
                var url = $(thisSelectElement).data('url');

                options.ajax = {
                    url: url,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term,
                            locale: 'en',
                            depends: $('option:selected', depends).val()
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (obj, id) {
                                return {id: obj.id, text: obj.name};
                            })
                        };
                    }

                }
            }

            var tabindex = $(thisSelectElement).attr('tabindex');

            $(thisSelectElement).select2(options);

            $(thisSelectElement).attr('tabindex', tabindex);
            $(thisSelectElement).on(
                'select2:select', (
                    function () {
                        $(this).focus();
                    }
                )
            );
        });
    };

    $(document).customLoad();

    $(document).on('click', '.btn-up-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.prev('tr');

        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');

            // Handle UI
            trPrev.before(tr.clone());
            tr.remove();

            // Init Ajax to send sort values.
            var result = swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token);

            if (result) {
                // Update chanel position - UI
                $('input.inputSort', tr).val('');
                $('input.inputSort', tr).val(prevRowPos);

                $('input.inputSort', trPrev).val('');
                $('input.inputSort', trPrev).val(RowPos);
            }
        }
    });

    $(document).on('click', '.btn-down-ajax', function () {

        var url = $(this).data('url');
        var token = $(this).data('token');
        var tr = $(this).parents('tr');
        var trPrev = tr.next('tr');
        if (trPrev.length != 0) {
            var prevRowPos = $('input.inputSort', trPrev).val();
            var prevRowId = $('input.inputSort', trPrev).data('id');
            var rowPos = $('input.inputSort', tr).val();
            var rowId = $('input.inputSort', tr).data('id');


            // Init Ajax to send sort values.
            swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, function (response) {
                var result = response.data.msg;
                if (result) {
                    // Update chanel position - UI
                    $('input.inputSort', tr).val(prevRowPos);
                    $('input.inputSort', trPrev).val(rowPos);

                    // Handle UI
                    tr.next('tr').after(tr.clone());
                    tr.remove();
                }
            });

        }
    });
});

function swappingRequest(prevRowPos, prevRowId, rowPos, rowId, url, token, cb) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token
        }
    });
    $.ajax({
        method: "PUT",
        url: url,
        type: "JSON",
        async: false,
        data: {
            rowId: rowId,
            rowPosition: rowPos,
            prevRowId: prevRowId,
            prevRowPosition: prevRowPos
        },
        success: cb
    });
}


    function addToCart(d){
        

       
        var id = d.getAttribute("data-id");


        /*var newServicesArray = [];

        */

            var orderid = $('#orderid').val();
            var user_id = $('#user_id').val();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                method: "GET",
                url: 'https://petspace.app/admin/get_order_services_addon/'+user_id+'/'+id,
                type: "JSON",
                async: false,
                success: function(data) {
                    if(data.code ==1){
                         $('#accordion2').html(data.html);
                         $('#order_id').val(orderid);
                         $('#GSCCModal').modal('show');

                    } else {
                        console.log('AJAX call was unsuccessful!');
                    }
                  }
            });
    }

    $(document).on("change", "#Small, #Medium, #Large", function(){
        if ($("#Small").is(":checked") || $("#Medium").is(":checked") || $("#Large").is(":checked")) {
                $('.panel-body').removeClass('d-none');
                $('.subhead').removeClass('d-none');
        } //
        var petsize_price = 0;
        var petsize_id = 0;
        var petsize_duration = 0;
        if($("#Small").is(":checked")) {
            petsize_price = $('#Small').data('price');
            petsize_id = $('#Small').data('id');
            petsize_duration = $('#Small').data('duration');
        } else if($("#Medium").is(":checked")) {
            petsize_price = $('#Medium').data('price');
            petsize_id = $('#Medium').data('id');
            petsize_duration = $('#Medium').data('duration');
        } else {
            petsize_price = $('#Large').data('price');
            petsize_id = $('#Large').data('id');
            petsize_duration = $('#Large').data('duration');
        }

        $('#petsize_price').val(petsize_price);
        $('#submenu_service_price').val(petsize_price);
        $('#submenu_sevice_id').val(petsize_id);
        $('#submenu_service_duration').val(petsize_duration);
        var sub_total = $('#sub_total').val();
        $('#cart_subtotal').val(sub_total);
        

    });

    $(document).on("click", "#submit_service_addon", function(){

        var petid = $("input[name='petid']:checked").val();
        var petsize = $("input[name='petsize']:checked").val();
        if(!petsize){
            swal({
              icon: 'error',
              title: 'Oops...',
              text: 'Please select your pet size!'
            });
        }
        if(!petid){
            swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Please select pet!'
                });
            return false;
        }

        if(petsize && petid) {
           //$('#servaddon').submit();
            var $form = $("#servaddon");
            var data = getFormData($form);
            var delivery_fee = $('#delivery_fee').val();
            var spname = data.service_name;
            var price = data.service_price;
            var service_id = data.service_id;
            var petsize = data.petsize;
            var petsize_price = data.petsize_price;
            var petid = data.petid;
            var service_duration = data.service_duration;
            var submenu_service_duration = data.submenu_service_duration;
            var submenu_service_price = data.submenu_service_price;
            var submenu_sevice_id = data.submenu_sevice_id;
            var order_id = data.order_id;

            var addons = data.addons;
            var addonHtml = '';

            var accumulative_price = parseFloat(price) + parseFloat(petsize_price);
            if(addons!="" && addons!=undefined){
                
                var new_addons = $("input[name='new_addons[]']")
              .map(function(){
                    return $(this).val();
                }).get();
                
                for(var i=0; i<addons.length; i++){

                    addonname = $('#addon_'+addons[i]).data('name');
                    addonprice = $('#addon_'+addons[i]).data('price');
                    addonHtml += '<div id="'+addons[i]+addonprice+'" class="row">\
                        <div class="col-xs-4">\
                            <h4 class="product-name"><strong>'+addonname+'</strong></h4>\
                        </div>\
                        <div class="col-xs-6 text-right">\
                                <h6><strong>'+addonprice+'</strong></h6>\
                        </div>\
                    </div>';

                    accumulative_price+= parseFloat(addonprice);



                    new_addons.push(addons[i]);

                }

               //$('#new_addons').val(new_addons);
            }

            var cartHtml = '<div id="'+service_id+price+'">\
                            <div class="row">\
                                <div class="col-xs-4">\
                                    <h4 class="product-name"><strong>'+spname+'</strong></h4>\
                                </div>\
                                <div class="col-xs-8">\
                                    <div class="col-xs-6 text-right">\
                                        <h6><strong>'+price+'</strong></h6>\
                                    </div>\
                                    <div class="col-xs-2">\
                                        <button type="button" onclick="removeme('+service_id+price+','+accumulative_price+','+service_id+',1,2)" class="btn btn-link btn-xs">\
                                            <span class="glyphicon glyphicon-trash"> </span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                             <div class="row" id="'+petid+petsize_price+'">\
                                <div class="col-xs-4">\
                                    <h4 class="product-name"><strong>'+petsize+'</strong></h4>\
                                </div>\
                                <div class="col-xs-6 text-right">\
                                        <h6><strong>'+petsize_price+'</strong></h6>\
                                </div>\
                            </div>\
                            '+addonHtml+'\
                        </div><hr>';
            var serviceObj = {
                service_price  : price,
                service_id     : service_id,
                service_duration : service_duration,
                petid          : petid,
                petsize        : petsize,
                order_id       : order_id,
                submenu_service_price : submenu_service_price,
                submenu_service_duration : submenu_service_duration,
                submenu_sevice_id  : submenu_sevice_id,
                addons             : new_addons
              
            }
             var ip = $('<input>').attr({
                    type: 'hidden',
                    name: 'services[]',
                    id: service_id+price+'_del',
                   value: JSON.stringify(serviceObj)
                })
                $(ip).appendTo('.finalform');

            /*var new_pets = $("input[name='new_pets[]']")
              .map(function(){
                    return $(this).val();
                }).get();

            new_pets.push(petid);

            $('#new_pets').val(new_pets);*/
            

           /* var new_services = $("input[name='new_services[]']")
              .map(function(){
                    return $(this).val();
                }).get();

            new_services.push(service_id);*/

            //$('#new_services').val(new_services);



            $('.dynamic-order').append(cartHtml);

            var total_amount = $('#total_amount').val();
            var total_tax = $('#total_tax').val();
            var sub_total = $('#sub_total').val();

            var netamnt = parseFloat(sub_total) + parseFloat(accumulative_price);

            var floatamnt = parseFloat(netamnt);
            $('#sub_total').val(floatamnt);
            $('#grosstotal').val(floatamnt);
            var taxcalculation = (floatamnt*5/100).toFixed(2);

            $('#vat').html('AED ' +taxcalculation);
             var final_amnt = parseFloat(taxcalculation) + parseFloat(netamnt)+ parseFloat(delivery_fee); 
                $('#net_amnt').val(netamnt);

            $('.tamnt').html('AED '+final_amnt);

            if(final_amnt!=total_amount){
                $('#checkbtn').removeAttr('disabled');
            }
            
            $('#finalamount').val(final_amnt);
            $('#grosstotal').val(floatamnt);
            $('#finaltax').val(taxcalculation);


             $('#GSCCModal').modal('hide');
        }
    });    

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            if(n['name'].endsWith('[]')){
                var name = n['name'];
                name = name.substring(0, name.length - 2);
                if (!(name in indexed_array)) {
                    indexed_array[name] = [];
                }
                indexed_array[name].push(n['value']);
            } else {
                indexed_array[n['name']] = n['value'];
            }
        });

        return indexed_array;
    }
    $('input').on('ifClicked', function (event) {
        var value = $(this).val();
        if(value == 'oldcard') {
            $('.existingcards').removeClass('d-none');
        } else {
            $('.existingcards').removeClass('d-none').addClass('d-none');
        }
    });   

    $(document).on("click", "#pay_with_card", function(){
        var orderid = $('#orderid').val();
        $('#payment_order_id').val(orderid);
        $('#payWithCard').submit();
    });

    $(document).on("click", "#pay_with_card_late", function(){
    
        $('#payWithCardLate').submit();
    });

    $(document).on("click", "#late_payment", function(event){
        var orderid = $(this).data('id');
        $('#payment_order_id').val(orderid);
        $('#lateCheckout').modal('show');
    });
    $(document).on("click", "#confirm_payment", function(event){
        var orderid = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: 'https://petspace.app/admin/confirm_payment',
                type: "JSON",
                async: false,
                data: {
                    orderid : orderid,
                },
                success: function(data) {
                   if(data.code == 2) {
                    swal({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Authorized',
                      showConfirmButton: false,
                      timer: 1500
                    });
                   } else {
                        swal({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Not Authorized!'
                        });
                   }
                    
                  }
            });
    });

    $(document).on("click", "#viewOrderDetails", function(event){
        var orderid = $(this).data('id');
        $('#ordersetails').modal('show');
    });

    function removeme(deleteindex, price, id, type, ptype) {
        

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function (willDelete) {
            if (willDelete) {
                $("#" + deleteindex).remove();
                var sub_total = $('#sub_total').val();

                var grossprice = parseFloat(sub_total) - parseFloat(price);
                var taxcalculation = (grossprice*5/100).toFixed(2);
                
                $('#vat').html('AED ' +taxcalculation);
                        var delivery_fee = $('#delivery_fee').val();

                var final_amnt = parseFloat(taxcalculation) + parseFloat(grossprice) + parseFloat(delivery_fee); 
                
                $('#sub_total').val(grossprice);
                
                var orderid = $('#orderid').val();
                var delivery_fee = $('#delivery_fee').val();

                $('.tamnt').html('AED '+final_amnt);
                var total_amount = $('#total_amount').val();

                 $('#finalamount').val(final_amnt);
                 $('#grosstotal').val(grossprice);
                 $('#finaltax').val(taxcalculation);

                if(final_amnt!=total_amount){
                    $('#checkbtn').removeAttr('disabled');
                }
                deleted_array = [];

                var deleted_items_array = $("input[name='deleted_items[]']")
              .map(function(){
                    return $(this).val();
                }).get();

                if(ptype == 1) {

                    var serviceDelObj = {id : id,type : type};

                    var delip = $('<input>').attr({
                        type: 'hidden',
                        name: 'deleted_items[]',
                       value: JSON.stringify(serviceDelObj)
                    });
                    $(delip).appendTo('.finalform');


                }

                var delId = deleteindex+'_del';
                $('#'+delId).remove();

                if(grossprice <= 0){
                    $("#checkbtn"). prop('disabled', true); 
                    swal({
                          icon: 'warning',
                          title: 'Oops...',
                          text: 'Kindly add some items in the cart!'
                        });
                }
                /*$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: 'https://petspace.app/admin/remove_order_services_addon',
                        type: "JSON",
                        async: false,
                        data: {
                            id: id,
                            type: type,
                            price: price,
                            sub_total : sub_total,
                            orderid : orderid,
                            delivery_fee : delivery_fee
                        },
                        success: function(data) {
                            if(data.code ==1){
                                $("#" + deleteindex).remove();
                                location.reload();
                               console.log('AJAX call was successful!');
                            } else {
                                console.log('AJAX call was unsuccessful!');
                            }
                          }
                    });*/
            }
        });
    }
    $(document).on('click', '#checkbtn', function () {
        var min_order = $('#min_order').val();
        var sub_total = $('#sub_total').val();
        if(sub_total < min_order){
            swal({
              icon: 'warning',
              title: 'Oops...',
              text: 'Minimum order value is AED '+min_order+' Kindly add more items in the cart!'
            });
        } else {
            $('#GSCCModalCheckout').modal('show');
        }
    });
    