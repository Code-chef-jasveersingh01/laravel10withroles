<script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

{{-- vendor script --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src={{asset("assets/libs/jquery-toast-plugin-master/src/jquery.toast.js")}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  @if(Session::has('success'))
    console.log('success');
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('alert-success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.success("{{ session('alert-success') }}");
  @endif

  @if(Session::has('alert-error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    console.log("{{ session('alert-error') }}");
    toastr.error("{{ session('alert-error') }}");
  @endif

  @if($errors->any())
        @foreach ($errors->all() as $error)
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        console.log("* {{ $error }}");
        toastr.error("* {{ $error }}");
    @endforeach
  @endif
</script>
<script>
  $(function () {
        $('body').on('click',".mutli-lang",function (e) {
            var lang_field = $(this).attr('data-lang-field');
            var lang_type = $(this).attr('data-lang-type');
            var field_type = $(this).attr('data-field-type');
            if (lang_type == 'en') {
                $("" + field_type + "[name='" + lang_field + "[en]']").show();
                $("" + field_type + "[name='" + lang_field + "[ar]']").hide();
                $(this).parent().children().css("color", "");
                $(this).css("color", "#38b7fe");
            } else if (lang_type == 'ar') {
                $("" + field_type + "[name='" + lang_field + "[en]']").hide();
                $("" + field_type + "[name='" + lang_field + "[ar]']").show();
                $(this).parent().children().css("color", "");
                $(this).css("color", "#38b7fe");
            }
        });
    });
    function importStatus(data)
    {
      var progressBar = $('.progress-bar');
      var progress = $('.progress');
      $.ajax({
        type: "GET",
        url: "",
        data: {"id":data},
        success: function (response) {
          if(response.data.pendingJobs != 0 && (response.data.finishedAt == null || response.data.cancelledAt == null) ){
            let percentComplete = response.data.progress;
            progressBar.css("width",`${percentComplete}%`).attr("aria-valuenow", percentComplete);
            progressBar.html(`${percentComplete}%`);
            importStatus(response.data.id);
          }else{
            progress.hide();
            progressBar.width('0%');
            window.location.reload();
          }
        }
      });
    }

    $('.showNotificationDetails').click(function(){
      let notificationId = $(this).data('notificationid');
      let notificationType = $(this).data('notificationtype');
      console.log("notificationId",notificationId,"notificationType",notificationType, notificationType !== ' RejectDeleteUserRequest');

      if (notificationType != ' RejectDeleteUserRequest') {
        var data = {
        "_token": $('a[name="csrf-token"]').val(),
        "notification_id": notificationId,
        }
        $.ajax({
          type: "POST",
          url: "",
          data: data,
          success: function(response) {
            var tableBody = $('#doctorTable tbody');

            // Clear any existing rows
            tableBody.empty();

            // Iterate over each item in the response data
            response.data.forEach(function(doctor) {
                // Create a new table row
                var newRow = $('<tr>');

                // Append the data to the row
                newRow.append($('<td>').text(doctor.DR_ID));
                newRow.append($('<td>').text(doctor.DEPARTMENTNAME));
                newRow.append($('<td>').text(doctor.full_name));
                newRow.append($('<td>').text(doctor.email || 'N/A')); // If email is null, display 'N/A'

                // Append the row to the table body
                tableBody.append(newRow);
              });
            let hiddenNotificationId  = `<input type="hidden" data-currentid="${notificationId}" id="nid" >`;
            tableBody.append(hiddenNotificationId);

            }
        });
        $('#show-delete-request-details').modal('show')
      }else{
        const message = $(this).data('message');
        const senderName = $(this).data('name');
        $('#RejectDeleteUserRequestBody').append(`<h6>${message} by ${senderName}</h6>`);
        $('#RejectDeleteUserRequest').modal("show");
        $.ajax("", {
          method: 'POST',
          data: {notificationId},
          success(response){
            setInterval(() => {
              window.location.reload();
            }, 5000);
          }
        });
    }});

    $('#requestedDeleteUser').submit(function(event) {
        event.preventDefault();
        let password = $('#super-admin-password').val(); // Get the value of the password input field

        if(password == ''){
            swal('Password Required', {
                icon: 'error',
                timer: 3000,
            });
            return; // Exit the function if password is empty
        }

        let nid = $('#nid').data('currentid');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: {nid:nid,password:password},
            success: function(response) {
              console.log('response',response);
              var icons = response.status == '1' ? 'success' : 'error';
                            swal(response.message, {
                                icon: icons,
                                timer: 3000,
                            }).then((result) => {
                               location.reload(true);
                            });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('body').on('click', '.reject-delete-request', function(e) {
        e.preventDefault();

        let data = {
          'notificationId':$('#nid').data('currentid'),
        }
        $.ajax({
            type: "POST",
            url: "",
            data: data,
            success: function(response) {
                var icons = response.status == '1' ? 'success' : 'error';
                swal(response.message, {
                icon: icons,
                timer: 3000,
                }).then((result) => {
                  console.log(result);
                    // Reload the page after successful deletion
                    window.location.reload();
                });
            }
        });
    });

    $('.close').click(function(){
      $('#show-delete-request-details').modal('hide');
    })





</script>
@yield('script')
@yield('script-bottom')
