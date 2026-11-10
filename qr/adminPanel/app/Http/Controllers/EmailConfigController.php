<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailConfig;
use Session;

class EmailConfigController extends Controller
{
    public function index(){
        $emailConfig = EmailConfig::all();
        return view('emailConfig.index', compact('emailConfig'));
    }

    public function add (){
        return view('emailConfig.add');
    }

    public function store(Request $request){

        $validated= $request->validate([
            'templateID' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ], [
            'templateID' => "Template ID field is required",
            'subject' => 'Subject is required',
            'body' => 'Body filed is required'
        ]);

        // dd($validated);
        $emailConfigCreate = EmailConfig::create($validated);
        if($emailConfigCreate){
            Session::flash('success', 'Email config Added successfully');
        }else{
            Session::flash('error', ' Unable to Add email config');
        }

        return redirect('emailConfig');
    }

    public function edit ($id){
        $emailConfigEdit = EmailConfig::find($id);
        return view ('emailConfig.edit', compact('emailConfigEdit'));
    }

    public function update(Request $request , $id){
        $validated = $request->validate([
            'templateID' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ], [
            'templateID' => "Template ID field is required",
            'subject' => 'Subject is required',
            'body' => 'Body filed is required'
        ]);

        $emailConfig = EmailConfig::find($id);
        $emailConfigUpdate = $emailConfig->update($validated);

        if($emailConfigUpdate){
            Session::flash('success', 'Email config updated successfully');
        }else{
            Session::flash('error', ' Unable to update email config');
        }

        return redirect('emailConfig');
    }

    public function destroy($id){
        $emailConfig = EmailConfig::find($id);
        $emailConfigDelete = $emailConfig->delete();

        if($emailConfigDelete){
            Session::flash('success', 'Email config deleted successfully');
        }else{
            Session::flash('error', ' Unable to delete email config');
        }
        return redirect('emailConfig');
    }
}
