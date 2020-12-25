@extends('layouts.master')

@section('content')

<div class="main-content-container">
   
    <div class="content-container">
        <div class="row justify-content-start">
            <div class="col-md-4 pb-4 px-3">
                <div class="dashboard_container_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#e7008a" fill-opacity="0.03"
                            d="M0,288L80,282.7C160,277,320,267,480,229.3C640,192,800,128,960,96C1120,64,1280,64,1360,64L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">account_balance_wallet</span>
                    <div class="ml-4">
                        <a href="portfolio" class="dark font-weight-bold m-0">
                            <h4>Portfolio</h4>
                        </a>
                        <p class="m-0 text-muted">Manage Portfolio</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-4 px-3 ">
                <div class="dashboard_container_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#a2d9ff" fill-opacity="0.12"
                            d="M0,160L120,186.7C240,213,480,267,720,240C960,213,1200,107,1320,53.3L1440,0L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">insert_chart_outlined</span>
                    <div class="ml-4">
                        <a href="traderecord" class="dark font-weight-bold m-0">
                            <h4>Recording Trades</h4>
                        </a>
                        <p class="m-0 text-muted">Make a Record</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-4 px-3 ">
                <div class="dashboard_container_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#ffd700" fill-opacity="0.04"
                            d="M0,128L120,122.7C240,117,480,107,720,122.7C960,139,1200,181,1320,202.7L1440,224L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">restore</span>
                    <div class="ml-4">
                        <a href="tradehistory" class="dark font-weight-bold m-0">
                            <h4>Trade History</h4>
                        </a>
                        <p class="m-0 text-muted">Manage Trades History</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3 px-3">
                <div class="dashboard_container_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#ff5500" fill-opacity="0.04"
                            d="M0,32L120,69.3C240,107,480,181,720,218.7C960,256,1200,256,1320,256L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">rule</span>
                    <div class="ml-4">
                        <a href="tradingrules" class="dark font-weight-bold m-0">
                            <h4>Trading Rules</h4>
                        </a>
                        <p class="m-0 text-muted">Manage Trading Rules</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3 px-3 ">
                <div class="dashboard_container_content d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#0099ff" fill-opacity="0.06"
                            d="M0,224L120,197.3C240,171,480,117,720,122.7C960,128,1200,192,1320,224L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">settings_applications</span>
                    <div class="ml-4">
                        <a href="strategy" class="dark font-weight-bold m-0">
                            <h4>Strategy</h4>
                        </a>
                        <p class="m-0 text-muted">Manage Strategies</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection