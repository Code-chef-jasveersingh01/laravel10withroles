
<div class="modal fade" id="show-admin-list" tabindex="-1" role="dialog" aria-labelledby="show-admin-list" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content " style="height:200px;">
            <div class="modal-header">
                <h5 class="modal-title" id="show-admin-list">
                    {{ __('main.reviewer_select') }}
                </h5>
                <button class="btn-close close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form method="POST" id="super-admin-id" action="">
                @csrf
                <div class="modal-body">
                  @if(!empty($superAdmins))
                    <select class="form-select super-admin-select"  aria-label="Select to send request">
                      <option value=""> {{ __('main.reviewer_select') }}</option>
                      @foreach ($superAdmins as $admin)
                          <option value="{{ $admin['uuid'] }}">{{ $admin['name'] }}</option>
                      @endforeach
                  </select>
                  @endif
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" id="send-request" type="button">{{__('main.send_request')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

