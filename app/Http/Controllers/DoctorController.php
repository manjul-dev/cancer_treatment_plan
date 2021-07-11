<?php

namespace App\Http\Controllers;

use App\Jobs\SendTreatmentPlan;
use App\Mail\SendPlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $patients = User::select('id','name','email','city','state','phone')
                ->where('doctor_id',auth()->user()->id)
                ->orWhere(function ($q) {
                    $q->where('type',auth()->user()->specialist)
                        ->where('doctor_id', null);
                })->get();    
            return DataTables::of($patients)->addColumn('action', function(User $user) {
                return view('doctor.partials._action',compact('user'));
            })->toJson();
        }
        return view('doctor.index');
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

    public function plan($plan)
    {
        return view('doctor.plan',compact('plan'));
    }

    public function createPlan(Request $request)
    {
        $this->validate($request, [
            'plan' => 'required'
        ]);

        $data = $request->all();
        $data['id'] = base64_decode($data['id']);
        
        // get doctor id
        $docId = auth()->user()->id;
        $patientId = $data['id'];
        
        DB::beginTransaction();
        
        // create the pdf
        $pdfName = time().".pdf";
        

        // update users table for doctor id
        $user = User::find($patientId);
        $user->doctor_id = $docId;
        $user->save();

        // save plan for the user
        $plan = $user->plans()->save(new Plan([
            'plan' => $data['plan'],
            'attachment' => $pdfName,
        ]));

        if ($plan) {
            $pdf = PDF::loadView('doctor.planPDF',['plan'=>$plan->plan]);
            Storage::put("public/pdf/$user->id/$pdfName", $pdf->output());
            // send the mail with attachment
            dispatch(new SendTreatmentPlan($user));
            DB::commit();
            return $this->showMessage('success','Plan created successfully', 200);
        }

        DB::rollBack();
        return $this->showMessage('failure','Something went wrong', 500);        
    }

    public function showMessage($status, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $statusCode);
    }

    public function pdf()
    {
        $user = User::find(1);
        Mail::to($user->email)->send(new SendPlan($user));
        return 'sent mail';
    }
}
