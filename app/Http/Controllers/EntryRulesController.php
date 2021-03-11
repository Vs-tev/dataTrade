<?php

namespace App\Http\Controllers;

use App\Models\EntryRules;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EntryRulesController extends Controller
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
        $entry_rules = EntryRules::latest();
        $entry_rules = $entry_rules->withCount(['trade as used_rules_count', 'trade as rules_in_winn_trades' => function($query){
            $query->where('pl_currency', '>=', 0);
        }])
        ->where('user_id', auth()->id())
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
        if (!Gate::allows('entry_rules')){
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
        if (Gate::allows('entry_rules')){
        
            $this->validate(request() ,[
                'name' => [Rule::unique('entry_rules')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),'required', 'string', 'min:2', 'max:40'],
            ]);
                
            $entry_rule = new EntryRules;
            $entry_rule->name = $request->input('name');
            $entry_rule->user_id = auth()->id();
            $entry_rule->save();

        }
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
