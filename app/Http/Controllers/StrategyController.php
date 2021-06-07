<?php

namespace App\Http\Controllers;

use App\Models\Strategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Traits\StoreImgTraits;
use App\Http\Requests\StoreStrategyRequest;


class StrategyController extends Controller
{
    use StoreImgTraits;
    
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
        $strategy = Strategy::latest();
        $strategy = $strategy->withCount(['trade as total_trades','trade as winning_trades' => function($query){
            $query->where('pl_currency', '>=', 0);
        }])
        ->where('user_id', auth()->id())
        ->get();

        return $strategy;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('strategies')){
            return response('Upgrade account', 402);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStrategyRequest $request)
    {
        if (Gate::allows('strategies')){
            
            $fileNameToStore = $this->storeImg($request->file('img_strategy'), 'strategies');

            $strategy = Strategy::create([
                'user_id' => auth()->id(),
                'img_strategy' => $fileNameToStore,
            ] + $request->validated());

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStrategyRequest $request, Strategy $strategy)
    {
        if(!request()->hasFile('img_strategy')){
            $fileNameToStore =  request('img_strategy') == $strategy->img_strategy ? $strategy->img_strategy : 'noimage.jpg';
        }else{
            $validated = $request->validate([
                'img_strategy' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999',
            ]);
            $fileNameToStore = $this->storeImg($request->file('img_strategy'), 'strategies');
        }

        if($strategy->img_strategy !== 'noimage.jpg'){
            Storage::delete('public/strategies/'.$strategy->img_strategy);
        }

        $strategy->update($request->validated() + ['img_strategy' => $fileNameToStore]);

        return $strategy; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $strategy = Strategy::find($id);

        if($strategy->img_strategy !== 'noimage.jpg'){
            Storage::delete('public/strategies/'.$strategy->img_strategy);
        }

        $strategy->delete();

        return back();
    }
}
