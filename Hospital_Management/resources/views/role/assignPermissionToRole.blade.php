@extends('layouts.master')

@section('title')
Assign Permissions to Role
@endsection

@section('content')

      <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Assign Permissions to Role
               
                </h4>
                <h6> Role Name :- {{$role -> name}}    </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="changeRolePemissionsTable" class="table">
                    <thead class=" text-primary">
                      <th></th>
                      <th>Permission name</th>
                      <th>Is Assigned ?</th>
                    </thead>
                    <form action="/updateAssigningPermissionToRole/{{$role->id}}" method="POST">
                       {{csrf_field()}}
                       {{method_field('PUT')}}
                    <tbody>
                    @foreach($allPermissions as $permission)
                        
                      <tr>
                        <td>{{++$index}}</td>
                        <td>{{$permission -> name}}</td>
                        <td>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission -> id}}"{{ in_array($permission -> name, $assingedPermissions) ? 'checked' : ''}}>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        
                      </tr>
                      @endforeach
                      
                    </tbody>
                  
                  </table>
                  <button type="submit" class="btn btn-success"> Update</button>
                    <a href="/getRoles" class="btn btn-danger"> Cancel </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
@endsection