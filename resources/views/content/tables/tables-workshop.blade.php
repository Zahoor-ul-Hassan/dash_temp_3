@extends('layouts/contentNavbarLayout')

@section('title', 'Workshops ')

@section('content')

<style>
.ed{
  padding-right:"20px";
}  
</style>


<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Workshops </span> 
</h4>
<!-- MODAL VIEW -->
  <div class="modal modal-top fade" id="modaleview" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTopTitle">View User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><strong class="ed">Name :  </strong> <span id="modal-workshop-name"></span></p>
            <p><strong class="ed">Fee :  </strong><span id="modal-workshop-fee"></span></p>
            <p><strong class="ed">Description :  </strong> <span id="modal-workshop-description"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>


<!-- Register Modal Start -->
<div class="modal modal-top fade" id="modaleadd" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ route('form-layouts-horizontal') }}" method="POST">
      @csrf  
      <div class="modal-header">
        <p class="mb-4">ADD Workshop </p>
      </div>
      <div class="modal-body">            
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
            <select class="form-select" id="teacher" name="teachers[]" aria-label="Default select example" multiple>
            
              @foreach ($teachs as $teach)
                <option value="{{ $teach->id }}">{{ $teach->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="manager" class="form-label col-sm-2 ">Manager</label>
          <div class="col-sm-10">
            <select class="form-select" id="manager" name="managers[]" aria-label="Default select example" multiple>
              @foreach ($manags as $manag)
                <option value="{{ $manag->id }}">{{ $manag->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="students" class="form-label col-sm-2 ">Student</label>
          <div class="col-sm-10">
            <select class="form-select" id="stud" name="students[]" aria-label="Default select example" multiple>
              @foreach ($studs as $stud)
                <option value="{{ $stud->id }}">{{ $stud->name }}</option>
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
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
  </div>
</div>

<!-- Register Modal End -->

<!-- MODAL DELETE -->


<!-- Hoverable Table MANAGER -->
<div class="card">
  <div style="display: flex; align-items: center;  padding: 10px;">
  <h5 class="card-header">Workshops</h5>
  <button class=" btn rounded-pill btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modaleadd" style="margin-left: auto; margin-left: auto; margin-right: 20px;">Add</button>
</div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Fee</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($workshops as $workshop)
        <tr>
          <td>{{ $workshop->name }}</td>
          <td>{{ $workshop->fee }}</td>
          <td>{{ $workshop->description }}</td>
          <td>
            <form class="d-inline-block" action="/tables/workshop/view/{{ $workshop->id }}" method="GET">
              @csrf
              <button type="submit" class="btn rounded-pill btn btn-sm btn-outline-info">View</button>
            </form>
          </td>
        </tr>    
      @endforeach  
    
      </tbody>
    </table>
  </div>
</div>
<!--/ Hoverable Table TEACHER -->

  <!-- scrap work -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var viewButtons = document.querySelectorAll('.view-button');
    viewButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var modal = document.getElementById('modaleview');
        var workshopId = button.getAttribute('data-id');
        var workshopName = button.getAttribute('data-name');
        var workshopFee = button.getAttribute('data-fee');
        var workshopDescription = button.getAttribute('data-description');

        modal.querySelector('#modal-workshop-name').textContent = workshopName;
        modal.querySelector('#modal-workshop-fee').textContent = workshopFee;
        modal.querySelector('#modal-workshop-description').textContent = workshopDescription;
      });
    });
  });
</script>





@endsection 
