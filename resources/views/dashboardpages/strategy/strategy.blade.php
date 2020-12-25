
@extends('layouts.master')

@section('content')

<div class="main-content-container">

    
    <div class="content-container">
        <section class="dashboard_container_content col-12 p-0 pb-4">
            <div class="d-flex border-bottom p-4">
                <h4 class="font-weight-500 m-0">Strategies</h4>
            </div>
            <div class="d-md-flex p-4">
                <div class="name_description_container col-12 col-md-6 pl-0">
                    <div class="">
                        <div class="form-group">
                            <label for="quantity">Strategy name</span></label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="Min 2 charachters">
                        </div> 
                        <div class="drop_img mt-3">
                            <div class="img_list text-center mt-4">
                                <span class="material-icons icon-xl indigo">cloud_upload</span>
                                <h4>Drag and drop chart image here or click to upload</h4>
                                <p class="text-muted">Upload up to 3 files</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mt-md-0">
                    <div class="form-group ">
                        <label for="textarea">Strategy description</label>
                        <textarea name="textarea" class="form-control" id="mytext" cols="30" rows="3"></textarea>
                    </div>
                   
                </div>  
            </div>
            <div class="d-flex justify-content-start align-items-center pt-2 pb-3 px-4">
                <button type="button" class="btn btn-primary font-weight-500 mt-2 mt-md-0" data-target="#modal_create"
                    data-toggle="modal">Create Strategy</button>
            </div>
        
        </section>
        <div class="row justify-content-between strategies_container">
            <div class="col-12 col-md-6 strategy-container-from-here">
                <div class="p-0">
                    <div class="border-bottom p-4 d-flex justify-content-between align-items-center">
                        <h4 class="font-500 m-0">My Forex test Strategy</h4>
                        <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <h5 class="dropdown-header indigo">OPTIONS</h5>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                            <a class="dropdown-item" href="#">Deteiled analysis</a>
                        </div>
                    </div>
                    <div class="strategy_img_container p-4">
                        <img src="https://www.tradingview.com/x/ANOGgEdq/" alt="">   
                    </div>
                    <div class="p-4 ">
                        <span class="">
                            1. Lorem, ipsum dolor sit amet <b>consectetur adipisicing elit. Praesentium nesciunt eos modi</b>  iste sapien
                            2. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium nesciunt eos modi iste sapien
                            3. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium nesciunt eos modi iste sapien
                            
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos asperiores aliquid quis quo possimus. At possimus sed vero laudantiu
                            m aperiam, magnam, molestias provident maiores in, facilis dolorum cum iusto distinctio!
                        </span>
                    </div>
                    <div class="d-flex justify-content-around border-top p-3">
                        <div class="d-flex align-items-center">
                            <img src="/storage/icons/list.svg" alt="">
                            <div class="ml-2">
                                <p class="p-0 m-0">Trades</p>
                                <h5 class="">&#35; 81</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <img src="/storage/icons/area-line.svg" alt="">
                            <div class="ml-2">
                                <p class="p-0 m-0">Success</p>
                                <h5 class="">45,85 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <img src="/storage/icons/area-line.svg" alt="">
                            <div class="ml-2">
                                <p class="p-0 m-0">Used</p>
                                <h5 class="">54.40 %</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>


<div class="modal" id="modal_create">
    <div class="modal-dialog ">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn icon-sm">close</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="portfolio_name">Strategy name</label>
                    <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create</button>

            </div>

        </form>
    </div>
</div>

@endsection
