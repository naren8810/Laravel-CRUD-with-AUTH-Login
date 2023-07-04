<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Alluser;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Session;

class AlluserAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allusers = Alluser::latest()->get();
        return view('home', compact('allusers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    public function fillformdata(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:allusers',
            'pan_no' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/|unique:allusers',
            // 'adhaar_no' => 'required|regex:/^[2-9]{1}[0-9]{3}\\s[0-9]{4}\\s[0-9]{4}$/',
            'adhaar_no' => 'required|regex:/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/|unique:allusers',
            // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], ['pan_no.regex' => "Invalid PAN Number", 'adhaar_no.regex' => "Invalid ADHAAR Number"]);

        $image = '';
        if ($files = $request->file('image')) {
            $path = 'userimages/';
            if (!file_exists($path)) {
                // path does not exist
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            //delete old file
            // \File::delete($path . $request->hidden_image);

            //insert new file
            $destinationPath = $path; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = $profileImage;
        }
        //save in db
        $alluserModel = new Alluser;
        $alluserModel->name = $request->name;
        $alluserModel->email = $request->email;
        $alluserModel->address = $request->address;
        $alluserModel->pan_no = $request->pan_no;
        $alluserModel->adhaar_no = $request->adhaar_no;
        $alluserModel->image = $image;
        $alluserModel->save();

        return redirect('/')->with('success', 'Form Submited Successfuly!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:allusers,email,' . $request->id . ',id',
            'pan_no' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/|unique:allusers,pan_no,' . $request->id . ',id',
            // 'adhaar_no' => 'required|regex:/^[2-9]{1}[0-9]{3}\\s[0-9]{4}\\s[0-9]{4}$/',
            'adhaar_no' => 'required|regex:/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/|unique:allusers,adhaar_no,' . $request->id . ',id',
            // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], ['pan_no.regex' => "Invalid PAN Number", 'adhaar_no.regex' => "Invalid ADHAAR Number"]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        if (isset($request->old_image) && !empty($request->old_image)) {
            $image = $request->old_image;
        } else {
            $image = '';
        }
        if ($files = $request->file('image')) {
            $path = 'userimages/';
            if (!file_exists($path)) {
                // path does not exist
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            //delete old file
            // \File::delete($path . $request->hidden_image);

            //insert new file
            $destinationPath = $path; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = $profileImage;
        }
        // echo '<pre>';print_r($_POST);print_r($_FILES);print_r($image);echo '</pre>';die('developer is working');
        Alluser::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'email' => $request->email, 'address' => $request->address, 'pan_no' => $request->pan_no, 'adhaar_no' => $request->adhaar_no, 'image' => $image]
        );
        Session::flash('success', 'User saved successfully.');
        return response()->json(['success' => 'User saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alluser $alluser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alluser = Alluser::find($id);
        return response()->json($alluser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alluser $alluser)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alluser::find($id)->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
