<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">

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
                @if (session()->has("message"))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session()->get("message") }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
            
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ route('update-doctor') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $doctor->id }}">
                            <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control form-control-lg text-light bg-dark" id="name" name="name" value="{{ $doctor->name }}">
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Phone</label>
                              <input type="text" class="form-control form-control-lg bg-dark text-light" name="phone" id="phone" value="{{ $doctor->phone }}">
                            </div>
                            <div class="mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                                <select name="specialty" id="specialty" class="form-select form-select-lg mb-3 bg-dark text-light" aria-label=".form-select-lg example">
                                    <option selected>{{ $doctor->specialty }}</option>
                                    <option value="skin">Skin</option>
                                    <option value="heart">Heart</option>
                                    <option value="eye">Eye</option>
                                    <option value="nose">Nose</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room" class="form-label">Room No</label>
                                <input type="text" class="form-control form-control-lg bg-dark text-light" name="room" id="room" value="{{ $doctor->room }}">
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control form-control-lg bg-dark text-light" name="image" id="image">
                                <input type="hidden" class="form-control form-control-lg bg-dark text-light" name="oldimage" id="oldimage" value="{{ $doctor->image }}">
                            </div>                            
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                          </form>
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