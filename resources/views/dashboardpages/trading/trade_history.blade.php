@extends('layouts.master')

{{-- backdrop container--}}
<div id="cover" class=""></div>
<div class="main-content-container">
    
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
    @include('dashboardpages.portfolio.modalPortfolio')
    <div class="content-container" >
        <section class="dashboard_container_content">
            <div class="d-md-flex mb-3 ">

                <div class="form-group col-12 col-md-3 col-lg-3">
                    <label for="portfolio">Portfolio</label>
                    <select class="form-control" id="portfolio" name="portfolio">
                        <option value="Volvo">Test Portfolio 1</option>
                        <option value="Opel">Test Portfolio 2</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-3 col-lg-3">
                    <label for="sort_by_profit">Show</label>
                    <select id="sort_by_profit" class="form-control" name="sort_by_profit">
                        <option value="Volvo">All</option>
                        <option value="Opel">Winners</option>
                        <option value="Audi">Losers</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-4">
                    <label for="date">Trade date</label>
                    <div class="input-group">
                        <input type="date" id="date" class="form-control border-right-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text icon-sm material-icons px-0 mx-0">more_horiz</span>
                        </div>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="form-group col-12 col-md-2 col-lg-2 align-self-end mt-3 mt-lg-0 float-lg-right">
                    <div class="dropdown ">
                        <button type="button" class="btn btn-secondary" data-toggle="dropdown">
                            <span class="material-icons cyan mr-1">
                                view_agenda
                            </span>
                            View
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <h5 class="dropdown-header indigo">CHOOSE VIEW</h5>
                            <a class="dropdown-item" href="#"><span class="material-icons lighter icon-sm">
                                    toc
                                </span>Table</a>
                            <a class="dropdown-item" href="#"><span class="material-icons lighter icon-sm">
                                    calendar_view_day
                                </span>Large Row</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex col-12">
                <button type="button" class="btn btn-primary mr-3">
                    <span class="material-icons white mr-1">search</span>
                    Search
                </button>
                <button type="button" class="btn btn-secondary">
                    <span class="material-icons text-muted mr-1">clear</span>
                    Reset
                </button>
            </div>


        </section>

        <section class="dashboard_container_content">
            <div class="d-flex col-12 justify-content-start align-items-center">
                <label for="">Show</label>
                <div>
                    <select id="sort_by_profit" class="form-control" name="sort_by_profit">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <label for="">Trades</label>
            </div>
            <div class="d-md-flex mt-3 mb-2 justify-content-between">
                <div class="form-group col-12 col-md-3 mb-2">
                    <input type="text" class="form-control search-input" name="text" placeholder="Search Trade">
                    <span class="material-icons font-sm icon-sm search-i">search</span>
                </div>
                <div class="dropdown col mt-3 mt-md-0">
                    <button type="button" class="btn btn-primary float-md-right" data-toggle="dropdown">
                        <span class="material-icons white mr-1">description</span>Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <h5 class="dropdown-header indigo">OPTIONS</h5>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">PDF</a>
                        <a class="dropdown-item" href="#">Email</a>
                    </div>
                </div>

            </div>
            <div class="col px-0 px-md-3">
                <table class="table table-sm table-hover" style="display:none">
                    <thead class="">
                        <tr>
                            <th class="pl-3 pl-md-0">Symbol <span class="unicode-arrow">&#8645;</span></th>
                            <th>
                                <div class="d-none d-md-block">Quantity <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Type side<span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Entry price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Exit price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Sl price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Entry date <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Exit date <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th class="pl-3 pl-md-0">Profit <span class="unicode-arrow">&#8645;</span></th>
                            <th class="pl-3 pl-md-0">Actions <span class="unicode-arrow"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                             <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons" data-target="#modal_delete" data-toggle="modal">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="row p-0 justify-content-start large-row-view">

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="border rounded">
                            <div class="header-trade dropdown d-flex justify-content-between pb-3">
                                <h4 class="font-500 dark">AUDCAD</h4>
                                <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a class="dropdown-item" href="#">Except trade</a>
                                    <a class="dropdown-item" href="#">Deteils</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="" style="height: 80px">
                                <div class="d-flex flex-column justify-content-between ml-3">
                                    <span class=" font-500 lighter"><span class="red">SELL </span>12500 units</span>
                                    <div class="font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        attach_money
                                        </span>Profit: 185.50 Eur
                                    </div>
                                    <div class=" font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        calculate
                                        </span>Return: 1.20%
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-4">
                                <span><span>&#9900;</span> Entry Price:</span>
                                <span class="lighter">1.4585</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> Exit Price:</span>
                                <span class="lighter">1.4234</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> SL:</span>
                                <span class="lighter">1.5232</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2 mb-4">
                                <span><span>&#9900;</span> Date trade</span>
                                <span class="lighter">05 Mai 20 - 06 Mai 20</span>
                            </div>
                            <div class="commentar-container mx-0  mb-4">
                                <h5 class="px-3 pt-3">Trade commentar</h5>
                                <p class="p-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                                    incidunt nesciunt minus non.
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary red mr-3" data-target="#modal_delete" data-toggle="modal">Delete trade</button>
                                <button type="button" class="btn btn-primary close-trade-deteils">Deteils</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="border rounded">
                            <div class="header-trade dropdown d-flex justify-content-between pb-3">
                                <h4 class="font-500 dark">AUDCAD</h4>
                                <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a class="dropdown-item" href="#">Except trade</a>
                                    <a class="dropdown-item" href="#">Deteils</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="" style="height: 80px">
                                <div class="d-flex flex-column justify-content-between ml-3">
                                    <span class=" font-500 lighter"><span class="red">SELL </span>12500 units</span>
                                    <div class="font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        attach_money
                                        </span>Profit: 185.50 Eur
                                    </div>
                                    <div class=" font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        calculate
                                        </span>Return: 1.20%
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-4">
                                <span><span>&#9900;</span> Entry Price:</span>
                                <span class="lighter">1.4585</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> Exit Price:</span>
                                <span class="lighter">1.4234</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> SL:</span>
                                <span class="lighter">1.5232</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2 mb-4">
                                <span><span>&#9900;</span> Date trade</span>
                                <span class="lighter">05 Mai 20 - 06 Mai 20</span>
                            </div>
                            <div class="commentar-container mx-0  mb-4">
                                <h5 class="px-3 pt-3">Trade commentar</h5>
                                <p class="p-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                                    incidunt nesciunt minus non.
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary red mr-3" data-target="#modal_delete" data-toggle="modal">Delete trade</button>
                                <button type="button" class="btn btn-primary close-trade-deteils">Deteils</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="border rounded">
                            <div class="header-trade dropdown d-flex justify-content-between pb-3">
                                <h4 class="font-500 dark">AUDCAD</h4>
                                <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a class="dropdown-item" href="#">Except trade</a>
                                    <a class="dropdown-item" href="#">Deteils</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="" style="height: 80px">
                                <div class="d-flex flex-column justify-content-between ml-3">
                                    <span class=" font-500 lighter"><span class="red">SELL </span>12500 units</span>
                                    <div class="font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        attach_money
                                        </span>Profit: 185.50 Eur
                                    </div>
                                    <div class=" font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        calculate
                                        </span>Return: 1.20%
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-4">
                                <span><span>&#9900;</span> Entry Price:</span>
                                <span class="lighter">1.4585</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> Exit Price:</span>
                                <span class="lighter">1.4234</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> SL:</span>
                                <span class="lighter">1.5232</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2 mb-4">
                                <span><span>&#9900;</span> Date trade</span>
                                <span class="lighter">05 Mai 20 - 06 Mai 20</span>
                            </div>
                            <div class="commentar-container mx-0  mb-4">
                                <h5 class="px-3 pt-3">Trade commentar</h5>
                                <p class="p-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                                    incidunt nesciunt minus non.
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary red mr-3" data-target="#modal_delete" data-toggle="modal">Delete trade</button>
                                <button type="button" class="btn btn-primary close-trade-deteils">Deteils</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="border rounded">
                            <div class="header-trade dropdown d-flex justify-content-between pb-3">
                                <h4 class="font-500 dark">AUDCAD</h4>
                                <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <a class="dropdown-item" href="#">Except trade</a>
                                    <a class="dropdown-item" href="#">Deteils</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="" style="height: 80px">
                                <div class="d-flex flex-column justify-content-between ml-3">
                                    <span class=" font-500 lighter"><span class="red">SELL </span>12500 units</span>
                                    <div class="font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        attach_money
                                        </span>Profit: 185.50 Eur
                                    </div>
                                    <div class=" font-500 lighter d-flex align-items-center"><span class="material-icons lighter icon-sm">
                                        calculate
                                        </span>Return: 1.20%
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-4">
                                <span><span>&#9900;</span> Entry Price:</span>
                                <span class="lighter">1.4585</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> Exit Price:</span>
                                <span class="lighter">1.4234</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> SL:</span>
                                <span class="lighter">1.5232</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2 mb-4">
                                <span><span>&#9900;</span> Date trade</span>
                                <span class="lighter">05 Mai 20 - 06 Mai 20</span>
                            </div>
                            <div class="commentar-container mx-0  mb-4">
                                <h5 class="px-3 pt-3">Trade commentar</h5>
                                <p class="p-3">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                                    incidunt nesciunt minus non.
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary red mr-3" data-target="#modal_delete" data-toggle="modal">Delete trade</button>
                                <button type="button" class="btn btn-primary close-trade-deteils">Deteils</button>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                </div>
            </div>
            {{-- Pagination --}}
            <div class="d-flex">
                <ul class="pagination pagination-sm m-auto">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </section>
      
        
    </div>
    
<section class="trade_deteils" id="trade_deteils">
    <div class="header_trade_deteils align-items-center d-flex px-4 py-4">
        <div class="my-auto">
            <div class="d-flex align-content-center">
                <h4 class="font-weight-bold m-0">EURUSD / </h4 class="font-weight-bold">
                <h4><span class="font-weight-bold indigo ml-1 m-0">Buy</span></h4>
            </div>
            <p class="font-500 font-lg m-0">Test Portfolio 1 <span class="text-muted ">&nbsp;&nbsp; 12 Jan 2020</span></p>
        </div>
        <span class="material-icons icon-sm ml-auto close-btn close-trade-deteils">close</span>
    </div>

    <div class="scroll-content">
            <div class="img-container d-flex flex-column flex-md-row align-content-center">
                <div class="selected-img d-flex  align-items-center mb-3 mb-md-0">
                    
                    <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="">
                    <img src="https://www.tradingview.com/x/666Hwj5t/" alt="">
                    <img src="https://www.tradingview.com/x/l5DgNzQ0/" alt="">
                    
                </div>
                <div class="thumbnails-img d-flex d-flex-row flex-md-column justify-content-between">
                    <img onclick="currentSlide(1)" src="https://www.tradingview.com/x/NSwr4nQM/" alt="">
                    <img onclick="currentSlide(2)" src="https://www.tradingview.com/x/666Hwj5t/" alt="">
                    <img onclick="currentSlide(3)" src="https://www.tradingview.com/x/l5DgNzQ0/" alt="">
                </div>
            </div>
  

        <div class="buttons-img d-flex justify-content-center align-content-center mt-2">
            <button class="btn btn-primary ml-3" onclick="plusSlides(-1)">
                <span class="material-icons white p-0">keyboard_arrow_left</span>
            </button>
            <button class="btn btn-primary ml-3" onclick="plusSlides(1)">
                <span class="material-icons white p-0">keyboard_arrow_right</span>
            </button>
        </div>

        <div class="col-12 col-lg-10 row current-trade-performance px-4 px-lg-0 mx-lg-auto my-5">
            <div class="col-12 col-lg-9 pr-lg-5">
                <table class="">
                    <thead>
                        <tr>
                            <th class="font-md">DESCRIPTION</th>
                            <th class="font-md">ENTRY</th>
                            <th class="font-md">EXIT</th>
                            <th class="font-md">STOP LOSS</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center ">
                                <span class="material-icons cyan icon-sm mr-1">fiber_manual_record</span>
                                Price</div>
                        </td>
                        <td>1.5000</td>
                        <td>1.5030</td>
                        <td>1.4030</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center ">
                                <span class="material-icons text-muted icon-sm mr-1">fiber_manual_record</span>
                                Date</div>
                        </td>
                        <td>11 Jun 2020</td>
                        <td>13 Jun 2020</td>
                        <td>-</td>
                    </tr>
                </table>
                <hr class="py-1">
                <table class="table-rules">
                    <tr>
                        <td class="">
                            <div class="d-flex align-items-center ">
                                <span class="material-icons lighter icon-sm mr-1">fiber_manual_record</span>
                                <p>Entry Rules</p>
                            </div>
                        </td>
                        <td class="pl-2">
                            <div>
                                <span class="badge badge-light text-muted mb-1 mb-xl-0">double top confirmation</span>
                                <span class="badge badge-light text-muted mb-1 mb-xl-0">Rsi oversold</span>
                                <span class="badge badge-light text-muted mb-1 mb-xl-0">candlestick confirmation</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center ">
                                <span class="material-icons orange icon-sm mr-1">fiber_manual_record</span>
                                <p>Exit Reason</p>
                            </div>
                        </td>
                        <td class="pl-2"><span class="badge bg-orange red">SL Hit</span></td>

                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center ">
                                <span class="material-icons cyan icon-sm mr-1">fiber_manual_record</span>
                                <p>Used strategy
                            </div>
                        </td>
                        </p>
                        <td class="pl-2"><span class="badge badge-light cyan">Double top retest 0.618</span></td>
                    </tr>
                </table>
                <hr class="py-1">
                <div class="trade-comentar-container d-flex align-items-strat">
                    <div class="commentar-icon rounded-circle">
                        <span class="material-icons cyan" style="transform: scale(-1, 1);">
                            chat_bubble_outline
                        </span>
                    </div>
                    <div class="commentar-container ml-3">
                        <h5 class="pt-3 pl-3">Trade commentar</h5>
                        <p class="p-3">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                            tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                            incidunt nesciunt minus non.
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="profit-container">
                    <div class="pb-4 pt-3">
                        <h4 class="font-weight-bold lighter">PROFIT</h4>
                        <h2>185,41 EUR</h2>
                        <h5 class="font-500">15.6 PIPS </h5>
                    </div>
                    <div class="py-4 border-top">
                        <h5 class="lighter"><span>&#9900;</span> RETURN</h5>
                        <h5 class="">1.27%</h5>
                    </div>

                    <div class="py-4 border-top">
                        <h5 class="lighter"><span>&#9900;</span>  DRADE DURATION  </h5>
                        <h5 class="">1.5 days</h5>
                    </div>
                    <div class="py-4 border-top">
                        <h5 class="lighter"><span>&#9900;</span> RISK REWARD  </h5>
                        <h5 class="">3.50</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</div>

  {{-- modal delete trade --}}
<x-modalDeleteItem :message="$message">
</x-modalDeleteItem>