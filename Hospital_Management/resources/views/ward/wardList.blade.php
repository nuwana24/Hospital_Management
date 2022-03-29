@extends('layouts.master')

@section('title')
Ward Table
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Ward </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/createWard" method="POST">
          {{csrf_field()}}
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Ward Name:</label>
            <input type="text" class="form-control" name="name" id="recipient-name" required>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" name="description" id="message-text"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Ward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span area-hidden="true">&times;</span>
        </button>
      </div>

      <form id="delete_modal_Form" action="" method="post"> 
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
      <div class="modal-body">
    
      <input type="hidden" id="delete_Ward_id">
      <h5>Are you sure .? you want to delte this ward</h5>
                                               
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
                <h4 class="card-title"> Ward
                @can('create ward')
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal" >ADD</button> 
                @endcan
              </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTable" class="table">
                    <thead class=" text-primary">
                      <th></th>
                      <th>Ward Code</th>
                      <th>Ward name</th>
                      <th>Description</th>
                      @can('update ward')
                      <th>Edit</th>
                      @endcan 
                      @can('delete ward')
                      <th>Delete</th>
                      @endcan
                    </thead>
                    <tbody>
                        @foreach($wards as $ward)
                        
                      <tr>
                        <input type="hidden" class="wardDelete" value="{{$ward -> id}}">
                        <td>{{++$index}}</td>
                        <td>{{$ward -> ward_code}}</td>
                        <td>{{$ward -> name}}</td>
                        <td>{{$ward  -> description}}</td>
                        @can('update ward')
                        <td>
                          <a href='/editWard/{{$ward -> id}}' class="btn btn-success"> EDIT</a>
                        </td>
                        @endcan
                        @can('delete ward')
                        <td>
                         <a href="javascript:void(0)" class="btn btn-danger deletebtn"> DELETE </a>                          
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

      $wardId = $(this).closest('tr').find('.wardDelete').val();

      $('#delete_Ward_id').val($wardId);

      $('#delete_modal_Form').attr('action','/deleteWard/'+$wardId);

      $('#deleteModalPop').modal('show');

    });
} );
    </script>
@endsection