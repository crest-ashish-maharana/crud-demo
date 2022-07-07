@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>

            <div class="pull-right mb-3">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create </a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- @dd($products[1]->attributeValues) --}}
    <table class="table table-bordered">
        <tr>
            <th>No</th>            
            <th>Images</th>
            <th>Name</th>
            <th>Details</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>

	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $product->image }}" width="100px"></td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
            <td>
                @if ($product->attributeValues->isEmpty())
                    N/A
                @else
                    @foreach ($product->attributeValues as $attribute) 
                        @if($attribute->attributes->name === 'Color')
                            {{ $attribute->value }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($product->attributeValues->isEmpty())
                    N/A
                @else
                    @foreach ($product->attributeValues as $attribute) 
                        @if($attribute->attributes->name === 'Size')
                            {{ $attribute->value }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td>{{ $product->price }}</td>
	        <td>            
                <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                @can('product-edit')
                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                @endcan                
                
                @can('product-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                @endcan            
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $products->links() !!}


    <p class="text-center text-primary"><small>by Ashish Maharana</small></p>

@endsection