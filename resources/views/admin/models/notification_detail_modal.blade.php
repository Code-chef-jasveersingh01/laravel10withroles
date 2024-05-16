
<div class="modal fade" id="show-delete-request-details" tabindex="-1" role="dialog" aria-labelledby="show-delete-request-details" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show-delete-request-details">
                    {{ __('main.delete_requested_users') }}
                    <span class="badge badge-pill badge-info" style="cursor: pointer;" id="reloadUnattachbatteriesTable"> {{__('main.reload')}}</span>
                </h5>
                <button class="btn-close close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form method="POST" id="requestedDeleteUser" action="{{route('admin.requestedDeleteUser')}}">
                @php
                    $role_name = Auth::user()->getRoleNames();
                    $notification_data = checkUnreadNotifications();
                @endphp
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="doctorTable" class="table">
                            <thead>
                                <tr>
                                  <th>{{ __('main.DR_ID') }}</th>
                                  <th>{{ __('main.DEPARTMENT_NAME') }}</th>
                                  <th>{{ __('main.fullname') }} </th>
                                  <th>{{ __('main.email') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="input-group mb-3 ">
                    <input type="password" id="super-admin-password" name="admin_pass" class="form-control" placeholder="{{__('Enter Super Admin Password')}}" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger reject-delete-request" data-nid=""  type="button">{{__('main.reject')}}</button>
                    <button class="btn btn-primary" type="submit">{{__('main.delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

