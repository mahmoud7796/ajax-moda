<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajax CRUD Modal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{--jquery and ajax--}}
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    {{--jquery and ajax--}}



    {{--Bootstrab --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{--Bootstrab --}}


    {{--validate jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    {{-- validate jquery --}}
</head>
<body>


<div class="container">
    <div id="msg-succ" style="display: none"  class="mt-5 row mr-2 ml-2">
        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                id="type-error">Registered Successfully</button>
    </div>
<div style="margin-bottom: 60px"></div>
    <table id="userTable" class="table">
        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#addUser">Add New User</button>

        <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>
        @if(isset($users)  && $users->count()>0)
            @foreach($users as $user)
        <tr>
            <td>{{$user-> firstName}}</td>
            <td>{{$user-> middleName}}</td>
            <td>{{$user-> lastName}}</td>
            <td>{{$user-> email}}</td>
            <td>
                <div class="btn-group" role="group"
                     aria-label="Basic example">
                    <button id="getUser" data-id="{{ $user->id }}" class="btn btn-primary" data-toggle="modal" data-target="#editUser">Edit User</button>
                </div>


                <div class="btn-group" role="group"
                     aria-label="Basic example">
                    <a data-id = "{{$user -> id}}" class="delete btn btn-danger" href="">Delete</a>
                </div>

            </td>
        </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


<!-- Modal for create -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" onblur="" name="firstName" class="form-control" id="firstName" placeholder="Enter First Name">
                        <small id="firstName_error" class="form-text text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Middle Name</label>
                        <input type="text" name="middleName" class="form-control" id="middleName" placeholder="Enter Middle Name">
                        <small id="middleName_error" class="form-text text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter Last Name">
                        <small id="lastName_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        <small id="email_error" class="form-text text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <small id="password_error" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Confirm Your Password">
                        <small id="password_confirmation_error" class="form-text text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="save_user" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal for edit -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="mail" id="mail">

                    <div class="form-group">
                        <label for="firstNameEdit">First Name</label>
                        <input type="text" name="firstNameUpdate" class="form-control" id="firstNameEdit" placeholder="Enter First Name">
                        <small id="firstName_edit_error" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="middleNameEdit">Middle Name</label>
                        <input type="text" name="middleNameUpdate" class="form-control" id="middleNameEdit" placeholder="Enter Middle Name">
                        <small id="middleName_edit_error" class="form-text text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="lastNameEdit">Last Name</label>
                        <input type="text" name="lastNameUpdate" class="form-control" id="lastNameEdit" placeholder="Enter Last Name">
                        <small id="lastName_edit_error" class="form-text text-danger"></small>
                    </div>
                    <input type="hidden" id="userIdEdit" name="userIdEdit" value="">
                    <div class="form-group">
                        <label for="emailEdit">Email address</label>
                        <input type="email" name="emailUpdate" class="form-control" id="emailEdit" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        <small id="email_edit_error" class="form-text text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  id="update_user" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<script>

    $(document).on('click', '#save_user', function(e){
        e.preventDefault();
        $('#firstName_error').text('');
        $('#middleName_error').text('');
        $('#lastName_error').text('');
        $('#email_error').text('');
        $('#password_error').text('');
        $('#password_confirmation_error').text('');

        var formData = new FormData($('#userForm')[0]);
        console.log(formData)

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('register.create')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response){
                if(response){
                    var stringEditUser= 'Edit User'
                    var stringDeleteUser= "Delete"
                    var newRow = $('<tr><td>'+response.firstName+'</td><td>'+response.middleName+'</td><td>'+response.lastName+'</td><td>'+response.email+'</td><td><div class="btn-group" role="group" aria-label="Basic example"><button data-id="userId" id="getUser" class="btn btn-primary" data-toggle="modal" data-target="#editUser" >'+stringEditUser+'</button></div><div class="btn-group" role="group" aria-label="Basic example"><button data-id="" id="deleteUser" class="delete btn btn-danger">'+stringDeleteUser+'</button></div></td></tr>')
                    $("#userTable tbody").prepend(newRow)
                    $('#userForm')[0].reset();
                    $('#addUser').modal('hide');
                    $('#msg-succ').show();

                }

            }, error: function (reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val){
                        $("#" + key + "_error").text(val[0]);
                    });
            }
        });
    });



    $('body').on('click', '#getUser', function (event) {
        event.preventDefault();
        var user_id = $(this).data('id');
        console.log(user_id)
        $.get('register-edit/' + user_id, function (data) {
            $('#firstNameEdit').val(data.firstName);
            $('#middleNameEdit').val(data.middleName);
            $('#lastNameEdit').val(data.lastName);
            $('#emailEdit').val(data.email);
            $('#userIdEdit').val(user_id);


        })
    });



    $(document).on('click', '#update_user', function(e){
        e.preventDefault();
        $('#firstName_edit_error').text('');
        $('#middleName_edit_error').text('');
        $('#lastName_edit_error').text('');
        $('#email_edit_errorr').text('');

    //    var formData = new FormData($('#editForm')[0]);
        var firstName = $("#firstNameEdit").val();
        var middleName = $("#middleNameEdit").val();
        var lastName = $("#lastNameEdit").val();
        var email= $("#emailEdit").val();
        var user_id = $("#userIdEdit").val();
        var mail = $("#userIdEdit").val();


        console.log(email)

        console.log(firstName)
        console.log(middleName)
        console.log(user_id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{url('register-update')}}" +'/'+ user_id,
            data: {
                firstName:firstName,
                middleName:middleName,
                lastName:lastName,
                email:email,
                mail:mail,
            },
            cache: false,
            success: function (response){
                if(response){
                    var stringEditUser= 'Edit User'
                    var stringDeleteUser= "Delete"
                    var newRow = $('<tr><td>'+response.firstName+'</td><td>'+response.middleName+'</td><td>'+response.lastName+'</td><td>'+response.email+'</td><td><div class="btn-group" role="group" aria-label="Basic example"><button data-id="userId" id="getUser" class="btn btn-primary" data-toggle="modal" data-target="#editUser" >'+stringEditUser+'</button></div><div class="btn-group" role="group" aria-label="Basic example"><button data-id="" id="deleteUser" class="delete btn btn-danger">'+stringDeleteUser+'</button></div></td></tr>')
                    $("#userTable tbody").prepend(newRow)
                    $('#userForm')[0].reset();
                    $('#editUser').modal('hide');
                    $('#msg-succ').show();
                }

            }, error: function (reject){
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val){
                    $("#" + key + "_edit_error").text(val[0]);
                });
            }
        });
    });
/*
    $(document).ready(function(){
        $('#userForm').validate({
            rules: {
                firstName: {
                    required: true,
                    maxlength: 4,
                }
            },

            messages: {
                username: "Please enter a valid Name."
            }
        });
    });*/

</script>
</body>
</html>
