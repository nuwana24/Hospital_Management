@extends('layouts.master')

@section('title')
Edit User Details
@endsection

@section('content')

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Edit User Details</h4>
              </div>
              <div class="card-body">
               <div class="row">
                   <div class="col-md-6">
                   <form action="/updateUser/{{$userToBeEdit->id}}" method="POST">
                       {{csrf_field()}}
                       {{method_field('PUT')}}
                <div class="mb-3">
                    <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" value="{{$userToBeEdit->name}}" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{$userToBeEdit->email}}" placeholder="Email Address" required>
                </div>

                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" minlength=8>
                </div>

                <button type="submit" class="btn btn-success"> Update</button>
                <a href="/getRegisterdUsers" class="btn btn-danger"> Cancel </a>
                </form>       
                   </div>
               </div>      
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
@endsection