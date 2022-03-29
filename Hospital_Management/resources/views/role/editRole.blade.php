@extends('layouts.master')

@section('title')
Edit Role Details
@endsection

@section('content')

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Edit Role Details</h4>
              </div>
              <div class="card-body">
               <div class="row">
                   <div class="col-md-6">
                   <form action="/updateRole/{{$role->id}}" method="POST">
                       {{csrf_field()}}
                       {{method_field('PUT')}}
                       <div class="mb-3">

                    <div class="mb-3">
                    <label for="Name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="name" value="{{$role->name}}" required>
                    </div>

                <button type="submit" class="btn btn-success"> Update</button>
                <a href="/getRoles" class="btn btn-danger"> Cancel </a>
                </form>       
                   </div>
               </div>      
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
@endsection