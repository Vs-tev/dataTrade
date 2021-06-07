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
                'name' => [Rule::unique('entry_rules')->where('user_id', auth()->id()),
                'required', 'string', 'min:2', 'max:40'],
            ]);

            EntryRules::create(['user_id' => auth()->id(), 'name' => $request->input('name')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntryRules $EntryRules)
    {
        $this->validate(request() ,[
            'name' => [Rule::unique('entry_rules')->where('user_id', auth()->id())->ignore($EntryRules->id),'required','string', 'min:2', 'max:40'],
        ]);
        
        $EntryRules->update($request->all());

        return $EntryRules;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entry_rules  $entry_rules
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryRules $EntryRules)
    {
        if(Auth::check()){
            $EntryRules->delete();
        } else{
            return redirect('/')->with('error', 'Unauthorize Page');
        }

    }
}
