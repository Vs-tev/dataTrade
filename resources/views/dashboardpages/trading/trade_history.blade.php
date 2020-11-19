@extends('layouts.master')

<div class="main-content-container">
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
    @include('dashboardpages.portfolio.modalPortfolio')
    <div class="content-container ">
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
                            <span class="input-group-text material-icons px-0 mx-0">more_horiz</span>
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
                        <option value="Volvo">10</option>
                        <option value="Opel">25</option>
                        <option value="Audi">50</option>
                    </select>
                </div>
               
                <label for="">Trades</label>
            </div>
            <div class="d-md-flex mt-3 mb-2 justify-content-between">
                <div class="form-group col-12 col-md-3 mb-2">
                    <input type="text" class="form-control search-input" name="text" placeholder="Search Trade">
                    <span class="material-icons search-i">search</span>
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
                <table class="table table-sm table-hover">
                    <thead class="">
                        <tr>
                            <th class="pl-3 pl-md-0">Symbol <span class="unicode-arrow">&#8645;</span></th>
                            <th><div class="d-none d-md-block">Quantity <span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Type side<span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Entry price <span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Exit price <span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Sl price <span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Entry date <span class="unicode-arrow">&#8645;</span></div></th>
                            <th><div class="d-none d-md-block">Exit date <span class="unicode-arrow">&#8645;</span></div></th>
                            <th class="pl-3 pl-md-0">Profit <span class="unicode-arrow">&#8645;</span></th>
                            <th class="pl-3 pl-md-0">Actions <span class="unicode-arrow"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td><div class="d-none d-md-block">85000</div></td>
                            <td><div class="d-none d-md-block">SELL</div></td>
                            <td><div class="d-none d-md-block">1.45000</div></td>
                            <td><div class="d-none d-md-block">1.45620</div></td>
                            <td><div class="d-none d-md-block">1.44950</div></td>
                            <td><div class="d-none d-md-block">10.11.20</div></div></td>
                            <td><div class="d-none d-md-block">12.11.20</div></td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span
                                            class="material-icons">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td><div class="d-none d-md-block">85000</div></td>
                            <td><div class="d-none d-md-block">SELL</div></td>
                            <td><div class="d-none d-md-block">1.45000</div></td>
                            <td><div class="d-none d-md-block">1.45620</div></td>
                            <td><div class="d-none d-md-block">1.44950</div></td>
                            <td><div class="d-none d-md-block">10.11.20</div></td>
                            <td><div class="d-none d-md-block">12.11.20</div></td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span
                                            class="material-icons">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td><div class="d-none d-md-block">85000</div></td>
                            <td><div class="d-none d-md-block">SELL</div></td>
                            <td><div class="d-none d-md-block">1.45000</div></td>
                            <td><div class="d-none d-md-block">1.45620</div></td>
                            <td><div class="d-none d-md-block">1.44950</div></td>
                            <td><div class="d-none d-md-block">10.11.20</div></td>
                            <td><div class="d-none d-md-block">12.11.20</div></td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span
                                            class="material-icons">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td><div class="d-none d-md-block">85000</div></td>
                            <td><div class="d-none d-md-block">SELL</div></td>
                            <td><div class="d-none d-md-block">1.45000</div></td>
                            <td><div class="d-none d-md-block">1.45620</div></td>
                            <td><div class="d-none d-md-block">1.44950</div></td>
                            <td><div class="d-none d-md-block">10.11.20</div></td>
                            <td><div class="d-none d-md-block">12.11.20</div></td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span
                                            class="material-icons">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td><div class="d-none d-md-block">85000</div></td>
                            <td><div class="d-none d-md-block">SELL</div></td>
                            <td><div class="d-none d-md-block">1.45000</div></td>
                            <td><div class="d-none d-md-block">1.45620</div></td>
                            <td><div class="d-none d-md-block">1.44950</div></td>
                            <td><div class="d-none d-md-block">10.11.20</div></td>
                            <td><div class="d-none d-md-block">12.11.20</div></td>
                            <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span
                                            class="material-icons">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons">delete</span></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
</div>
