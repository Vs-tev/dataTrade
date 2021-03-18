<?php

namespace App\Http\Controllers;

use App\Models\ExitReason;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExitReasonController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitReason = ExitReason::latest();
        $exitReason = $exitReason->withCount('trade as used_rules_count')
        ->where('user_id', auth()->id())
        ->get();
        return $exitReason;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('exit_reasons')) {
            return response('Upgrade account', 402);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('exit_reasons')) {
            $this->validate(request() ,[
                'name' => [Rule::unique('exit_reasons')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),'required', 'string', 'min:2', 'max:40'],
            ]);
                
            $exit_reason = new ExitReason;
            $exit_reason->name = $request->input('name');
            $exit_reason->user_id = auth()->id();
            $exit_reason->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function show(ExitReason $exitReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function edit(ExitReason $exitReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
   
        $this->validate(request() ,[
            'name' => ['required','unique:exit_reasons,name,'.$id.'', 'string', 'min:2', 'max:40'],
        ]);
        
        $exit_reason = ExitReason::findOrFail($id);
        $exit_reason->name = $request->get('name');
        $exit_reason->update($request->all());

        return $exit_reason;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exit_reason = ExitReason::find($id);
        if(auth()->user()->id !== $exit_reason->user_id){
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
      
        $exit_reason->delete();
    }
}
