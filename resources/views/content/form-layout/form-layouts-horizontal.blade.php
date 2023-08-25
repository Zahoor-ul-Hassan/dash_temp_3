@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
<!-- THIS BLADE FILE CONTAINS THE CODE RESPONSIBLE FOR THE WORKSHOP REGISTRATION -->
<h4 class="fw-bold py-3 mb-4">Workshop Registration</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Workshop Details</h5> 
      </div>
      <div class="card-body">
        <form  action="{{ route('form-layouts-horizontal') }}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="workshop name" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-fee">Fee</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fee" name="fee" placeholder="fee for workshop" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="teacher" class="form-label col-sm-2 ">Teacher</label>
              <div class="col-sm-10">
              <select class="form-select" id="teacher" name="teacher_id" aria-label="Default select example">
                <option selected>Teachers</option>
                @foreach ($teachers as $teacher)
                  <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
              </select>
              </div>
          </div>
          <div class="row mb-3">
            <label for="manager" class="form-label col-sm-2 ">Manager</label>
              <div class="col-sm-10">
              <select class="form-select" id="manager" name="manager_id" aria-label="Default select example">
                <option selected>Managers</option>
                @foreach ($managers as $manager)
                  <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
              </select>
              </div>
          </div>
          <div class="row mb-3">
            <label for="students" class="form-label col-sm-2 ">Student</label>
              <div class="col-sm-10">
              <select class="form-select" id="students" name="students[]" aria-label="Default select example" multiple>
                <option selected>Students</option>
                @foreach ($students as $student)
                  <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
              </select>
              </div>
          </div>
          <div class="row mb-3">
            <label for="description" class="form-label col-sm-2">Description</label>
            <div class="col-sm-8">  
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Basic with Icons -->
  
</div>
@endsection
