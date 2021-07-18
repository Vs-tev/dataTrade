<?php

namespace App\Http\Controllers;

use App\Models\ExitReason;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ExitReasonController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'hasPortfolio']);
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

            $this->validate(request(), [
                'name' => [
                    Rule::unique('exit_reasons')->where('user_id', auth()->id()),
                    'required', 'string', 'min:2', 'max:40'
                ],
            ]);

            ExitReason::create(['user_id' => auth()->id(), 'name' => $request->input('name')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExitReason $ExitReason)
    {
        $this->validate(request(), [
            'name' => [Rule::unique('exit_reasons')->where('user_id', auth()->id())->ignore($ExitReason->id), 'required', 'string', 'min:2', 'max:40'],
        ]);

        $ExitReason->update($request->all());

        return $ExitReason;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExitReason  $exitReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExitReason $ExitReason)
    {
        if (auth()->user()->id !== $ExitReason->user_id) {
            return redirect('/')->with('error', 'Unauthorize Page');
        }

        $ExitReason->delete();
    }
}
