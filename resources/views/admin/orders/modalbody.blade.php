<?php foreach($categoryService as $catserv){ ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#{{$catserv->id}}">
          <h4 class="product-name"><strong>{{$catserv['name']}}</strong> <strong style="float:right">AED {{$catserv['price']}}</strong></h4>

          <h5>
            <small>{{$catserv['description']}}</small>
          </h5>
        </a>
      </h4>
      <input type="hidden" name="service_name" value="{{$catserv['name']}}" />
      <input type="hidden" name="service_price" value="{{$catserv['price']}}" />
      <input type="hidden" name="service_id" value="{{$catserv['id']}}" />
      <input type="hidden" name="service_duration" value="{{$catserv['service_duration']}}" />
      
      <input type="hidden" name="cart_subtotal" id="cart_subtotal" value="" />
    </div>
    <div id="{{$catserv->id}}" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php foreach($catserv['submenu'] as $service_submenu){?>
          <div class="panel-heading subhead {{$service_submenu['name']=='Addons' ? 'd-none' : ''}}">{{$service_submenu['name']}}</div>
          <div class="panel-body {{$service_submenu['name']=='Addons' ? 'd-none' : ''}}">
              <?php 
              foreach($service_submenu['service'] as $service){
                              if($service_submenu['name']!='Addons') { ?>
                
                <label class="radio">
                  <input type="radio" name="petsize" value="{{$service['name']}}" data-price="{{$service['price']}}" data-id="{{$service['id']}}" data-duration="{{$service['service_duration']}}" id="{{$service['name']}}">
                <h4 class="product-name">
                  <strong>{{$service['name']}} </strong><strong style="float:right"> AED {{$service['price']}}</strong></h4>
                <h5> <small>{{$service['description']}}</small> </h5>
                </label> 

                <?php } else { ?>
                
                <label class="checkbox">
                  <input type="checkbox" name="addons[]" data-name="{{$service['name']}}" data-price="{{$service['price']}}" value="{{$service['id']}}" id="addon_{{$service['id']}}" />
                  <h4 class="product-name">
                    <strong>{{$service['name']}} </strong><strong style="float:right">AED  {{$service['price']}}</strong></h4>
                  <h5> <small>{{$service['description']}}</small> </h5>
                </label> 

              <?php } 
            } ?>
             
             
          </div>
        <?php } ?>
         <div class="panel-heading subhead"> Select Your Pet </div>

          <div class="panel-body">
             <?php foreach($userpets as $upet){?>
                <label class="radio">
                  <input type="radio" name="petid" value="{{$upet['id']}}" id="{{$upet['id']}}">
                <h4 class="product-name">
                  <strong>{{$upet['name']}} </strong><small style="float:right"> {{$upet['gender'] == 10 ? 'Male' : 'Female'}}</small></h4>
                <h5> <small>Weight {{$upet['weight']}} | Breed {{$upet['breed']}}</small> </h5>
                </label> 
              <?php } ?>
          </div>
      </div>
    </div>
  </div>
<?php } ?>