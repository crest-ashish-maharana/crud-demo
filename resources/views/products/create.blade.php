@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add </h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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

    {!! Form::open(array('route' => 'products.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
    
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>		            
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
                    {!! Form::textarea('detail', null, array('placeholder' => 'Detail','class' => 'form-control')) !!}		            
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
		        </div>
		    </div>            

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Image:</strong>
                    {!! Form::file('image', array('class' => 'form-control')) !!}                    
                </div>
            </div>            

            <div class="form-group row">
                <strong>Product Attribute:</strong>
                <div class="col-xs-11 col-sm-11 col-md-11">
                    <select name="attribute_name" id="attribute_name" class="form-control">
                        <option selected="true" disabled="disabled">Select Attribute</option>
                        @foreach ($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>                   
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <button type="button" class="btn btn-info text-white w-100" name="add_section" id="add_section">Add</button>
                </div>
            </div>    

            <div class="form-group row" id="color_section" style="display: none;">
                <strong>Input Colors:</strong>
                <div class="col-xs-11 col-sm-11 col-md-11">
                    {!! Form::text('colors', null, array('placeholder' => 'Input colors comma-separated e.g. white, blue, purple','class' => 'form-control')) !!}                 
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <button type="button" class="btn btn-danger text-white w-100" name="remove_color" id="remove_color">Remove</button>
                </div>
            </div>   

            <div class="form-group row" id="size_section" style="display: none;">
                <strong>Input Size:</strong>
                <div class="col-xs-11 col-sm-11 col-md-11">
                    {!! Form::text('sizes', null, array('placeholder' => 'Input Size comma-separated e.g. S, M, L, XL','class' => 'form-control')) !!}                 
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <button type="button" class="btn btn-danger text-white w-100" name="remove_size" id="remove_size">Remove</button>
                </div>
            </div> 

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
		        <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>

<p class="text-center text-primary"><small>by Ashish Maharana</small></p>
    
<script>
    $('document').ready(function () {
        $("#add_section").click(function () {
            var sel = document.getElementById("attribute_name");
            var text= sel.options[sel.selectedIndex].text;
            if(text == 'Color'){
                $('#color_section').show();
            }else if(text == 'Size'){
                $('#size_section').show();
            }
        });

        $("#remove_color").click(function () {
            var sel = document.getElementById("attribute_name");
            var text= sel.options[sel.selectedIndex].text;
            if(text == 'Color'){
                $('#color_section').hide();
            }
        });

        $("#remove_size").click(function () {
            var sel = document.getElementById("attribute_name");
            var text= sel.options[sel.selectedIndex].text;
            if(text == 'Color'){
                $('#size_section').hide();
            }
        });
    });
</script>
@endsection