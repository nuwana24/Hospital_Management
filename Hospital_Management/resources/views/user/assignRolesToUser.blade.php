@extends('layouts.master')

@section('title')
Assign Roles to User
@endsection

@section('content')

      <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Assign Roles to User
               
                </h4>
                <h6> User Name :- {{$user -> name}}    </h6>         
               
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="changeRolePemissionsTable" class="table">
                    <thead class=" text-primary">
                      <th></th>
                      <th>Role name</th>
                      <th>Is Assigned ?</th>
                    </thead>
                    <form action="/updateAssigningRolesToUser/{{$user->id}}" method="POST">
                       {{csrf_field()}}
                       {{method_field('PUT')}}
                    <tbody>
                    @foreach($allRoles as $role)
                        
                      <tr>
                        <td>{{++$index}}</td>
                        <td>{{$role -> name}}</td>
                        <td>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role -> id}}"{{ in_array($role -> name, $assingedRoles) ? 'checked' : ''}}>
                              <span class="form-check-sign"></span>
                            </label>
                          </div>
                        </td>
                        
                      </tr>
                      @endforeach
                      
                    </tbody>
                  
                  </table>
                  <button type="submit" class="btn btn-success"> Update</button>
                    <a href="/getRegisterdUsers" class="btn btn-danger"> Cancel </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
@endsection