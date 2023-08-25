@extends('layouts/contentNavbarLayout')

@section('title', ' Workshop-edit')

@section('content')
<style>
.close-button {
    background-color: #f44336; /* Red background color */
    color: white; /* Text color */
    border:30px;
    border-color:black;
    border-radius: 35%; /* Makes the button circular */
    font-size: 11px;
    width: 20px;
    height: 20px;
    cursor: pointer;
    top: 10px;
    right: 10px;
    transition: background-color 0.3s ease;
    gap:15px;
    margin-left:50px;
}

.close-button:hover {
    background-color: #d32f2f; /* Darker red on hover */
}
.afan{
    width:12%;
    
}
.sh{
    display:flex;
    flex-direction:row;

}
.adm{
    margin-left:800px;

}
.adt{
    margin-left:806px;
}
</style>

<div class="modal modal-top fade" id="modalTopManager" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" action="{{url('/tables/workshop/edit/'.$workshop->id)}}" method="POST">
                @csrf
                @method('post') 
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">ADD MANAGER</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <label for="nameSlideTop" class="form-label">Managers</label>
                <select class="form-select" id="manager" name="managers[]" aria-label="Default select example" multiple>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
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
<div class="modal modal-top fade" id="modalTopTeacher" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" action="{{url('/tables/workshop/edit/'.$workshop->id)}}" method="POST">
                @csrf
                @method('post') 
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">ADD TEACHER</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <label for="nameSlideTop" class="form-label">Teachers</label>  
                <select class="form-select" id="teacher" name="teachers[]" aria-label="Default select example" multiple>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
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
            </div>
            <div class="card-body">
                
                <form id="form-workshop" class="mb-3" action="{{url('/tables/workshop/edit/'.$workshop->id)}}" method="post">
                @csrf
                @method('post') 
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$workshop->name}}" />
                </div>
                <div class="mb-3">
                    <div >
                    <label class="form-label" for="basic-default-fullname">Manager</label>
                    <button type="button" class="adm btn rounded-pill btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalTopManager">Add Manager</button>
                    </div>
                    <ul>
                        @foreach ($workshop->manager as $index => $manag)
                            <div class="sh">
                            <li class="afan">
                                {{ $manag->name }}
                            </li>
                            <button class="close-button" id="del-button" data-manager-id="{{ $manag->id }}">x</button>
                            </div>    
                        @endforeach
                    </ul>
                </div>
                
                <div class="mb-3">
                    <div>
                    <label class="form-label" for="basic-default-fullname">Teacher</label>
                    <button type="button" class="adt btn rounded-pill btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalTopTeacher" >Add Teacher</button>
                    </div>
                    <ul>
                        @foreach ($workshop->teacher as $teach)
                        <div class="sh">
                            <li class="afan">
                                {{ $teach->name }}
                            </li>
                            <button class="close-button" id="del-button" data-teacher-id="{{ $teach->id }}">x</button>
                        </div>            
                        @endforeach
                    </ul>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Fee</label>
                    <input type="text" class="form-control" id="fee" name="fee" value="{{$workshop->fee}}" />
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$workshop->description}}" />
                </div>
                
                <input type="hidden" id="removed_manager_ids" name="removed_manager_ids">
                <input type="hidden" id="removed_teacher_ids" name="removed_teacher_ids">

                <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
  </div> 

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const id = {{ $workshop->id }};
    const removedManagerIds = [];
    const removedTeacherIds = [];

    const closeButtons = document.querySelectorAll(".close-button");
    
    closeButtons.forEach(button => {
        button.addEventListener("click", function () {
            const idAttribute = button.getAttribute("data-manager-id") || button.getAttribute("data-teacher-id");
            
            if (idAttribute) {
                const id = parseInt(idAttribute);
                const parentElement = button.parentElement;
                parentElement.remove();
                
                if (button.getAttribute("data-manager-id")) {
                    removedManagerIds.push(id);
                } else if (button.getAttribute("data-teacher-id")) {
                    removedTeacherIds.push(id);
                }
            }
        });
    });

    const form = document.getElementById("form-workshop");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        
        const removedManagersInput = document.getElementById("removed_manager_ids");
        const removedTeachersInput = document.getElementById("removed_teacher_ids");

        removedManagersInput.value = JSON.stringify(removedManagerIds);
        removedTeachersInput.value = JSON.stringify(removedTeacherIds);
        console.log(removedManagerIds);
        
        const formData = new FormData(form);
        $.ajax({
                        url: "/tables/workshop/rem/"+id,
                        method:'post',  
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            window.location.href = "/tables/workshop/view/" + id;
                        },
                        error: function (error) {
                            console.error('Error updating data:', error);
              
                        }
                    });
    });
});
</script>
@endsection
