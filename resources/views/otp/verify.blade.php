<x-layout.front title="Verification Page">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
         
          <div class="card-body">
            <p class="login-box-msg">Enter Your Code</p>
      
            <form action="{{ route ('otp.verify') }}" method="post">
                @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Your Otp" name="code">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>

                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Check</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
        
        </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>


</x-layout.front>