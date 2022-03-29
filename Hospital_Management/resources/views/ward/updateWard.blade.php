@extends('layouts.master')

@section('title')
Edit Main-Category Details
@endsection

@section('content')

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Edit Main-Category Details</h4>
              </div>
              <div class="card-body">
               <div class="row">
                   <div class="col-md-6">
                   <form action="/updateWard/{{$wardToBeEdit->id}}" method="POST">
                       {{csrf_field()}}
                       {{method_field('PUT')}}

                 <div class="mb-3">
                    <label for="Name" class="form-label">Ward Code Id : </label>
                        <input type="text" class="form-control" name="code" value="{{$wardToBeEdit->ward_code}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Ward Name : </label>
                        <input type="text" class="form-control" name="name" value="{{$wardToBeEdit->name}}" placeholder="Name" required>
                </div>
               
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                     <textarea class="form-control" name="description"id="message-text"> {{$wardToBeEdit->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-success"> Update</button>
                <a href="/getWards" class="btn btn-danger"> Cancel </a>
                </form>       
                   </div>
               </div>      
              </div>
            </div>
          </div>
       
@endsection


@section('scripts')
@endsection