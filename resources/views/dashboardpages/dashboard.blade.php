@extends('layouts.master')

@section('content')

<div class="main-content-container">
   
    <div class="content-container">
        <div class="row justify-content-start">
            <div class="col-md-4 pb-3 px-3 ">
                <a href="{{route('user_settings')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#0099ff" fill-opacity="0.08"
                            d="M0,224L120,197.3C240,171,480,117,720,122.7C960,128,1200,192,1320,224L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">manage_accounts</span>
                    <div class="ml-4">
                        <div  class="dark font-weight-bold m-0">
                            <h4>User</h4>
                        </div>
                        <p class="m-0 text-muted">Edit User</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-4 px-3">
                <a href="{{route('portfolio')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#e7008a" fill-opacity="0.08"
                            d="M0,288L80,282.7C160,277,320,267,480,229.3C640,192,800,128,960,96C1120,64,1280,64,1360,64L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">account_balance_wallet</span>
                    <div class="ml-4">
                        <div  class="dark font-weight-bold m-0">
                            <h4>Portfolio</h4>
                        </div>
                        <p class="m-0 text-muted">Manage Portfolio</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-4 px-3 ">
                <a href="{{route('trade_record')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#a2d9ff" fill-opacity="0.12"
                            d="M0,160L120,186.7C240,213,480,267,720,240C960,213,1200,107,1320,53.3L1440,0L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">insert_chart_outlined</span>
                    <div class="ml-4">
                        <div  class="dark font-weight-bold m-0">
                            <h4>Recording Trades</h4>
                        </div>
                        <p class="m-0 text-muted">Make a Record</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-4 px-3 ">
                <a href="{{route('trade_history')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#ffd700" fill-opacity="0.04"
                            d="M0,128L120,122.7C240,117,480,107,720,122.7C960,139,1200,181,1320,202.7L1440,224L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">restore</span>
                    <div class="ml-4">
                        <div class="dark font-weight-bold m-0">
                            <h4>Trade History</h4>
                        </div>
                        <p class="m-0 text-muted">Manage Trades History</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-3 px-3">
                <a href="{{route('trading_rules')}}" class="dashboard_container_content dashboard-item dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#e3342f" fill-opacity="0.08"
                            d="M0,32L120,69.3C240,107,480,181,720,218.7C960,256,1200,256,1320,256L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">rule</span>
                    <div class="ml-4">
                        <div class="dark font-weight-bold m-0">
                            <h4>Trading Rules</h4>
                        </div>
                        <p class="m-0 text-muted">Manage Trading Rules</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-3 px-3 ">
                <a href="{{route('strategy')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#6c757d" fill-opacity="0.08"
                            d="M0,224L120,197.3C240,171,480,117,720,122.7C960,128,1200,192,1320,224L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">settings_applications</span>
                    <div class="ml-4">
                        <div class="dark font-weight-bold m-0">
                            <h4>Strategy</h4>
                        </div>
                        <p class="m-0 text-muted">Manage Strategies</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 pb-3 px-3 ">
                <a href="{{ route('plan')}}" class="dashboard_container_content dashboard-item d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="#0099ff" fill-opacity="0.08"
                            d="M0,224L120,197.3C240,171,480,117,720,122.7C960,128,1200,192,1320,224L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                        </path>
                    </svg>
                    <span class="material-icons cyan icon-xl">payment</span>
                    <div class="ml-4">
                        <div  class="dark font-weight-bold m-0">
                            <h4>Billing</h4>
                        </div>
                        <p class="m-0 text-muted">Upgrade subscription and payment methods</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection