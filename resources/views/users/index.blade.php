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

<div class="container">
  <div class="row">
      <div class="col-12 table-responsive">
          <table class="table table-bordered user_datatable">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th width="0px">Action</th>
                  </tr>
              </thead>
              <tbody></tbody>
          </table>
      </div>
  </div>
</div>

<p class="text-center text-primary"><small>by Ashish Maharana</small></p>
<script type="text/javascript">

  $(function () {
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
  });

  function deleteRecord(e) {
    var url = "{{ route('users.destroy',':id') }}";
    url = url.replace(':id',e);
    if(!confirm("Do you really want to delete this record?")) {
      return false;
    }
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'DELETE',
      url: url,
      success:function(response){
          $('.user_datatable').DataTable().ajax.reload();
      },
      error: function(error) {
          console.log("Error:\n", error);
      }
    });
  }
</script>
@endsection