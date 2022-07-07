@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add Product</h2>
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
		    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
		        <div class="form-group">
		            <strong>Name:</strong>		            
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
		        <div class="form-group">
		            <strong>Detail:</strong>
                    {!! Form::textarea('detail', null, array('placeholder' => 'Detail','class' => 'form-control')) !!}		            
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
		        <div class="form-group">
		            <strong>Price:</strong>
                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
		        </div>
		    </div>            

            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <div class="form-group">
                    <strong>Product Image:</strong>
                    {!! Form::file('image', array('class' => 'form-control')) !!}                    
                </div>
            </div>            

            <div class="form-group mt-3">
                <strong>Product Attribute:</strong>
                <div class="d-flex">
                    @foreach ($attributes as $attribute)
                        <input 
                            class="form-check-input"
                            type="checkbox" 
                            name={{ strtolower($attribute->name) }} 
                            value={{ $attribute->id }} 
                            id={{ strtolower($attribute->name) }} 
                            onclick="myFunction();"/> &nbsp;{{ $attribute->name }}&nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach        
                </div>
            </div>    
            <div class="form-group row mt-3">
                <div class="col-md-6">
                    <div id="colorContainer" style="display: none;">
                        <table class="table table-bordered" id="dynamicAddColor">
                            <tr>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="colorFields[0]" placeholder="Enter Color" class="form-control" />
                                </td>
                                <td><button type="button" name="addColor" id="dynamic-color-ar" class="btn btn-outline-primary">Add Color</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="sizeContainer" style="display: none;">
                        <table class="table table-bordered" id="dynamicAddSize">
                            <tr>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="sizeFields[0]" placeholder="Enter Size" class="form-control" />
                                </td>
                                <td><button type="button" name="addSize" id="dynamic-size-ar" class="btn btn-outline-primary">Add Size</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
		        <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>

<p class="text-center text-primary"><small>by Ashish Maharana</small></p>
    
<script>
    var i = 0;
    var j = 0;
    $("#dynamic-color-ar").click(function () {
        ++i;
        $("#dynamicAddColor").append('<tr><td><input type="text" name="colorFields[' + i +
            ']" placeholder="Enter Color" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-color-input">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-color-input', function () {
        $(this).parents('tr').remove();
    });

    $("#dynamic-size-ar").click(function () {
        ++j;
        $("#dynamicAddSize").append('<tr><td><input type="text" name="sizeFields[' + j +
            ']" placeholder="Enter Size" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-size-input">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-size-input', function () {
        $(this).parents('tr').remove();
    });


    function myFunction() {
        var colorBlock = document.getElementById('colorContainer');
        var sizeBlock = document.getElementById('sizeContainer');
        var colorElement = document.getElementById('color');
        var sizeElement = document.getElementById('size');
        
        if(colorElement.name == 'color' && colorElement.checked == true){
            colorBlock.style.display = "block";
        }else {
            colorBlock.style.display = "none";
        }
        
        if(sizeElement.name == 'size' && sizeElement.checked == true){
            sizeBlock.style.display = "block";
        }else {
            sizeBlock.style.display = "none";
        }
    }
</script>
@endsection