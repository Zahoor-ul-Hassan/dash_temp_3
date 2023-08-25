@extends('layouts/contentNavbarLayout')

@section('title', ' Workshop-view')

@section('content')
<style>
p{
    padding-left:25px;
}
.adm{
    margin-left:800px;
}
</style>

<div class="modal modal-top fade" id="modalTopStudent" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" action="{{url('/tables/workshop/edit/'.$workshop->id)}}" method="POST">
                @csrf
                @method('post') 
                
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">ADD STUDENT</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <label for="nameSlideTop" class="form-label">Students</label>
                <select class="form-select" id="student" name="students[]" aria-label="Default select example" multiple>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
                </select>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div> 

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">EDIT WORKSHOP</h5> <small class="text-muted float-end"></small>
                <form class="d-inline-block" action="/tables/workshop/edit/{{ $workshop->id }}" method="GET">
                    @csrf
                    <button type="submit" class="btn rounded-pill btn btn-outline-success">Edit</button>
                </form>
            </div> 
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Name</label>
                    <p id="fee" name="fee">{{$workshop->name}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Manager</label>
                    <ul>
                        @foreach ($workshop->manager as $manag)
                            <li class="afan">
                                {{ $manag->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Teacher</label>
                    <ul>
                        @foreach ($workshop->teacher as $teach)
                            <li class="afan">
                                {{ $teach->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Fee</label>
                    <p id="fee" name="fee">{{$workshop->fee}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Description</label>
                    <p id="fee" name="description">{{$workshop->description}}</p>
                </div>
                <div class="mb-3">
                <label class="form-label" for="basic-default-company">Students</label>
                <button type="button" class="adm btn rounded-pill btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalTopStudent">Add Student</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($workshop->students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone_number }}</td>
                        </tr>    
                        @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 

@endsection
