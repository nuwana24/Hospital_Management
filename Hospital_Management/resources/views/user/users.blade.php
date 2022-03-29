@extends('layouts.master')

@section('title')
Users Table
@endsection

@section('content')




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new User </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/createUser" method="POST">
          {{csrf_field()}}
          <div class="mb-3">
            <label for="UserName" class="col-form-label">User Name:</label>
            <input type="text" class="form-control" name="name" id="recipient-name" required>
          </div>
          <div class="mb-3">
            <label for="Email" class="col-form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="recipient-name" required>
          </div>
          <div class="mb-3">
            <label for="Password" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="recipient-name" required minlength=8>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">SAVE</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModalPop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>

      <form id="delete_modal_Form" action="" method="post"> 
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
      <div class="modal-body">
    
      <input type="hidden" id="delete_user_id">
      <h5>Are you sure .? you want to delte this data</h5>
                                               
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Yes. Delete It</button>
      </div>
    </form>
    </div>
  </div>
</div>


     <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Registered Users
                @can('create user')
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal" >ADD USER</button>
                @endcan  
              </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTable" class="table">
                    <thead class=" text-primary">
                      <th></th>
                      <th>Name</th>
                      <th>Email address</th>
                      @can('update user')
                      <th>EDIT</th>
                      @endcan
                      @can('delete user')
                      <th>DELETE</th>
                      @endcan
                      @can('assign roles to users')
                      <th>ASSIGN ROLES</th>
                      @endcan
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                      <tr>
                      <input type="hidden" class="userDelete" value="{{$user->id}}">
                        <td>{{++$index}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @can('update user')
                        <td>
                          <a href='/editUser/{{$user->id}}' class="btn btn-success"> EDIT</a>
                        </td>
                        @endcan
                        @can('delete user')
                        <td>
                        <a href="javascript:void(0)" class="btn btn-danger deletebtn"> DELETE </a>                          
                        </td>
                        @endcan
                        @can('assign roles to users')
                        <td>
                        <a href="/editAssigningRolesToUser/{{$user->id}}" class="btn btn-default"> ASSIGN ROLES </a>                          
                        </td>
                        @endcan
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
<script>

 $(document).ready( function () {
   
    $('#dataTable').DataTable();
    $('#dataTable').on('click','.deletebtn',function () {

      $userId = $(this).closest('tr').find('.userDelete').val();

      $('#delete_user_id').val($userId);

      $('#delete_modal_Form').attr('action','/deleteUser/'+$userId);

      $('#deleteModalPop').modal('show');

    });
        });
</script>


@endsection


