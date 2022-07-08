<?php 
namespace App\Http\Controllers;  
use App\Http\Requests\ProductPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
    

class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware(['auth', 'verified']);
        // set permission
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::with('attributeValues')->latest()->paginate(5);
        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Product $product)
    {
        if ($this->authorize('create', $product)) {
            $attributes = Attribute::all(); 
            return view('products.create', compact('attributes'));
        }
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPostRequest $request)
    {
        $request->validated();
        $input = $request->all();  
        $input['user_id'] = Auth::id();
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        } 
        
        $product = Product::create([
            'user_id' => $input['user_id'],
            'name' => $input['name'],
            'detail' => $input['detail'],
            'image' => $input['image'],
            'price' => $input['price'],
        ]);    
        
        if(isset($input['colorFields']) && !empty($input['colorFields'])){
            $colorList = implode(', ', $input['colorFields']);
            AttributeValue::create([
                'attribute_id' => $input['color'],
                'value' => $colorList,
                'product_id' => $product->id
            ]);
        }

        if(isset($input['sizeFields']) && !empty($input['sizeFields'])){
            $sizeList = implode(', ', $input['sizeFields']);
            AttributeValue::create([
                'attribute_id' => $input['size'],
                'value' => $sizeList,
                'product_id' => $product->id
            ]);
        }

        return redirect()->route('products.index')->with('success','Product created successfully.');
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Product $product)
    {
        $user = Auth::user();
        if ($this->authorize('update', $product) && $user->can('update', $product)) {
            return view('products.edit',compact('product'));
        }
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price'=>'required',
        ]);

        $input = $request->all();  

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        }else{
            unset($input['image']);
        }          

        $product->update($input);
   

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $ImagePath = 'image/'.$product->image;
        unset($ImagePath);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
  
}