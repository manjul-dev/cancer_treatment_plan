<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientData;
use App\Models\Cancer;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = City::getDistinctStaes();
        $types = Cancer::getTypes();
        return view('patient.index', compact('states','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientData $request)
    {
        try {
            $data = $request->all();
            foreach ($request->file('attachment') as $key => $file) {
                $fName = User::saveAttachment($file, $key);                
                $attachment[] = $fName;                
            }
            $data['attachment'] = $attachment;
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            return $this->showMessage('success', 'Details added successfully', 200);
            
        } catch (\Exception $e) {
            echo $e->getMessage();
            return $this->showMessage('failure','Something went wrong', 500);
        }
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

    public function getCities(Request $request)
    {
        $cities = City::getAllCitiesForaState($request->state);
        $html = View::make('patient.partials.cities',compact('cities'))->render();
        return Response::json(compact('html'));
    }

    public function showMessage($status, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $statusCode);
    }
}
