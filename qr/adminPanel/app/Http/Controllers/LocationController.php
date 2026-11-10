<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Region;
use Session;
use File;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::orderBy('name', 'asc')->get();
        return view('location.index', compact('locations'));
    }

    public function getLocations(){
        $locations = Location::all();
        return response()->json(['locations'=> $locations]);
    }

    public function add(){
        $regions = Region::select('regionID', 'regionTag')->get();
        return view('location.add' , compact('regions'));
    }

    public function store(Request $request){

        $validated = $request->validate([ 
            'name'=> 'nullable',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'coordinates' => 'nullable',
            'keyInfo' => 'nullable',
            'keyInfo.*' => 'nullable',
            'valueInfo' => 'nullable',
            'valueInfo.*' => 'nullable',
            'email' => 'nullable',
            'regionID' => 'required'
        ], [
            'regionID' => 'Region is required'
        ]);

        // dd($validated);
        
        $path = 'assets/locations/';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = substr(time(), -5).'.'. $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            $validated['image'] = $path.$imageName;
        }

        $LocationCreate = Location::create($validated);
        if($LocationCreate){
            Session::flash('success', 'Location Added successfully');
        }else{
            Session::flash('error', ' Unable to Add Location');
        }
        return redirect('locations');
    }

    public function edit(Request $request, $id){
        $regions = Region::select('regionID', 'regionTag')->get();
        $locationEdit = Location::find($id);

        $decodedJsonString = json_decode($locationEdit->info);

        $keys = [];
        $values = [];

        if(!empty($decodedJsonString)){

            foreach($decodedJsonString as $key => $value){
                $keys[] = $key;
                $values [] = $value;
            }
        }

        //    echo '<pre>';
        //    var_dump($decode);
        //    var_dump($keys);
        //    var_dump($values);
        //    exit;
       
        return view('location.edit', compact('locationEdit','keys','values', 'regions'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([ 
            'name'=> 'nullable',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'coordinates' => 'nullable',
            'keyInfo' => 'nullable',
            'keyInfo.*' => 'nullable',
            'valueInfo' => 'nullable',
            'valueInfo.*' => 'nullable',
            'email' => 'nullable',
            'regionID' => 'required'
        ], [
            'regionID' => 'Region is required'
        ]);


        $location = Location::find($id);

        // if (File::exists($location->image)) {
        //     File::delete($location->image);
        // }

        $path = 'assets/locations/';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = substr(time(), -5).'.'. $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            $validated['image'] = $path.$imageName;
        }

        $locationUpdate = $location->update($validated);

        if($locationUpdate){
            Session::flash('success', 'Location Updated successfully');
        }else{
            Session::flash('error', ' Unable to Update Location');
        }
        return redirect('locations');
    }

    public function destroy(Request $request, $id){
        $location = Location::find($id);

        // if (File::exists($location->image)) {
        //     File::delete($location->image);
        // }
        $locationDelete =  $location->delete();

        if($locationDelete){
            Session::flash('success', 'Location Deleted successfully');
        }else{
            Session::flash('error', 'Unable to Delete Location');
        }
        return redirect('locations');
    }
}
