<div class="sidebar hide-show-sidebar" id="sidebar" >
    <div class="sidebar-title">
        <h2>dataTrade</h2>
        <span class="material-icons icon-sm toggle-sidebar">
            close
         </span>
    </div>
    <div class="p-1">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class=""><a href="{{route('dashboard')}}" class=""><span class="material-icons">
                            dashboard</span>Dashboard</a></li>
                <li class=""><a href="{{route('portfolio')}}" class=""><span class="material-icons">
                            account_balance_wallet</span>Portfolio</a></li>
                <li class=""><h5 class="separator">Trading</h5></li>

                <li class=""><a href="{{route('trade_record')}}" class=""><span class="material-icons">
                            insert_chart_outlined</span>Trade Record</a></li>
                <li class=""><a href="{{route('trade_history')}}" class=""><span class="material-icons">
                            history</span>Trades History</a></li>

                <li class=""><h5 class="separator">Trading Steup</h5> </li>
                <li class=""><a href="{{route('trading_rules')}}" class="">
                    <span class="material-icons">rule</span>Trading Rules</a> 
                </li>
                <li class=""><a href="{{route('strategy')}}" class=""><span class="material-icons">
                            settings_applications</span>Strategy</a></li>

                <li class=""><h5 class="separator">Billing</h5> </li>  
                <li class=""><a href="{{route('plan')}}" class="">
                    <span class="material-icons">payments</span>Plans</a> 
                </li>     
                <li class=""><a href="{{route('payment_methods')}}" class="">
                    <span class="material-icons">payment</span>Payment methods</a> 
                </li>  
                <li class=""><a href="{{route('payment_methods.dashboard')}}" class="">
                    <span class="material-icons">dashboard_customize</span>Feautures</a> 
                </li>                    
            </ul>
        </div>
    </div>
</div>

<div class="small-sidebar">
    <div class="sidebar-title">
        <span class="material-icons expand-sidebar">
            double_arrow
            </span>
    </div>
    <div class="p-1">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="">
                    <a href="{{route('dashboard')}}" class="">
                        <span class="material-icons">dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{route('portfolio')}}" class="">
                        <span class="material-icons">account_balance_wallet</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('trade_record')}}" class="">
                        <span class="material-icons">insert_chart_outlined</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="{{route('trade_history')}}" class="">
                        <span class="material-icons">history</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('trading_rules')}}" class="">
                        <span class="material-icons">rule</span>
                    </a> 
                </li>
                <li class="mb-4">
                    <a href="{{route('strategy')}}" class="">
                        <span class="material-icons">settings_applications</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('plan')}}" class="">
                        <span class="material-icons">payments</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('payment_methods')}}" class="">
                        <span class="material-icons">payment</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('payment_methods.dashboard')}}" class="">
                        <span class="material-icons">dashboard_customize</span>
                    </a>
                </li>            
            </ul>
        </div>
    </div>
</div>