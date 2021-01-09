<?php

namespace App\Http\Controllers;

use App\Models\EntryRules;
use Illuminate\Http\Request;

class EntryRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entry_rules = EntryRules::latest();
        $entry_rules = $entry_rules->where('user_id', auth()->id())
        ->get();
        
        return $entry_rules;
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
    public function store(Request $request)
    {
        $this->validate(request() ,[
            'name' => ['required','unique:entry_rules', 'string', 'min:2', 'max:40'],
        ]);
            
        $entry_rule = new EntryRules;
        $entry_rule->name = $request->input('name');
        $entry_rule->user_id = auth()->id();

        $entry_rule->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function show(entry_rules $entry_rules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function edit(entry_rules $entry_rules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request() ,[
            'name' => ['required','unique:entry_rules,name,'.$id.'', 'string', 'min:2', 'max:40'],
        ]);
        
        $entry_rule = EntryRules::findOrFail($id);
        $entry_rule->name = $request->get('name');
        $entry_rule->update($request->all());

        return $entry_rule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry_rule = EntryRules::find($id);
        if(auth()->user()->id !== $entry_rule->user_id){
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
      
        $entry_rule->delete();
    }
}
