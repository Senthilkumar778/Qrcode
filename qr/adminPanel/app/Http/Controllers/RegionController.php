<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Session;

class RegionController extends Controller
{
    public function index(){
        $regions = Region::all();
        return view('region.index', compact('regions'));
    }

    public function getProjects(){
        $projects = Project::all();
        return response()->json(['projects'=>$projects]);
    }

    public function add(){
        
        return view('region.add');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'regionID' => 'nullable',
            'regionTag'=> 'nullable',
            'email' => 'nullable'
        ]);
        $regionCreate = Region::create($validated);
        if($regionCreate ){
            Session::flash('success', 'Region Added successfully');
        }else{
            Session::flash('error', 'Unable to add region');
        }
        return redirect('regions');
    }

    public function edit(Request $request, $id){
        
        $regionEdit = Region::find($id);
    
        return view('region.edit', compact('regionEdit'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'regionID' => 'nullable',
            'regionTag'=> 'nullable',
            'email' => 'nullable'
        ]);
        
        $region = Region::find($id);

        $regionUpdate =  $region->update($validated);
        
        if($regionUpdate){
            Session::flash('success', 'Region updated successfully');
        }else{
            Session::flash('error', ' Unable to update region');
        }
        return redirect('regions');
    }

    public function destroy(Request $request, $id){

        $region = Region::find($id);
        $regionDelete = $region->delete();
        if($regionDelete){
            Session::flash('success', 'Region deleted successfully');
        }else{
            Session::flash('error', ' Unable to delete region');
        }
        return redirect('regions');
    }
    
}
