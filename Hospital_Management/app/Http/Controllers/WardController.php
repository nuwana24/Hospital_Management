<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ward;

class WardController extends Controller
{
    //get all the wards
    public function getWards()
    {
        $wards = Ward::all();
        $index = 0;
        return view ('ward.wardList') -> with('wards',$wards) -> with('index',$index);
    }

    //create a new ward
    public function createWard(Request $request)
    {
        $ward = new Ward;

        $ward->name = $request->input('name');
        $ward->description = $request->input('description');

        $ward->save();
        
        $wardCode = $this->wardCodeGeneration($ward->id);
        $ward->ward_code = $wardCode;

        $ward->save();

        Session::flash('status_code','success');
        return redirect('/getWards')->with('status','Ward successfully added!');

    }

    //get the edit ward page of a given ward
    public function editWard($id)
    {
        $wardToBeEdit = Ward::find($id);
        return view('ward.updateWard')->with('wardToBeEdit',$wardToBeEdit);
        
    }

    //update a given ward
    public function updateWard(Request $request, $id)
    {
        $wardTobeUpdated = Ward::find($id);

        $wardTobeUpdated->name = $request->input('name');
        $wardTobeUpdated->description = $request->input('description');

        $wardTobeUpdated->update();

        Session::flash('status_code','info');
        return redirect('/getWards')->with('status','Ward successfully updated!');

    }

    //this is a function which is used in the createWard() function. This is used genearte ward code string
    public function wardCodeGeneration($id)
    {
        if ($id < 10)
        {
            return "W00".$id;
        }
        else if ($id < 100)
        {
            return "W0".$id;
        }
        else
        {
            return "W".$id;
        }
    }


    // delete a given ward 
    public function deleteWard($id)
    {
        $wardToBeDeleted = Ward::find($id);
        $wardToBeDeleted->delete();

        Session::flash('status_code','success');
        return redirect('/getWards')->with('status','Ward successfully deleted!');

    }
}
