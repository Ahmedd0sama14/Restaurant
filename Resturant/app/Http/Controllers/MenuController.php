<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\AddExcelMenuRequest;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Imports\MenuImport;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Services\FileService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MenuController extends Controller
{
        public function __construct(protected FileService $fileService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        $menus = $restaurant->menus()->latest()->paginate(10);
        return view('admin.menu.index',compact('menus','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        return view('admin.menu.create',compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();
        $data['restaurant_id'] = $restaurant->id;
        $data['image'] = $this->fileService->handleFile($request->file('image'),null, 'menus');
        Menu::create($data);
        return redirect()->route('admin.restaurants.show', $restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant,Menu $menu)
    {
        return view('admin.menu.edit',compact('restaurant','menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Restaurant $restaurant,Menu $menu)
    {
        $data=$request->validated();
        if ($request->hasFile('image')) {
            $this->fileService->deleteOldFile($menu->image);
            $data['image'] = $this->fileService->handleFile($request->file('image'),null, 'menus');
        }
        $menu->update($data);
        return redirect()->route('admin.restaurants.show', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant,Menu $menu)
    {
        $this->fileService->deleteOldFile($menu->image);
        $menu->delete();
        return redirect()->route('admin.restaurants.show', $restaurant);
    }
    public function importmenu(AddExcelMenuRequest $request,Restaurant $restaurant)
    {

        try {
            Excel::import(new MenuImport($restaurant->id), $request->file('excel_file'),null, \Maatwebsite\Excel\Excel::XLSX);
            return redirect()->route('admin.restaurants.show', $restaurant)->with('success', 'Menu imported successfully');

        }
        catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
}
