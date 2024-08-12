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
            // $currentUserInfo = Location::get('182.2.165.212');
            // $latitude = $currentUserInfo->latitude;
            // $longitude = $currentUserInfo->longitude;

            $data = Restaurant::where($request->filter, 'like', '%' . $request->search . '%')->orderBy($request->filter, 'asc')->get();
            // $data = Restaurant::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            // ->having('distance', '<', 25)
            // ->orderBy('distance')
            // ->get();

            $output = '';

            if (count($data) > 0) {
                $output = '
            <div class="container-lg" id="search-list">';
                foreach ($data as $item) {
                    $output .= '
                <div class="card mb-3">
                    <div class="card-header d-flex">
                        <div class="card-title">' . $item->name . '</div>
                        <div class="ms-auto">
                            <button class="btn btn-info" onclick="popUp(' . $item->id . ')" id="popBtn" data-bs-toggle="modal" data-bs-target="#popUp">
                                <i class="fa fa-pizza-slice" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-text float">
                            <div class="img-fluid float-end">
                                <img class="object-contain" src="/assets/images/' . $item->image . '" width="128"
                                    height="128" alt="">
                            </div>
                            ' .
                        $item->description
                        . '
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-text">
                            ' .
                        $item->address
                        . '
                        </div>
                        <div class="ms-auto">
                            <button onclick="relocate(' . $item->latitude . ',' . $item->longitude . ')" class="btn btn-success" title="Pinpoint location on map">
                                <i class="fa fa-map-marked" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>';
                }
                '</div>
                ';
            }
            return $output;
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

            if ($data) {
                $output = '
                    <div class="modal-content" id="modalean">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                ' . $data->name . '
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">' . $data->menu . '</div>
                        <div class="modal-footer">
                            <div>
                                ' . $data->latitude . ', ' . $data->longitude . '
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                ';
            }
            return $output;
        }
    }
}
