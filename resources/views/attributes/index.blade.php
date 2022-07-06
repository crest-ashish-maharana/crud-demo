@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Attributes</h2>
            </div>

            <div class="pull-right mb-3">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('attributes.create') }}"> Create  Attribute</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>      
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>

	    @foreach ($attributes as $key => $attribute)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $attribute->name }}</td>
	        <td>            
                <a class="btn btn-info" href="{{ route('attributes.show',$attribute->id) }}">Show</a>
                @can('product-edit')
                <a class="btn btn-primary" href="{{ route('attributes.edit',$attribute->id) }}">Edit</a>
                @endcan                
                
                @can('product-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['attributes.destroy', $attribute->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                @endcan            
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $attributes->links() !!}


    <p class="text-center text-primary"><small>by Ashish Maharana</small></p>

@endsection