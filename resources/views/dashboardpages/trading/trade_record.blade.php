@extends('layouts.master')

<div class="main-content-container">
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
    <div class="content-container">
        <section class="dashboard_container_content chart-container mb-4">
            Chart/Trade img Upload
        </section>

        <section class="dashboard_container_content px-2 px-md-4">
            <form action="">

            
            <div class="d-md-flex">
                <div class="col-12 col-md-6 p-0">
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="d-flex col-12 col-xl-4 mb-3 mb-xl-0">
                            <div class="btn-group btn-group-toggle buy-sell-div col-12 p-0 mt-0" data-toggle="buttons"
                                id="type">
                                <button class="btn btn-type-buy buy btn-sm col-6 active" type="button">
                                    <input class="buy" type="radio" name="type_side" id="type_buy" value="buy"
                                        autocomplete="on" checked="">BUY
                                </button>
                                <button class="btn btn-type-sell sell col-6 btn-sm" type="button">
                                    <input class="sell" type="radio" name="type_side" id="type_sell" value="sell"
                                        autocomplete="off">SELL
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="symbol">Symbol</label>
                                <select id="demo" data-max="2" multiple="multiple">
                                    <option value="Volvo">Volvo</option>
                                    <option value="Opel">Opel</option>
                                    <option value="Audi">Audi</option>
                                    <option value="Dodge">Dodge</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Mercedes">Mercedes</option>
                                    <option value="Tesla">Tesla</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Entry price</label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Exit price</label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Stop Loss</label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                    </div>
                    <div class="row m-0 p-0 align-items-center justify-content-between">
                        <div class="col-12 col-xl-6 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="symbol">Entry Rules<span class="material-icons" class="tooltip"
                                    data-toggle="tooltip" data-placement="top"
                                    title="You can choose up to 3 entry rules per trade">info</span></label>
                                <select id="demo" data-max="2" multiple="multiple">
                                    <option value="Volvo">Rule 1</option>
                                    <option value="Opel">Rule 2</option>
                                    <option value="Audi">Rule 3</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-xl-6 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="symbol">Exit Rule<span class="material-icons" class="tooltip"
                                    data-toggle="tooltip" data-placement="top"
                                    title="You can choose only 1 Exit rule per trade.">info</span></label>
                                <select id="demo" data-max="2" multiple="multiple">
                                    <option value="Volvo">Rule 1</option>
                                    <option value="Opel">Rule 2</option>
                                    <option value="Audi">Rule 3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 px-0">
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">

                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="entry_date">Entry date<span class="material-icons" class="tooltip"
                                    data-toggle="tooltip" data-placement="top"
                                title="Entry date must be greater than portfolio start date'{{ config('app.name', 'Laravel') }}'">info</span></label>
                                <input id="entry_date" type="date" class="form-control" name="entry_date">
                            </div>
                        </div>
                        <div class="col-12 col-xl-2 mb-auto text-center">
                            <span class="font-sm text-muted p-0 m-0 ">Duration: 
                                <span class="font-sm text-muted p-0 m-0">&nbsp; 2.2 Days</span>
                            </span>
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="exit_date">Exit date</label>
                                <input id="exit_date" type="date" class="form-control" name="exit_date">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">

                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="entry_date">Profit currency</label>
                                <input id="Currency" type="text" class="form-control" name="Currency">
                            </div>
                        </div>
                        <div class="col-12 col-xl-2  text-center">
                            <span class="font-sm text-muted p-0 m-0 ">Return: 
                                <span class="font-sm text-muted p-0 m-0">&nbsp; 1.80%</span>
                            </span>
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="exit_date">Profit Pips</label>
                                <input id="Pips" type="text" class="form-control" name="Pips">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-0 align-items-center justify-content-between">
                        <div class="col-12 mb-xl-0">
                            <div class="form-group">
                                <label for="textarea">Comment</label>
                                <textarea name="textarea" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="d-flex justify-content-end pt-4 pr-3">
                <button type="button" class="btn btn-secondary mr-3">Clear</button>
                <button type="button" class="btn btn-primary mr-0">Save Trade</button>
            </div>
        </form>
        </section>

    </div>

    {{-- 
<a href="#modal_delete" data-toggle="modal" style="margin: 150px">Del<span class="material-icons icon-lg text-muted"
    data-toggle="tooltip" data-placement="top"
    title="Delete trade">delete_outline</span></a>

<x-modalDeleteItem :message="$message">

</x-modalDeleteItem>
 --}}
</div>
