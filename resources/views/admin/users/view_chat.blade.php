@extends('layouts.admin.layout')
@section('title')
    {{ __('main.view_user')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.view')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
<style>
    .dateClass{
        display: flex !important;
        justify-content: center !important;

    }
    .ctext-wrap {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 10px;
}
     .ctext-wrap-content {
    padding: 12px 20px;
    background-color: var(--vz-card-bg);
    position: relative;
    border-radius: 3px;
    -webkit-box-shadow: 0 5px 10px rgba(30,32,37,.12);
    box-shadow: 0 5px 10px rgba(30,32,37,.12);
}
 .ctext-content {
    word-wrap: break-word;
    word-break: break-word;
}
 .conversation-name {
    font-weight: 500;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
}
</style>
  <div class="row">
    <div id="layout-wrapper">
          <div>
              <div class="container-fluid">
                  <div class="chat-wrapper d-lg-flex gap-1 ">
                      <!-- end chat leftsidebar -->
                      <!-- Start User chat -->
                      <div class="user-chat w-100 overflow-hidden">

                          <div class="chat-content d-lg-flex">
                              <!-- start chat conversation section -->
                              <div class="w-100 overflow-hidden position-relative">
                                  <!-- conversation user -->
                                  <div class="position-relative">



                                      <div class="p-3 user-chat-topbar">
                                          <div class="row align-items-center">
                                              <div class="col-sm-4 col-8">
                                                  <div class="d-flex align-items-center">
                                                      <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                          <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                      </div>
                                                      <div class="flex-grow-1 overflow-hidden">
                                                          <div class="d-flex align-items-center">
                                                              <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                  <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
                                                                  <span class="user-status"></span>
                                                              </div>
                                                              <div class="flex-grow-1 overflow-hidden">
                                                                  <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">{{$user->name}}</a></h5>

                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-8 col-4">
                                                  <ul class="list-inline user-chat-nav text-end mb-0">
                                                      {{-- <li class="list-inline-item m-0">
                                                          <div class="dropdown">
                                                              <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                  <i data-feather="search" class="icon-sm"></i>
                                                              </button>
                                                              <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                  <div class="p-2">
                                                                      <div class="search-box">
                                                                          <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                          <i class="ri-search-2-line search-icon"></i>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </li> --}}

                                                      <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                          <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                              <i data-feather="info" class="icon-sm"></i>
                                                          </button>
                                                      </li>

                                                      {{-- <li class="list-inline-item m-0">
                                                          <div class="dropdown">
                                                              <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                  <i data-feather="more-vertical" class="icon-sm"></i>
                                                              </button>
                                                              <div class="dropdown-menu dropdown-menu-end">
                                                                  <a class="dropdown-item d-block d-lg-none user-profile-show" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i> View Profile</a>
                                                                  <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i> Archive</a>
                                                                  <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i> Muted</a>
                                                                  <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Delete</a>
                                                              </div>
                                                          </div>
                                                      </li> --}}
                                                  </ul>
                                              </div>
                                          </div>

                                      </div>
                                      <!-- end chat user head -->
                                      <div class="position-relative" id="users-chat">
                                          <div class="chat-conversation p-3 p-lg-4 " id="chat-conversation" data-simplebar>
                                              <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                  @foreach($chats as $key=> $chats)
                                                      <div class= "dateClass">
                                                        <a >{{ date('d M Y', strtotime($key))}}</a>
                                                      </div>

                                                      @foreach ($chats as $chat )
                                                          @if($chat['type'] == 1)
                                                                {{-- <li class="chat-list left">
                                                                    <div class="conversation-list">
                                                                      <div class="user-chat-content">
                                                                        <div class="chat-avatar">
                                                                            <img src="assets/images/users/avatar-2.jpg" alt="">
                                                                        </div>
                                                                        <div class="ctext-wrap">
                                                                          <div class="ctext-wrap-content">
                                                                              <p class="mb-0 ctext-content">{{$chat['messages']}}</p>
                                                                          </div>
                                                                      </div>
                                                                    </div>
                                                                      <div class="conversation-name"><small class="text-muted time">{{$chat['time']}}</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                                    </div>
                                                                </li> --}}
                                                                <li class="chat-list left">
                                                                  <div class="chat-avatar">
                                                                    <img src="assets/im ages/users/avatar-2.jpg" alt="">
                                                                </div>
                                                                  <div class="conversation-list">
                                                                      <div class="user-chat-content">
                                                                        <div class="ctext-wrap">
                                                                          <div class="ctext-wrap-content">
                                                                              <p class="mb-0 ctext-content">{{$chat['messages']}}</p>
                                                                          </div>
                                                                      </div>
                                                                      <div class="conversation-name"><small class="text-muted time">{{$chat['time']}}</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                                          {{-- <div class="ctext-wrap">
                                                                              <div class="ctext-wrap-content">
                                                                                  <p class="mb-0 ctext-content">{{$chat['messages']}}</p>
                                                                                  <small>{{$chat['time']}}</small>

                                                                              </div>

                                                                          </div> --}}
                                                                          {{-- <div class="conversation-name"><small class="text-muted time">09:08 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div> --}}
                                                                      </div>
                                                                  </div>
                                                                </li>
                                                          @else
                                                                <li class="chat-list right">
                                                                  <div class="conversation-list">
                                                                      <div class="user-chat-content">
                                                                        <div class="ctext-wrap">
                                                                          <div class="ctext-wrap-content">
                                                                              <p class="mb-0 ctext-content">{{$chat['messages']}}</p>
                                                                          </div>
                                                                      </div>
                                                                      <div class="conversation-name"><small class="text-muted time">{{$chat['time']}}</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                                          {{-- <div class="ctext-wrap">
                                                                              <div class="ctext-wrap-content">
                                                                                  <p class="mb-0 ctext-content">{{$chat['messages']}}</p>
                                                                                  <small>{{$chat['time']}}</small>

                                                                              </div>

                                                                          </div> --}}
                                                                          {{-- <div class="conversation-name"><small class="text-muted time">09:08 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div> --}}
                                                                      </div>
                                                                  </div>
                                                                </li>

                                                          @endif
                                                      @endforeach

                                                  @endforeach

                                              </ul>
                                          </div>
                                      </div>

                                      <!-- end chat-conversation -->

                                      <div class="chat-input-section p-3 p-lg-4">

                                          <form  action="{{route('admin.sendMessage',['uuid'=>$user->id])}}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                              <div class="row g-0 align-items-center">
                                                  <div class="col-auto">
                                                      <div class="chat-input-links me-2">
                                                          <div class="links-list-item">
                                                              <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                                  <i class="bx bx-smile align-middle"></i>
                                                              </button>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="col">
                                                      <div class="chat-input-feedback">
                                                          Please Enter a Message
                                                      </div>
                                                      <input type="text" class="form-control chat-input bg-light border-light" id="chat-input" name="message" placeholder="Type your message..." autocomplete="off" required>
                                                  </div>
                                                  <div class="col-auto">
                                                      <div class="chat-input-links ms-2">
                                                          <div class="links-list-item">
                                                              <button type="submit" class="btn btn-success chat-send waves-effect waves-light">
                                                                  <i class="ri-send-plane-2-fill align-bottom"></i>
                                                              </button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>

                                      <div class="replyCard">
                                          <div class="card mb-0">
                                              <div class="card-body py-3">
                                                  <div class="replymessage-block mb-0 d-flex align-items-start">
                                                      <div class="flex-grow-1">
                                                          <h5 class="conversation-name"></h5>
                                                          <p class="mb-0"></p>
                                                      </div>
                                                      <div class="flex-shrink-0">
                                                          <button type="submit" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                              <i class="bx bx-x align-middle"></i>
                                                          </button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>




                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- end chat-wrapper -->

              </div>
              <!-- container-fluid -->
          </div>
    </div>
  </div>

@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
<script>
    $(document).ready(function() {

        $('body').on("click", ".aggrementFile",function (e) {
          e.preventDefault();
          var href       = $(this).attr('data-url');

          $("#aggrementFileForm").attr("action", href);

          $('#aggrementFile').modal('show');
        });


        $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "id": id,
                }
                $.ajax({
                type: "DELETE",
                url: "{{ route('admin.destroyUser', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.usersList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
