<div id="lateCheckout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">Payment</h4>
      </div>
      <div class="modal-body">
        <form action="{{URL::to('admin/make_latepayment')}}" id="payWithCardLate" method="POST">
          @csrf
           @if(count($usercards) > 0)
           <div class="row">
              <div class="col-sm-6">
                <!-- usercards -->
                  <div class="radio">
                    <label>
                    <input type="radio" name="payment" value="oldcard" id="oldcard">
                      <strong>Pay with Existing card</strong> 
                    </label>
                  </div> 
              </div>
              <div class="col-sm-6 d-none existingcards">
                <select id="card" class="form-control" name="user_cards">
                  <?php foreach($usercards as $ucard){ ?>
                  <option value="{{$ucard['ref']}}">{{$ucard['first_digits'] .'***'. $ucard['last_digits']}}</option>

                <?php } ?>
                </select> 
              </div>
          </div>
          @endif
          <div class="row">
            <div class="form-group">
              <div class="col-sm-6 finalform">  
                  <input type="hidden" name="order_id" value="{{$order->id}}" id="payment_order_id">
                  <div class="radio">
                  <label>
                    <input type="radio" name="payment" checked value="newcard" id="newcard">
                    <strong>Pay with New card</strong> </label>
                  </div> 
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="pay_with_card_late" class="btn btn-primary">Pay</button>
      </div>
    </div>
  </div>
</div>