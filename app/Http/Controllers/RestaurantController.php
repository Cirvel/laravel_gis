<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Restaurant::all();

        return view('restaurants.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pField = $request->validate([
            'name' => ['required'],
            'image' => ['required', 'image'],
            'address' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'menu' => ['required'],
            'description' => ['required'],
        ]);

        // manages image uploading
        if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $img_extension = $img_file->getClientOriginalExtension();
            $img_name = Str::random(16) . '.' . $img_extension;
            $img_file->move('assets/images/', $img_name);
            $pField['image'] = $img_name;
        }

        Restaurant::create($pField);

        return redirect()->route('restaurants.index')->with(['success' => 'data successfully stored']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // only available to ajax requests
        // if ($request->ajax()) {
        // $data = Restaurant::all();
        // return $data;
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = Restaurant::findOrFail($id);

        return view('restaurants.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $pField = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'menu' => ['required'],
            'description' => ['required'],
        ]);

        // manages image uploading
        if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $img_extension = $img_file->getClientOriginalExtension();
            $img_name = Str::random(16) . '.' . $img_extension;
            $img_file->move('assets/images/', $img_name);
            $pField['image'] = $img_name;

            Restaurant::findOrFail($request->id)->update([
                'image' => $pField['image'],
            ]);
        };

        Restaurant::findOrFail($request->id)->update([
            'name' => $pField['name'],
            'description' => $pField['description'],
            'menu' => $pField['menu'],
            'address' => $pField['address'],
            'latitude' => $pField['latitude'],
            'longitude' => $pField['longitude'],
        ]);

        return redirect()->route('restaurants.index')->with(['success' => 'data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
        Restaurant::destroy($id);

        return redirect()->route('restaurants.index')->with(['success' => 'data successfully destroyed']);
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        // only available to ajax requests
        if ($request->ajax()) {
            $maxDistance = 25; // the latitude/longitude distance required to display, anything farther than that will not be displayed

            // $currentUserInfo = Location::get('182.2.165.212');
            // $latitude = $currentUserInfo->latitude;
            // $longitude = $currentUserInfo->longitude;
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            // $data = Restaurant::where($request->filter, 'like', '%' . $request->search . '%')->orderBy($request->filter, 'asc')->get();
            $data = Restaurant::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where($request->filter, 'like', '%'. $request->search .'%')
            ->having('distance', '<', $maxDistance)
            ->orderBy('distance')
            ->get();
            // ->toArray();
            // $data = Restaurant::findOrFail("1");
            // ->paginate(5);

            // return json_encode($data);
            return $data;
        }
    }
    /**
     * Display the specified resource.
     */
    public function popup(Request $request)
    {
        // only available to ajax requests
        if ($request->ajax()) {
            $data = Restaurant::findOrFail($request->id);

            return $data;
        }
    }
}
