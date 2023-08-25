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
  <!-- <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Student registration</h5>
        <small class="text-muted float-end">student registration for workshop</small>
      </div>
      <div class="card-body">
        <form action="{{url('/form/layouts-vertical')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post') 
        <div class="mb-3">
          <label for="formFile" class="form-label">Picture "Choose a pic"</label>
          <input class="form-control" type="file" id="formFile" name="picture">
        </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="text" name="name" class="form-control" id="basic-icon-default-fullname" placeholder="Your name" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
              <input type="text" name= "email" id="basic-icon-default-email" class="form-control" placeholder="abc@example.com" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
              <span id="basic-icon-default-email2" class="input-group-text"></span>
              @if($errors->has('email'))
                <p class=text-danger>{{$errors->first('email') }}</p>
              @endif  
            </div>
            <div class="form-text"> You can use letters, numbers & periods </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-phone">Phone No</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
              <input type="text" name="phone_number" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="0311-1111111" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Fee</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
              <input type="text" name="fee" id="basic-icon-default-company" class="form-control" placeholder="Fee paid" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2"/>
            </div>
          </div>
           <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Message</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
              <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
            </div>
          </div> 
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div> -->

@endsection
