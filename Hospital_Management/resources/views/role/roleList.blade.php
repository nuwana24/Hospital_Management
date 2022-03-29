@extends('layouts.master')

@section('title')
Roles List
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Role </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/createRole" method="POST">
          {{csrf_field()}}
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Role Name:</label>
            <input type="text" class="form-control" name="name" id="recipient-name" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>

      <form id="delete_modal_Form" action="" method="post"> 
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
      <div class="modal-body">
    
      <input type="hidden" id="delete_MainCategory_id">
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
                <h4 class="card-title"> Roles
                <!-- @can('create role')
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal" >ADD</button>
                @endcan   -->
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal" >ADD</button>
              </h4>
              
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="roleListTable" class="table">
                    <thead class=" text-primary">
                      <th>Id</th>
                      <th>Role name</th>
                      @can('update role')
                      <th>Edit</th>
                      @endcan 
                      @can('delete role')
                      <th>Delete</th>
                      @endcan 
                      @can('assign permissions to role')
                      <th>Assign Permissions</th>
                      @endcan
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        
                      <tr>
                        <td>{{++$index}}</td>
                        <td>{{$role -> name}}</td>
                        @can('update role')
                        <td>
                          <a href="editRole/{{$role -> id}}" class="btn btn-primary"> EDIT</a>
                        </td>
                        @endcan 
                        @can('delete role')
                        <td>
                         <a href="#" class="btn btn-danger"> DELETE </a>                          
                        </td>
                        @endcan
                        @can('assign permissions to role')
                        <td>
                         <a href="/editAssigningPermissionToRole/{{$role -> id}}" class="btn btn-success"> Assign Permissions </a>                          
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
    $('#roleListTable').DataTable();

    });

    </script>
@endsection