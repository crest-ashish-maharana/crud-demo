@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<form id="ajaxfrom">
    <div class="row">
        <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
                <span class="text-danger" id="nameError"></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="text-danger" id="emailError"></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="text-danger" id="passwordError"></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                <span class="text-danger" id="confirmPasswordError"></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control" id="roles" multiple>
                    @if(!empty($roles))
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="text-danger" id="rolesError"></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-primary btn-submit">Submit</button>
        </div>

    </div>
</form>

<p class="text-center text-primary"><small>by Ashish Maharana</small></p>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".btn-submit").click(function(e){
        e.preventDefault();   
        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();
        var confirm_password = $("input[name=confirm-password]").val();
        var roles = $("#roles").val();

        $.ajax({
            type:'POST',
            url:"{{ route('users.store') }}",
            data:{name:name, email:email, password:password, confirm_password:confirm_password, roles:roles},
            success:function(response){
                console.log("Response:\n", response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
            error: function(error) {
                console.log("Error:\n", error);
                error.responseJSON.errors.name ? $('#nameError').text(error.responseJSON.errors.name) : $('#nameError').text('')
                error.responseJSON.errors.email ? $('#emailError').text(error.responseJSON.errors.email) : $('#emailError').text('')
                error.responseJSON.errors.password ? $('#passwordError').text(error.responseJSON.errors.password) : $('#passwordError').text('')   
                error.responseJSON.errors.confirm_password ? $('#confirmPasswordError').text(error.responseJSON.errors.confirm_password) : $('#confirmPasswordError').text('')
                error.responseJSON.errors.roles ? $('#rolesError').text(error.responseJSON.errors.roles) : $('#rolesError').text('')
            }
        });
    });
</script>
@endsection