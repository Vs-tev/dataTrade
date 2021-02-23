<?php

namespace App\Http\Controllers;

use App\Models\Strategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrategyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        //return view('dashboardpages.strategy.strategy', compact('strategy'));
        return $strategy;
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
            
            'name' => ['required','unique:strategies', 'string', 'min:2', 'max:40'],
            'description' => 'required',
            'img_strategy' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999'
        ],
        ['img_strategy.image' => 'Allowed file types: jpg,png,gif']
    );

        if(request()->hasFile('img_strategy')){
            //Get filename with extention
            $filenameWithExt = request()->file('img_strategy')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extention = request()->file('img_strategy')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Upload Image
            $path = request()->file('img_strategy')->storeAs('public/strategies', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }

        $strategy = new Strategy;
        $strategy->name = $request->input('name');
        $strategy->img_strategy = $fileNameToStore;
        $strategy->user_id = auth()->id();
        $strategy->description = $request->input('description');
      
        $strategy->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function show(strategy $strategy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function edit(strategy $strategy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\strategy  $strategy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $strategy = Strategy::findOrFail($id);
        if(request('img_strategy') == $strategy->img_strategy){
            $fileNameToStore = $strategy->img_strategy;
            $this->validate(request() ,[
                'name' => ['required','unique:strategies,name,'.$id.'', 'string', 'min:2', 'max:40'],
                'description' => 'required',]
            );
        }else{
            if(request()->hasFile('img_strategy')){
            $this->validate(request() ,[
                'name' => ['required','unique:strategies,name,'.$id.'', 'string', 'min:2', 'max:40'],
                'description' => 'required',
                'img_strategy' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999'
            ],
            ['img_strategy.image' => 'Allowed file types: jpg,png,gif']
            );
             //Get filename with extention
             $filenameWithExt = request()->file('img_strategy')->getClientOriginalName();
             //Get just filename
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             //Get just ext
             $extention = request()->file('img_strategy')->getClientOriginalExtension();
             //Filename to store
             $fileNameToStore = $filename.'_'.time().'.'.$extention;
             //Upload Image
             $path = request()->file('img_strategy')->storeAs('public/strategies', $fileNameToStore);
             if($strategy->img_strategy !== 'noimage.jpg'){
                Storage::delete('public/strategies/'.$strategy->img_strategy);
            }
            }else {
                $fileNameToStore = 'noimage.jpg';
                if($strategy->img_strategy !== 'noimage.jpg'){
                    Storage::delete('public/strategies/'.$strategy->img_strategy);
                }
            }
        }

        $strategy->user_id = auth()->id();
        $strategy->name = $request->get('name');
        $strategy->description = $request->get('description');
        $strategy->img_strategy = $fileNameToStore;
        $strategy->save();

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
