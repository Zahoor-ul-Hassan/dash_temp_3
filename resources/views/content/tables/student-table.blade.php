@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<style>
    /* Style for the input fields to make them less obvious */
    .form[readonly] {
        background-color:white;
        border: none;
        box-shadow: none;
        padding: 0;
        font-weight: normal;
    }
    .form-group {
      display: table;
    width: 100%;
  }
  .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}

  .form-group label {
    display: table-cell;
    padding-right: 10px;
    
    text-align: left;
    white-space: nowrap;
    width: 95px;
  }

  .form-group input {
    display: table-cell;
    width: 100%;
    box-sizing: border-box;
    margin-top:1px;
    background-color:white;
    border-color:black;
    border: 1px solid;
  }
  .form-group input[readonly]{
    border:none;
  }
  .form-control{
    border:none;
  }
  #point:hover {
  color: #333; 
  cursor: pointer; 
}
 
    
</style>


<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Student</span> 
</h4>
<!-- MODAL VIEW -->
<div class="modal modal-top fade" id="modalview" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">View User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Name: <span id="name"></span></p>
                  <p>Email: <span id="email"></span></p>
                  <p>Role: <span id="role"></span></p>
                  <ul id="workshopList">
                    <li>apple</li>

                  </ul>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save</button>
                  <button id="editButton" type="button" class="btn btn-primary">Button</button>
                </div>
              </form>
            </div>
          </div>


<!-- Register Modal Start -->
<div class="modal modal-top fade" id="modaleaddstudent" tabindex="-1">
            <div class="modal-dialog">
             
            <form id="form-student" class="mb-3 modal-content" action="{{url('/form/layouts-vertical')}}" method="post">
            @csrf
            @method('post') 
          <div class="modal-header">
            <p class="mb-4">Register Student </p>
            </div>
          <div class="modal-body">
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
  <h5 class="card-header">Students</h5>
  <button class=" btn rounded-pill btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modaleaddstudent" style="margin-left: auto; margin-left: auto; margin-right: 20px;">Add</button>
</div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
    <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Fee</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($students as $student)
        <tr>
          <td>{{ $student->name }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->phone_number }}</td>
          <td>{{ $student->fee }}</td>
          <td>
            <button type="button" class="btn rounded-pill btn btn-sm btn-outline-info view-button" data-bs-toggle="modal" data-bs-target="#modalesview" data-id="{{ $student->id }}" data-name="{{ $student->name }}"data-email="{{ $student->email }}" data-role="student" data-number="{{ $student->phone_number }}" data-fee="{{ $student->fee }}" data-is-student="true">View</button>
            <button type="button" class="btn rounded-pill btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modaldelete">Delete</button>        
          </td>
        </tr>    
      @endforeach  
    
      </tbody>
    </table>
  </div>
</div>



  <!-- scrap work -->
  <script>
    const reloadPage = () => {
        window.location.reload(true);
    };

    console.log('Script is running!');
    document.addEventListener('DOMContentLoaded', function () {
        let viewButtons = document.querySelectorAll('.view-button');
        const modal = document.getElementById('modalview');
        let isEditing = false;
        let editButton = document.getElementById('editButton');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const Name = this.getAttribute('data-name');
                const Email = this.getAttribute('data-email');
                const Role = this.getAttribute('data-role');
                const Number = this.getAttribute('data-number');
                const Fee = this.getAttribute('data-fee');
                const isStudent = this.getAttribute('data-is-student');

                const showData = () => {
                    let modalContent = `
                        <form id="editForm" method="post">
                            @csrf
                            @method('post')
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">${Role.toUpperCase()} DETAILS</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name : </label>
                                            <input type="text" class="form-control" id="name" name="name" value="${Name}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control" id="email" name="email" value="${Email}" readonly>
                                        </div>
                `;

                if (isStudent === 'false') {
                    modalContent += `
                                        <div class="form-group">
                                            <label for="role">Role :</label>
                                            <input type="text" class="form-control" id="role" name="role" value="${Role}" readonly>
                                        </div>
                                        <div class="form-group d-none" id="use">
                                            <label for="password">Password :</label>
                                            <input type="text" class="form-control" id="password" name="password" value="**********" readonly>
                                        </div>
                    `;
                } else {
                    modalContent += `
                                        <div class="form-group d-none">
                                            <label for="role">Role :</label>
                                            <input type="text" class="form-control" id="role" name="role" value="${Role}">
                                        </div>
                                        
                    `;
                }

                if (isStudent === 'true') {
                    modalContent += `
                                        <div class="form-group">
                                            <label for="number">Number : </label>
                                            <input type="text" class="form-control" id="number" name="number" value="${Number}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fee">Fee :</label>
                                            <input type="text" class="form-control" id="fee" name="fee" value="${Fee}" readonly>
                                        </div>
                    `;
                }

                modalContent += `
                                        <div class="form-group" id="adrem">
                                          <label for="fee">Workshops :</label>
                                            <ul id="workshopList" class="form-control"> 
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn rounded-pill btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn rounded-pill btn btn-sm btn-outline-primary" id="editButton">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    `;

                    modal.innerHTML = modalContent;
                    $(modal).modal('show');
                    let editButton = document.getElementById('editButton');

                    editButton.addEventListener('click', showEditingForm);

                    // Fetch workshops associated with the manager
                    fetchWorkshops(id);
                };

                const showEditingForm = () => {
                    console.log('Switching to edit mode...');
                    let editButton = document.getElementById('editButton');
                    document.querySelectorAll('input[readonly]').forEach(input => {
                        input.removeAttribute('readonly');
                        const targetId = 'use';
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            targetElement.classList.remove('d-none');
                        }
                    });
                    var adremElement = document.getElementById("adrem");
                    if (adremElement) {
                      adremElement.style.display = "none";
                    }

                    editButton.textContent = 'Save Changes';
                    editButton.removeEventListener('click', showEditingForm);
                    editButton.addEventListener('click', handleFormSubmit);
                    isEditing = true;
                };

                let editButton = document.getElementById('editButton');

                editButton.addEventListener('click', function () {
                    if (isEditing) {
                        handleFormSubmit();
                        isEditing = false;
                    } else {
                        showEditingForm();
                    }
                });

                const handleFormSubmit = () => {
                    const formData = new FormData(document.getElementById('editForm'));

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/tables/basic/" + id,
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log('Data updated successfully!');
                            reloadPage();
                            showData();
                        },
                        error: function (error) {
                            console.error('Error updating data:', error);
                        }
                    });
                };

                const fetchWorkshops = (id) => {
                    const xhr = new XMLHttpRequest();
                    const url = `/tables/workshop/student/api/${id}`; // Use the correct URL
                    xhr.open('GET', url, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            const workshops = response.workshops;
                            let workshopList = '<ul>';
                            workshops.forEach(workshop => {
                                workshopList += `<li id="point" data-id="${workshop.id}">${workshop.name}</li>`;
                            });
                            workshopList += '</ul>';

                            const workshopListContainer = document.getElementById('workshopList');
                            workshopListContainer.innerHTML = workshopList;

                            const workshopItems = document.querySelectorAll('#workshopList li');
                              workshopItems.forEach(item => {
                                item.addEventListener('click', function (event) {
                                  const workshopId = event.target.getAttribute('data-id');
                                  window.location.href = '/tables/workshop/view/' + workshopId;
                });
            });
                          } else {
                            console.error('Error retrieving workshops:', xhr.status);
                        }
                    };

                    xhr.onerror = function () {
                        console.error('Request failed');
                    };

                    xhr.send();
                };

                showData();
            });
        });
    });
</script>

 @endsection 