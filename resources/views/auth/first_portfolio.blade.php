
@extends('layouts.app')

@section('content')

{{-- <register-first_portfolio></register-first_portfolio>
    --}}


    <form action="{{route('store_portfolio')}}" method="POST" >
        @csrf
        <div class="d-flex justify-content-center py-5 px-2 px-md-0">
            <div class="m-auto p-3 pm-0 ">
                <div class="text-center mb-5">
                    <h2 class="uppercase font-weight-bolder primary">dataTrade </h2>
                </div>
                <div class="py-4 ">
                    <h1 class="font-weight-bold dark text-center">Create Recording Portfolio</h1>
                </div>
                <div class="form-group mb-5">
                    <label class="font-lg font-weight-bold dark">Name</label>
                    <input type="text" class="form-control auth-input" name="name"  placeholder="Portfolio name">
                     
                </div>
                <div class="form-group mb-5">
                    <label class="font-lg font-weight-bold dark" >Start Equity</label>
                    <input type="text" class="form-control auth-input" name="start_equity"  placeholder="Enter start equity">
                    
                </div>
                    <div class="form-group row mx-0 mb-5">
                        <div class="col-6 pl-0">
                            <label class="font-lg font-weight-bold dark">Currency</label>
                            <select class="form-control auth-input auth-input-w-50" name="currency">
                                <option value="EUR" selected>EUR</option>
                                <option value="USD">USD</option>
                                <option value="CHF">CHF</option>
                                <option value="AUD">AUD</option>
                                <option value="CAD">CAD</option>
                            </select>
                        </div>
                         <div class="form-group col-6 pr-1">
                            <label class="font-lg font-weight-bold dark">Start Date</label>
                            <input type="date" name="started_at" class="form-control">
             
                        </div>
                    </div>
                   
        
                <div class="form-group mb-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-primary w-100 auth-btn">
                            Ready to go
                        </button>
                    </div>
                </div>
                 
            </div>
        </div>
    </form>
@endsection