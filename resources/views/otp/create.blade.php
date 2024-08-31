<x-layout.front title="Otp Page">

        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
             
              <div class="card-body">
                <p class="login-box-msg">Enter Your Number</p>
          
                <form action="{{ route ('otp.create') }}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>

                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Get Otp</button>
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