@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>

        <div class="pull-right mb-3">
          @can('user-create')
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
          @endcan

        </div>
    </div>
</div>


@if ($message = Session::get('success'))

<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif
<form id="ajaxform">
<span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
  <table class="table table-bordered table-striped" id="table">
    <thead>
      <th>No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Roles</th>
      <th width="280px">Action</th>
    </thead>
    <tbody>
      @foreach ($data as $key => $user)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                <label class="badge bg-success">{{ $v }}</label>
              @endforeach
            @endif
          </td>
      
          <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            @can('user-edit')
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @endcan
            
            @can('user-delete')
              <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
              <button type="button" data-id="{{ $user->id }}" class="btn btn-danger btn-delete">Delete</button>
            @endcan
          </td>
        </tr>
      @endforeach
    </tbody>

  </table>
</form>

{!! $data->render() !!}

<p class="text-center text-primary"><small>by Ashish Maharana</small></p>
<script>
  $(document).ready(function() {
      $('#table').DataTable();
  } );

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".btn-delete").click(function(e){
        if(!confirm("Do you really want to delete this record?")) {
          return false;
        }
        e.preventDefault();   
        var id = $("#user_id").val();
        
        var ajaxTable = $("#table").DataTable();
        $.ajax({
            type:'DELETE',
            url: "users/"+id,
            data:{"id":id},
            dataSrc:"",
            success:function(response){
                console.log("Response:\n", response);
                location.reload();
            },
            error: function(error) {
                console.log("Error:\n", error);
            }
        });
    });

</script>
@endsection