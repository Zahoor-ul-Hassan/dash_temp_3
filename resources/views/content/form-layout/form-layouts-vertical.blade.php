@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<!-- Student Registration PAGE -->
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> STUDENT REGISTRATION</h4>

 
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Student Registration</h5> <small class="text-muted float-end"></small>
      </div>
      <div class="card-body">
        <form id="form-student" class="mb-3" action="{{url('/form/layouts-vertical')}}" method="post">
        @csrf
        @method('post') 
          <div class="mb-3">
            <label for="formFile" class="form-label">Picture "Choose a pic"</label>
            <input class="form-control" type="file" id="picture" name="picture">
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="your name" />
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-default-email">Email</label>
            <div class="input-group input-group-merge">
              <input type="text" id="email" name="email" class="form-control" placeholder="abc@example.com" aria-label="john.doe" aria-describedby="basic-default-email2" />
              <span class="input-group-text" id="basic-default-email2"></span>
            </div>
            <div class="form-text"> You can use letters, numbers & periods </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-phone">Phone No</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control phone-mask" placeholder="0123 1234567" />
          </div>
          <div class="mb-3">
            <!-- <label class="form-label" for="basic-default-company">Fee</label> -->
            <input hidden type="text" class="form-control" id="fee" name="fee" placeholder="fee paid" />
          </div>
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div> 

@endsection
