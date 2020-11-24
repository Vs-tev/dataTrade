@extends('layouts.master')
<div class="main-content-container">
    
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
  
    <div class="content-container">
        <section class="dashboard_container_content col-12 col-xl-10 p-0 pb-4">
            <div class="d-flex border-bottom p-4">
                <h4 class="font-weight-500 m-0">Trading Strategies</h4>
            </div>
            <div class="d-flex justify-content-end align-items-center pt-4 pb-3 px-4">
                <button type="button" class="btn btn-primary font-weight-500 mt-2 mt-md-0" data-target="#modal_create" data-toggle="modal">Add New Strategy</button>
            </div>
            <div class="col strategy-table-div px-2 px-sm-4">
                <table class="table table-strategy">
                    <thead >
                        <tr>
                        <th class="font-500 font-md">STRATEGY NAME</th>
                        <th class="lighter font-md font-500 d-none d-md-flex"># TRADES</th>
                        <th class="lighter font-md font-500 "><div class="d-none d-md-block">SUCCESS</div></th>
                        <th class="lighter font-md font-500">ACTION</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        {{-- strategy stat --}}
                        <tr class="strategy-first-tr">
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar-letter m-0 h3 lighter">2</span>
                                    <div class="">
                                        <span class="m-0 p-0 font-normal font-weight-bold">2 Top</span>
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
                        <tr class="strategy-description">
                          <td colspan="4">
                              <div class="description-container mx-0">
                                    <p class="font-md font-500">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiinonnsequatur, illum illo accusamus?
                            </p>
                            </div>
                        </td> 
                        </tr>
                        {{--strategy end  --}}


                       <tr class="strategy-first-tr">
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="avatar-letter m-0 h3 lighter">9/5</span>
                                <div class="">
                                    <span class="m-0 p-0 font-normal font-weight-bold">9/5 buy stop strategy</span>
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
                   <tr class="strategy-description">
                      <td colspan="4">
                          <div class="description-container mx-0">
                                <p class="font-md font-500">
                                ssLorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                tempora sint blanditiinonnsequatur, illum illo accusamus?
                        </p>
                        </div>
                    </td> 
                   </tr>

                   <tr class="strategy-first-tr">
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="avatar-letter m-0 h3 lighter">F</span>
                            <div class="">
                                <span class="m-0 p-0 font-normal font-weight-bold">9/5 buy stop strategy</span>
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
               <tr class="strategy-description">
                  <td colspan="4">
                      <div class="description-container mx-0">
                            <p class="font-md font-500">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                            tempora sint blanditiinonnsequatur, illum illo accusamus?
                    </p>
                    </div>
                </td> 
               </tr>
                    </tbody>
            </table>
        </div>
        </section>
    </div>
</div>
<x-modalDeleteItem :message="$message" :item="$item">
    <x-slot name="modal_body">
    <p>{{$message}}</p>
        <h6>Delete strategy</h6>
    </x-slot> 
</x-modalDeleteItem>
<x-modalEdititem :message="$message" :item="$item">
    <x-slot name="modal_body">
        <div class="form-group mb-4">
            <label for="name">Strategy name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter portfolio name"
                id="name">
        </div>
        <div class="form-group mb-4">
            <label for="portfolio_name">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4"></textarea>
        </div>
    </x-slot> 
</x-modalEdititem>
<x-modalCreateItem :message="$message" :item="$item">
    <x-slot name="modal_body">
        <div class="form-group mb-4">
            <label for="portfolio_name">Strategy name</label>
            <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                id="portfolio_name">
        </div>
        <div class="form-group mb-4">
            <label for="portfolio_name">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4"></textarea>
        </div>
    </x-slot> 
</x-modalCreateItem>