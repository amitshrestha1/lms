
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reason</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')" >&times;</button>
      </div>
      <form action="{{route('leave.reject')}}" method="POST">
      <!-- Modal body -->
      @csrf
      <div class="modal-body">
        <input type="hidden" name="id" id="reject_modal_id">
       
        <textarea name="rejectreason" id="" cols="45" rows="10"></textarea>
      
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary text-white" data-dismiss="modal" onclick="$('#myModal').modal('hide')">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#myModal').modal('hide')">Close</button>
      </div>
    </form>
      
    </div>
  </div>
</div>