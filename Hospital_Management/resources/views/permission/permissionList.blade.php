@extends('layouts.master')

@section('title')
Permissions List
@endsection

@section('content')


 <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h4 class="card-title"> All Permissions
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal" >ADD</button>
                </h4>
              
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="permissionListTable" class="table">
                    <thead class=" text-primary">
                      <th>Id</th>
                      <th>Permission name</th>
                    </thead>
                    <tbody>
                        @foreach($allPermissions as $permission)
                        
                      <tr>
                        <td>{{++$index}}</td>
                        <td>{{$permission -> name}}</td>
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
    $('#permissionListTable').DataTable();

    });

    </script>
@endsection