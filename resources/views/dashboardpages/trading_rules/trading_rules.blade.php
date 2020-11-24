@extends('layouts.master')
<div class="main-content-container">
    
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
  
    <div class="content-container" >
        <section class="dashboard_container_content col-12 col-xl-10 p-0 pb-4 ">
            <div class="d-flex border-bottom p-4">
                <h4 class="font-weight-500 m-0">Rules</h4>
            </div>
           
            
            <ul class="nav nav-tabs mt-4 mx-4 mb-2" role="tablist"> 
                <li class="nav-item"><a href="#entry_rule" class="nav-link active font-normal" role="tab" data-toggle="tab" aria-selected="true">Entry Rules</a></li>
                <li class="nav-item"><a href="#exit_reason" class="nav-link font-normal" role="tab" data-toggle="tab" aria-selected="true">Exit Reason</a></li>
            </ul>
            <div class="tab-content">
                <div id="entry_rule" class="tab-pane active" role="tabpanel">
                    <div class="d-block d-md-flex justify-content-between align-items-center pt-4 pb-3 px-4">
                        <div class="form-group px-0 col-12 col-md-3">
                            <input type="text" class="form-control search-input" name="text" placeholder="Search rule">
                            <span class="material-icons font-sm icon-sm search-i">search</span>
                        </div>
                            <button type="button" class="btn btn-primary font-weight-500 mt-2 mt-md-0" data-target="#modal_create" data-toggle="modal">Add New Rule</button>
                    </div>
                    <div class="col rule-table-div px-2 px-sm-4">
                            <table class="table table-rules">
                                <thead >
                                    <tr>
                                    <th class="font-500 font-md">ENTRY RULE</th>
                                    <th class="lighter font-md font-500 d-none d-md-flex"># TRADES</th>
                                    <th class="lighter font-md font-500 "><div class="d-none d-md-block">SUCCESS</div></th>
                                    <th class="lighter font-md font-500">ACTION</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar-letter m-0 h3 lighter">F</span>
                                                <div class="">
                                                    <span class="m-0 p-0 font-normal font-weight-bold">Fib. confirmation</span>
                                                    <p class="m-0 p-0 lighter font-md font-500">Created: 12 Jun 19</p>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td class="d-none d-md-block">12 Trades
                                            <p class="m-0 p-0 lighter font-md font-500">Last: 6 days ago</p>
                                        </td>
                                        <td class="">
                                            <span class="d-none d-md-inline badge badge-light font-sm font-500 text-muted">28%</span>
                                        </td>
                                        <td>
                                            <div class="flex-inline td-action">
                                                <span class="material-icons icon-sm indigo" data-target="#modal_edit" data-toggle="modal">edit</span>
                                                <span class="material-icons icon-sm indigo ml-2 ml-sm-3" data-target="#modal_delete" data-toggle="modal">delete_outline</span>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                        </table>
                    </div>
                </div>
                <div id="exit_reason" class="tab-pane " role="tabpanel">
                    <div class="d-block d-md-flex justify-content-between align-items-center pt-4 pb-3 px-4">
                        <div class="form-group px-0 col-12 col-md-3">
                            <input type="text" class="form-control search-input" name="text" placeholder="Search rule">
                            <span class="material-icons font-sm icon-sm search-i">search</span>
                        </div>
                            <button type="button" class="btn btn-primary font-weight-500 mt-2 mt-md-0" data-target="#modal_create" data-toggle="modal">Add New Rule</button>
                    </div>
                    <div class="col rule-table-div px-2 px-sm-4">
                        <table class="table table-rules">
                            <thead >
                                <tr>
                                <th class="font-500 font-md">EXIT REASON</th>
                                <th class="lighter font-md font-500 d-none d-md-flex"># TRADES</th>
                                <th class="lighter font-md font-500 "><div class="d-none d-md-block">SUCCESS</div></th>
                                <th class="lighter font-md font-500">ACTION</th>
                                </tr>
                                
                            </thead>
                            <tbody >
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar-letter m-0 h3 lighter">S</span>
                                            <div class="">
                                                <span class="m-0 p-0 font-normal font-weight-bold">Stop loss hit</span>
                                                <p class="m-0 p-0 lighter font-md font-500">Created: 06 Jun 19</p>
                                            </div>
                                        </div>
                                        
                                    </td>
                                    <td class="d-none d-md-block">1 Trades
                                        <p class="m-0 p-0 lighter font-md font-500">Last: 6 days ago</p>
                                    </td>
                                    <td class="">
                                        <span class="d-none d-md-inline badge badge-light font-sm font-500 text-muted">100%</span>
                                    </td>
                                    <td>
                                        <div class="flex-inline td-action">
                                            <span class="material-icons indigo icon-sm" data-target="#modal_edit" data-toggle="modal">edit</span>
                                            <span class="material-icons indigo icon-sm ml-3" data-target="#modal_delete" data-toggle="modal">delete_outline</span>
                                        </div>
                                    </td>
                                </tr>
                               
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <x-modalDeleteItem :message="$message" :item="$item">
        <x-slot name="modal_body">
        <p>{{$message}}</p>
            <h6>Delete rule</h6>
        </x-slot> 
    </x-modalDeleteItem>
    <x-modalEdititem :message="$message" :item="$item">
        <x-slot name="modal_body">
            <div class="form-group mb-4">
                <label for="portfolio_name">Rule name</label>
                <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                    id="portfolio_name">
            </div>
        </x-slot> 
    </x-modalEdititem>
    <x-modalCreateItem :message="$message" :item="$item">
        <x-slot name="modal_body">
            <div class="form-group mb-4">
                <label for="portfolio_name">Rule name</label>
                <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                    id="portfolio_name">
            </div>
        </x-slot> 
    </x-modalCreateItem>