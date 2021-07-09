<?php

namespace App\Http\Controllers;

use App\Jobs\SendCredentialMail;
use App\Mail\SendDoctorMail;
use App\Models\Cancer;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createCancerType()
    {
        return view('admin.cancer.create');
    }

    public function storeCancerType(Request $request)
    {        
        $request->validate([
            'type' => 'required|unique:cancers'
        ]);    
        Cancer::create($request->all());
        return $this->showMessage('success','Cancer Type added successfully',200);        
    }

    public function showMessage($status, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $statusCode);
    }

    public function createDoctor()
    {
        $types = Cancer::getTypes();
        return view('admin.doctor.create',compact('types'));
    }

    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:doctors',
            'specialist'  => 'bail|required|exists:cancers,type'
        ]);
        $password = $this->generatePassword();
        $data = $request->all();
        $data['password'] = Hash::make($password);
        $create = Doctor::create($data);
        if ($create) {
            dispatch(new SendCredentialMail($data['email'], $password, $data['email']));
        }
        
    }
    
    public function generatePassword()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, 10);
    }
}
