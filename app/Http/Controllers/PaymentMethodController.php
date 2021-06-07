<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $paymentMethods = auth()->user()->paymentMethods();
        $defaultPaymentMethod = auth()->user()->defaultPaymentMethod();
        $intent = auth()->user()->createSetupIntent();
       
        return view('billing.payment_methods', compact('paymentMethods', 'defaultPaymentMethod', 'intent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            auth()->user()->addPaymentMethod($request->input('payment-method'));

            if($request->input('default') == 1){
                auth()->user()->updateDefaultPaymentMethod($request->input('payment-method'));
            }
        }catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        return redirect()->route('payment_methods')->withMessage('Payment method added successfuly');

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markDefault(Request $request, $paymentMethod)
    {
        try{
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        } catch(\Exception $e){
            return redirect()->back()->withError($e->GetMessage());
        }
        return redirect()->route('payment_methods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($paymentMethod)
    {
        $paymentMethods = auth()->user()->paymentMethods();
        //dd($paymentMethods);
        foreach( $paymentMethods as $method ){
            if( $method->id == $paymentMethod ){
                $method->delete();
                break;
            }
        }
        if($paymentMethods->count() > 1){
            return redirect()->back();
        }else{
            return redirect()->route('plan')->withMessage('You have no payments method');
        }

    }
}
