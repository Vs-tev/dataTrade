@extends('layouts.master')

<div class="main-content-container">
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
    @include('dashboardpages.portfolio.modalPortfolio')
    <div class="content-container">
        <div class="row justify-content-between">
            <div class="col-sm-12 pb-3 px-3">
                <div class="dashboard_container_content border d-flex align-items-center">
                    <span class="material-icons cyan icon-lg">add_circle_outline</span>
                    <a href="#modal_create" data-toggle="modal" class="lighter font-weight-bold">
                        <h5 class="ml-2">Create Recording Portfolio</h5></a>
                </div>
            </div>

            <main class="col-sm-12 pb-3 px-3">
                <div class="dashboard_container_content ">
                    <div class="portfolio_container row mx-auto mb-3 justify-content-between align-items">
                        <div class="d-flex">
                            <div class="sparkline">
                                <p class="font-sm m-auto">LineChart</p>
                            </div>
                            <div class="d-flex flex-column justify-content-around portfolio_name ml-3">
                                <h3 class="font-weight-bold">Test Portfolio</h3>
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <p class="mr-3 mb-0 lighter font-500 d-flex">
                                        Start date: &nbsp;<span class="dark">12.09.2019</span>
                                    </p>
                                    <p class="mr-3 mt-1 mt-sm-0 mb-0 lighter font-500 ">
                                        Currency: &nbsp;<span class="dark">USD</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-around mx-auto mt-3 mt-sm-0 m-md-0">
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#transactions">Deposit/Withdrawal</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_edit">Edit</button>
                            </div>
                            
                            <div class="custom-control custom-switch switch_portfolio mx-auto mx-sm-0 ml-sm-auto mt-3 mt-sm-auto">
                                <input type="checkbox" class="custom-control-input activate_portfolio" id="portfolio_id_dynamish1" name="activate_portfolio" checked>
                                <label class="custom-control-label" for="portfolio_id_dynamish1">Active</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="portfolio_info row col-lg-12 justify-content-sm-between justify-content-start align-content-center">
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">attach_money</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Start capital</p>
                                <h5 class="">7000 USD</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">attach_money</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Balance</p>
                                <h5 class="indigo">8142,14 USD</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">trending_up</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Win Rate</p>
                                <h5 class="">61.70 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <i class="material-icons dark icon-lg">list_alt</i>
                            <div class="ml-2">
                                <p class="p-0 m-0">Recorded Trades</p>
                                <h5 class="">&#35; 81</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">show_chart</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Return</p>
                                <h5 class="">12.5 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 ml-3 mb-lg-0">
                            <a href="#modal_delete" data-toggle="modal"><span class="material-icons icon-lg text-muted"
                            data-toggle="tooltip" data-placement="top"
                            title="Delete portfolio">delete_outline</span></a>
                        </div>
                    </div>
                </div>
            </main>



            <main class="col-sm-12 pb-3 px-3">
                <div class="dashboard_container_content ">
                    <div class="portfolio_container row mx-auto mb-3 justify-content-between align-items">
                        <div class="d-flex">
                            <div class="sparkline">
                                <p class="font-sm m-auto">LineChart</p>
                            </div>
                            <div class="d-flex flex-column justify-content-around portfolio_name ml-3">
                                <h3 class="font-weight-bold">Test Portfolio</h3>
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <p class="mr-3 mb-0 lighter font-500 d-flex">
                                        Start date: &nbsp;<span class="dark">12.09.2019</span>
                                    </p>
                                    <p class="mr-3 mt-1 mt-sm-0 mb-0 lighter font-500 ">
                                        Currency: &nbsp;<span class="dark">USD</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-around mx-auto mt-3 mt-sm-0 m-md-0">
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#transactions">Deposit/Withdrawal</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_edit">Edit</button>
                            </div>
                            
                            <div class="custom-control custom-switch switch_portfolio mx-auto mx-sm-0 ml-sm-auto mt-3 mt-sm-auto">
                                <input type="checkbox" class="custom-control-input activate_portfolio" id="portfolio_id_dynamish" name="activate_portfolio" checked>
                                <label class="custom-control-label" for="portfolio_id_dynamish">Active</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="portfolio_info row col-lg-12 justify-content-sm-between justify-content-start align-content-center">
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">attach_money</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Start capital</p>
                                <h5 class="">7000 USD</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">attach_money</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Balance</p>
                                <h5 class="indigo">8142,14 USD</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">trending_up</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Win Rate</p>
                                <h5 class="">61.70 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <i class="material-icons dark icon-lg">list_alt</i>
                            <div class="ml-2">
                                <p class="p-0 m-0">Recorded Trades</p>
                                <h5 class="">&#35; 81</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                            <span class="material-icons dark icon-lg">show_chart</span>
                            <div class="ml-2">
                                <p class="p-0 m-0">Return</p>
                                <h5 class="">12.5 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3 ml-3 mb-lg-0">
                            <a href="#modal_delete" data-toggle="modal"><span class="material-icons icon-lg text-muted"
                            data-toggle="tooltip" data-placement="top"
                            title="Delete portfolio">delete_outline</span></a>
                        </div>
                    </div>
                </div>
            </main>
    
        </div>
    </div>
</div>
<x-modalDeleteItem :message="$message" :item="$item">
    <x-slot name="modal_body">
      <p>Delete POrtfolio?</p>
    <p>{{$item}}</p>
    </x-slot> 
</x-modalDeleteItem>

<x-modalEdititem :message="$message" :item="$item">
    <x-slot name="modal_body">
        <div class="form-group mb-4">
            <label for="portfolio_name">Portfolio name</label>
            <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                id="portfolio_name">
        </div>
        <div class="form-group mb-4">
            <label for="currency">Currency</label>
            <select id="currency" class="form-control" name="currency">
                <option value="usd">EUR</option>
                <option value="usd">USD</option>
                <option value="chf">CHF</option>
                <option value="aud">AUD</option>
                <option value="cad">CAD</option>
            </select>
        </div>
    </x-slot> 
</x-modalEdititem>

<x-modalCreateItem :message="$message" :item="$item">
    <x-slot name="modal_body">
        <div class="form-group mb-4">
            <label for="portfolio_name">Portfolio name</label>
            <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                id="portfolio_name">
        </div>
        <div class="form-group mb-4">
            <label for="start_capital">Amount start capital</label>
            <input type="text" name="start_capital" class="form-control" placeholder="Enter start capital"
                id="start_capital">
        </div>
        <div class="form-group mb-4">
            <label for="currency">Currency</label>
            <select id="currency" name="currency" class="form-control">
                <option value="usd">EUR</option>
                <option value="usd">USD</option>
                <option value="chf">CHF</option>
                <option value="aud">AUD</option>
                <option value="cad">CAD</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label for="start_date">Start date</label>
            <input type="date" name="start_date" class="form-control" id="Start date">
        </div>
    </x-slot> 
</x-modalCreateItem>