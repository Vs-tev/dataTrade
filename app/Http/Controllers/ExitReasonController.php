<?php

namespace App\Http\Controllers;

use App\Models\ExitReason;
use Illuminate\Http\Request;

class ExitReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitReason = ExitReason::latest();
        $exitReason = $exitReason->where('user_id', auth()->id())
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
        $this->validate(request() ,[
            'name' => ['required','unique:exit_Reasons', 'string', 'min:2', 'max:40'],
        ]);
            
        $exit_reason = new ExitReason;
        $exit_reason->name = $request->input('name');
        $exit_reason->user_id = auth()->id();

        $exit_reason->save();
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
