<div class="modal fade" id="createTagsModal" tabindex="-1" role="dialog" aria-labelledby="createTagsModal"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createTagsModal">
              Delete Users
                <span class="badge badge-pill badge-info" style="cursor: pointer;" id="reloadUnattachbatteriesTable"> {{__('main.reload')}}</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <form method="POST" id="deleteDataUser" action="{{route('admin.userDeleteDate')}}">
          @csrf
          <div class="modal-body">

                <div class="table-responsive">
                  <label class="small mb-1">{{__('main.date')}}</label>
                  <div class="input-group mb-3">
                      <input type="date" name="date" class="form-control" placeholder="{{__('main.name')}}" required>
                  </div>

                  {{-- <label class="small mb-1">{{__('main.dr_id')}}</label>
                  <div class="input-group mb-3">
                      <input type="text" name="dr_id" class="form-control" placeholder="{{__('main.dr_id')}}" required>
                  </div> --}}
                </div>

          </div>
          <div class="modal-footer">
              <button class="btn btn-danger close" type="button" data-dismiss="modal">{{__('main.close')}}</button>
              <button class="btn btn-primary" type="submit">{{__('main.delete')}}</button>
          </div>
        </form>
    </div>
</div>
</div>
