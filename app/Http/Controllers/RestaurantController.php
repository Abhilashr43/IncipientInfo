<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\ResturantCreateRequest;
use App\RestaurantImage;

class RestaurantController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);
        $restaurant = Restaurant::all();
        return view('admin.restaurant.index', compact('restaurant'));
    }

    public function create_restaurant_view()
    {
        abort_unless(\Gate::allows('permission_create'), 403);
        return \view('admin.restaurant.create');
    }

    public function store(ResturantCreateRequest $restaurantRequest)
    {
        abort_unless(\Gate::allows('permission_create'), 403);
        $Validated_data = $restaurantRequest->except('image', '_token');

        $restaurant = Restaurant::create($Validated_data);

        if ($restaurantRequest->hasFile('image')) {
            $filenameWithExt = $restaurantRequest->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $restaurantRequest->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $restaurantRequest->file('image')->storeAs('public/image', $fileNameToStore);
            $imageData = ['name' => $filename, 'url' => $path, 'restaurant_id' => $restaurant->id];
            RestaurantImage::create($imageData);
        }
        return redirect()->route('admin.manage.restaurant.create');
    }
    public function show(Restaurant $res)
    {
        abort_unless(\Gate::allows('user_show'), 403);
        return view('admin.restaurant.show', compact('res'));
    }

    public function edit(Restaurant $res)
    {
        return view('admin.restaurant.edit', compact('res'));
    }

    public function destroy(Restaurant $res)
    {
        abort_unless(\Gate::allows('user_delete'), 403);
        $res->delete();
        return back();
    }
}
