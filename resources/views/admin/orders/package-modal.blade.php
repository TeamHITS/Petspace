<div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">Services and Addons</h4>
      </div>
      <div class="modal-body">
        <form id="servaddon">
          @csrf
          <div class="panel-group" id="accordion2">
            
          </div>
          <input type="hidden" name="order_id" id="order_id" value="" />
          <input type="hidden" name="petsize_price" id="petsize_price" value="" />
          <input type="hidden" name="submenu_sevice_id" id="submenu_sevice_id" value="" />
          <input type="hidden" name="submenu_service_duration" id="submenu_service_duration" value="" />
          <input type="hidden" name="submenu_service_price" id="submenu_service_price" value="" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="submit_service_addon" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>