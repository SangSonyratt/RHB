<?php

namespace App\Http\Controllers;

use App\Http\Resources\SidebarResource;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    /**
     * Show all sidebar data.
     */
    public function showSidebar(Sidebar $sidebar)
    {
        $sidebars = Sidebar::all();
        return view('sidebars.index')->with('sidebars', $sidebars);
    }

    /**
     * Create new sidebar.
     */
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

    /**
     * Delete sidebar.
     */
    public function deleteSidebar($id)
    {
        Sidebar::where('id', $id)->delete();
        return redirect('/')->with('success', 'Sidebar has been deleted successfully');
    }

    /**
     * Update sidebar.
     */
    public function updateSidebar(Request $request, $id)
    {
        $data = $request->all();
        $sidebar = Sidebar::where('id', $id)->firstOrFail();
        $sidebar->fill($data);
        $sidebar->save();
        return SidebarResource::collection($sidebar->where('id', $id)->get())->response();
    }

    /**
     * Show sidebar by id.
     */
    public function showSidebarbyId(Request $request, $id)
    {
        $data = Sidebar::where('id', $id)->get();
        return SidebarResource::collection($data)->response();
    }
}