<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        
    public function index($id , Request $request)
    {
        $category=Category::find($id);
        $search = $request->query('search');
        $producs = Product::query()->when($search, function ($query, $search) {
            return $query->where('price', 'like', '%'.$search.'%')
                ->orWhere('categorie', 'like', '%'.$search.'%');
        })->get();
        return view('products.index', compact('roducts', 'category' , 'search'));
    }

   
    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:png|max:2048',
        ]);
        
        
        $input = $request-> all() ;
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        Product::create($input);
        return to_route('product.index');
    }

   
    public function destroy(Product $product)
    {
        
        $product->delete();
        return to_route('product.index');
    }
}
