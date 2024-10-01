@extends('admin.master')
@section('title', 'Status / Edit')
@section('nav')
    @include('admin.nav')
@endsection
@section('page', 'Status / Edit')
@section('main')
    @include('admin.main')

<!-- Tables -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <h6>Status Form</h6>
            <hr class='w-2'>
              <h6 class='mb-1'>Edit Status</h6>
              
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <div class="card border-1 m-3 pt-3">
                        <form action="{{ route('deliveries.update', $statusupdate->id) }}" method="post" id="frmDeliveries">
                            @csrf
                          @method('PUT')
                            <div class="mb-3 ms-3 me-3">
                                <div class="mb-3 ms-3 me-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="Dalam Perjalanan" {{ $statusupdate->status === "Dalam Perjalanan" ? "selected" : "" }}>Dalam Perjalanan</option>
                                        <option value="Belum Dikirim" {{ $statusupdate->status === "Belum Dikirim" ? "selected" : "" }}>Belum Dikirim</option>
                                        <option value="Sudah Sampai" {{ $statusupdate->status === "Sudah Sampai" ? "selected" : "" }}>Sudah Sampai</option>
                                    </select>
                                </div>                                
                                <div class="ms-3 me-3 text-end">
                                <a href="{{ route('deliveries.index') }}" class="btn bg-gradient-danger w-15 my-4 mb-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-success w-15 my-4 mb-2" id="save">Save</button> 
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

<!-- Close Tables -->
      <footer class="footer pt-5 ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
               <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Supriadi's Team</a>
                for a better web.
              </div> 
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script>
      const btnSave = document.getElementById("save");
      const form = document.getElementById("frmDeliveries");
      const status = document.getElementById("status");
  
      function simpan() {
          let emptyFields = [];
  
          if (status.value === "") {
              emptyFields.push("Status");
          }
  
          if (emptyFields.length > 0) {
              const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
              swal("Error", errorMessage, "error");
          } else {
              form.submit();
          }
      }

      form.addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent default form submission
          simpan();
      });
  </script>
@endsection
