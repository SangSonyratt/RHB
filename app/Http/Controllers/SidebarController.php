<?php

namespace App\Http\Controllers;

use App\Http\Resources\SidebarResource;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function showSidebar(Sidebar $sidebar)
    {
        $sidebars = Sidebar::all();
        return view('sidebars.index')->with('sidebars', $sidebars);
    }

    public function createSidebar(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sidebars',
        ]);
        Sidebar::create([
            'name' => $request->name,
        ]);

        return redirect('/')->with('success', 'Sidebar has been created successfully.');
    }

    public function deleteSidebar($id)
    {
        Sidebar::where('id', $id)->delete();
        return redirect('/')->with('success', 'Sidebar has been deleted successfully');
    }

    public function updateSidebar(Request $request, $id)
    {
        $data = $request->all();
        $sidebar = Sidebar::where('id', $id)->firstOrFail();
        $sidebar->fill($data);
        $sidebar->save();
        return SidebarResource::collection($sidebar->where('id', $id)->get())->response();
    }

    public function showSidebarbyId(Request $request, $id)
    {
        $data = Sidebar::where('id', $id)->get();
        return SidebarResource::collection($data)->response();
    }
}