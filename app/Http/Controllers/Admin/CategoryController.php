<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicSetting;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Post;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function manageCategory()
    {
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = " Category";
        $data['category'] = Category::all();
        foreach($data['category'] as $key => $category){
            if($category->parent_id){
                $data['category'][$key]['parent_name'] = Category::find($category->parent_id)->name;
            }
        }
        return view('dashboard.category', $data);
    }
    public function storeCategory(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories,name',
            'status' => 'required',
        ]);

        $data = new Category();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        $data->parent_id = $request->parent_id;
        $data->save();
        return response()->json($data);

    }
    public function editCategory($product_id)
    {
        $product = Category::find($product_id);
        return response()->json($product);
    }
    public function updateCategory(Request $request,$product_id)
    {
        $product = Category::find($product_id);
        $request->validate([
            'name' => 'required|unique:categories,name,'.$product->id,
            'status' => 'required',
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->status = $request->status;
        $product->parent_id = $request->parent_id;
        $product->save();
        return response()->json($product);
    }
    public function deleteItem($id)
    {
        $categoryIds = [$id];
        $categoryIds = array_merge($categoryIds, Category::where('parent_id', $id)->pluck('id')->toArray());
        $d = Category::whereIn('id', $categoryIds)->delete();
        $data = Post::whereIn('category_id',$categoryIds)->get();
        foreach ($data as $key => $value) {
            File::delete(public_path('assets/images'). '/' .$value->image);
            $value->delete();
        }
        return response()->json($d);
    }

}
