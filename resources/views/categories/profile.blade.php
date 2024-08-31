<x-profile.profile  title="User - Profile">
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <x-flash-message />

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset(Auth::user()->profile_image) }}"
                         alt="User Image">
                  </div>
  
                  <h3 class="profile-username text-center">Nina Mcintire</h3>
  
                  <p class="text-muted text-center">Software Engineer</p>
  
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Login At</b> <a class="float-right"></a>
                    </li>
                    <li class="list-group-item">
                      <b>Created At</b> <a class="float-right">{{ Auth()->user()->created_at->format('d m Y')}}</a>
                    </li>
                    
                  </ul>
  
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- About Me Box -->
             
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
               <div class="card-body">
                <form action="{{ route ('profile.update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                    <div class="form-group">
                        <x-form.input id="first_name" label="First Name" name="first_name" value="{{ $profile->first_name }}" />
                      </div>    
                      <div class="form-group">
                        <x-form.input id="last_name" label="Last Name" name="last_name" value="{{ $profile->last_name }}"/>
                      </div>    
                      <div class="form-group">
                        <x-form.input id="last_name" label="Last Name" name="last_name" value="{{ $profile->last_name }}"/>
                      </div>    
                      <div class="form-group">
                        <label for="inputDescription">Project Description</label>
                        <textarea id="description" class="form-control" name="description" value="{{ $profile->description }}" rows="2"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control custom-select">
                          <option selected disabled>Select one</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                   
                      <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date" id="date" name="birthday" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="form-group">
                      <x-form.input id="salary" label="Salary" name="salary" value="{{ $profile->salary }}" />
                    </div> --}}
                    <div class="form-group">
                      <label for="verified">Gender</label>
                      <select id="verified" name="verified" class="form-control custom-select">
                        <option selected disabled>Select one</option>
                        <option value="1">Verified</option>
                        <option value="0">Non Verified</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <x-form.input type="file" id="image_path" label="Profile's Image" name="image_path"/>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Primary</button>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </form>
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
      <!-- /.content -->
  <script>
$('#reservationdate').datetimepicker({
    format: 'L'
});

</script>


  
  
  
  
</x-profile.profile>