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
    width: 77px;
  }

  .form-group input {
    display: table-cell;
    width: 100%;
    box-sizing: border-box;
    background-color:white;
    border:none;
  }
    
</style>


<h4 class="fw-bold py-3 mb-4">
  <span class="fw-light">Manager </span> 
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
<div class="modal modal-top fade" id="modaleadd" tabindex="-1">
            <div class="modal-dialog">
            
            <form id="formAuthentication" class="mb-3 modal-content" action="{{url('/auth/register-basic')}}" method="post">
            @csrf
            @method('post')  
            <div class="modal-header">
            <p class="mb-4">Register manager </p>
            </div>
            <div class="modal-body">            
              <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your username" autofocus>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                @if($errors->has('email'))
                  <p class=text-danger>{{$errors->first('email') }}</p>
                @endif              
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @if($errors->has('password'))
                    <p class=text-danger>{{$errors->first('password') }}</p>
                  @endif              
                </div>
              </div>
            <div class="mb-3 d-none">
              <label for="role" class="form-label">Role</label>
              <input type="text" class="form-control" value="manager" id="role" name="role" placeholder="teacher or manager" autofocus>
            </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-primary d-grid w-100">
              Sign up
            </button>
            </div>
          </form>
            </div>
          </div>

<!-- Register Modal End -->

<!-- MODAL DELETE -->


<!-- Hoverable Table MANAGER -->
<div class="card">
  <div style="display: flex; align-items: center;  padding: 10px;">
  <h5 class="card-header">Managers</h5>
  <button class=" btn rounded-pill btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modaleadd" style="margin-left: auto; margin-left: auto; margin-right: 20px;">Add</button>
</div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($managers as $manager)
        <tr>
          <td>{{ $manager->name }}</td>
          <td>{{ $manager->email }}</td>
          <td>
          <!-- <div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $manager->id}}"> -->
                    <button type="button" class="btn rounded-pill btn btn-sm btn-outline-info view-button" data-bs-toggle="modal" data-bs-target="#modaleview" data-id="{{ $manager->id }}" data-name="{{ $manager->name }}"data-email="{{ $manager->email }}" data-role="{{ $manager->role }}" data-is-student="false">View</button>
                    <button type="button" class="btn rounded-pill btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modaledelete">Delete</button>
                    <!-- </div> -->
                <!-- </div> -->
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
    
    });
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
                                          <input type="text" class="form-control" id="role" name="role" value="${Role}"  readonly>
                                      </div>
                                      <div class="form-group d-none" id="use" >
                                          <label for="password">Password :</label>
                                          <input type="text" class="form-control" id="password" name="password" value="**********"  readonly>
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
                        headers:{
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      }); 

                      $.ajax({
                        url: "/tables/basic/"+id,
                        method:'post',  
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

                  
                  showData();
              });
          });
      });
  </script>









 @endsection 
