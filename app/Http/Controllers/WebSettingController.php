<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function manageMenu()
    {
        $data['page_title'] = "Control Menu";
        $data['menus'] = Menu::all();
        $data['basic'] = Section::first();
        return view('webcontrol.menu.show', $data);
    }
    public function createMenu()
    {
        $data['page_title'] = "Create Menu";
        $data['basic'] = Section::first();
        return view('webcontrol.menu.create', $data);
    }
    public function storeMenu(Request $request)
    {
        if($request->description == "<br>"){
          $request->description = null;
        }
        $this->validate($request, [
            'name' => 'required|unique:menus,name',
            'description' => 'required',
            'title' => 'nullable|unique:menus,title',
            'image' => 'required_with:title|mimes:png,jpeg,jpg',
        ]);
        $data = $request->except('_method', '_token');
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/post') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        Menu::create($data);
        session()->flash('message', 'Menu Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function editMenu($id)
    {
        $data['page_title'] = "EdIt MEnu";
        $data['menu'] = Menu::findOrFail($id);
        $data['basic'] = Section::first();
        return view('webcontrol.menu.edit', $data);
    }
    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:menus,name,' . $menu->id,
            'description' => 'required',
            'title' => 'nullable|unique:menus,title,' . $id,
            'image' => 'required_with:title|mimes:png,jpeg,jpg',
        ]);
        $data = $request->except('_method', '_token');
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            File::delete(('images/post') . '/' . $menu->image);
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/post') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        $menu->fill($data)->save();
        session()->flash('message', 'Menu Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteMenu(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        Menu::destroy($request->id);
        session()->flash('message', 'Menu Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
}
