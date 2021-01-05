<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function manageMenu()
    {
        $data['page_title'] = "Control Menu";
        $data['menu'] = Menu::all();
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
        $this->validate($request, [
            'name' => 'required|unique:menus,name',
            'description' => 'required'
        ]);
        $in = $request->except('_method', '_token');
        $in['slug'] = Str::slug($request->name);
        Menu::create($in);
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
            'description' => 'required'
        ]);
        $in = $request->except('_method', '_token');
        $in['slug'] = Str::slug($request->name);
        $menu->fill($in)->save();
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
