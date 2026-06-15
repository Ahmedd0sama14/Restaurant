<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateResturantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantImage;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function __construct(protected FileService $fileService) {}
    public function index()
    {
        $restaurants = Restaurant::with('images')->withCount(['branches', 'menus'])->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $uploaded = [];
            if ($request->hasFile('image')) {
                $uploaded = $this->fileService->handleMultipleFiles($request->file('image'), [], 'restaurants');
            }

            $restaurantData = $data;
            unset($restaurantData['image']);
            $restaurant = Restaurant::create($restaurantData);
            $branches = $data['branches'];
            $restaurant->branches()->createMany($branches);

            if (!empty($uploaded)) {
                foreach ($uploaded as $filePath) {
                    RestaurantImage::create([
                        'restaurant_id' => $restaurant->id,
                        'image_path' => $filePath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant created successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('images', 'branches', 'menus');
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResturantRequest $request, Restaurant $restaurant)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $restaurantData = $data;
            unset($restaurantData['image'], $restaurantData['branches']);
            $restaurant->update($restaurantData);
            if ($request->hasFile('image')) {
                $uploadedImages = $this->fileService->handleMultipleFiles(
                    $request->file('image'),
                    $restaurant->images()->pluck('image_path')->toArray(),
                    'restaurants'
                );
                foreach ($uploadedImages as $path) {

                    $restaurant->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }
            if (! empty($data['branches'])) {
                $restaurant->branches()->delete();

                foreach ($data['branches'] as $branch) {

                    $restaurant->branches()->create($branch);
                }
            }

            DB::commit();

            return redirect()->route('admin.restaurants.show', $restaurant)->with('success', 'Restaurant Updated Successfully');
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        try {
            DB::beginTransaction();
            $this->fileService->deleteMultipleFiles($restaurant->images()->pluck('image_path')->toArray());
            $restaurant->delete();
            DB::commit();
            return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant deleted successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
