<?php
namespace App\Http\Controllers;

use App\Http\Requests\AttributePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // set permission
         $this->middleware(['auth', 'verified']);
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
        $attributes = Attribute::latest()->paginate(5);
        return view('attributes.index', compact('attributes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Attribute $attribute)
    {
        return view('attributes.create');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributePostRequest $request)
    {
        $request->validated();
        $input = $request->all();

        Attribute::create($input);
        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */

    public function show(Attribute $attribute)
    {
        return view('attributes.show', compact('attribute'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */

    public function edit(Attribute $attribute)
    {
        return view('attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $input = $request->all();
        $attribute->update($input);
        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully');
    }
}
