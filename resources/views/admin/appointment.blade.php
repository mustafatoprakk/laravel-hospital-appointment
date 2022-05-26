<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include("admin.css")

  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include("admin.sidebar")

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include("admin.navbar")

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                      @if (session()->has("message"))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session()->get("message") }}
                              <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Doctor Name</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Date</th>
                              <th scope="col">Message</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $count=1; ?>
                              @foreach ($appointments as $appointment)
                                  <tr>
                                    <th scope="row">{{ $count++ }}</th>
                                    <td>
                                        @foreach ($doctors as $doctor)
                                            {{ $appointment->doctor_id == $doctor->id ? $doctor->name : "" }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($users as $user)
                                            {{ $appointment->user_id == $user->id ? $user->name : "" }}
                                        @endforeach
                                    </td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->message }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>
                                        <a href="{{ route("approved", $appointment->id) }}" class="btn btn-primary">Approved</a>
                                        <a href="{{ route('cancel-appointments', $appointment->id) }}" class="btn btn-danger">Cancel</a>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>


        </div>
        
<!-- main-panel ends -->
    </div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
@include("admin.script")
<!-- End custom js for this page -->
</body>
</html>