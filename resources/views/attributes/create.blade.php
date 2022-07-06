@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add  Attribute</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('attributes.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())

        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif


    {!! Form::open(array('route' => 'attributes.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>		            
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
		        </div>
		    </div>       

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>


<p class="text-center text-primary"><small>by Ashish Maharana</small></p>

@endsection