<div class="navbar_top">
    <div class="dark-navbar-992px">
        <h5>dataTrade</h5>
        <ul class="list-unstyled">
            <li class=""><a href="#" id=""><span class="material-icons toggle-sidebar">
                menu
                </span></a></li>
            <li class=""><a href="#" id="toggle-navbar"><span class="material-icons">person_outline</span></a></li>
        </ul> 
    </div>
    <div class="dropdown-user-992px" id="dropdown-user-992px">
        <div class="d-flex justify-content-center justify-content-sm-between flex-wrap ">
            <div class="top-left-bar">
                <ul class="list-unstyled text-center">
                    <li class="mr-1 " ><a href="{{route('trade_analysis')}}" class=" {{Request::is('tradeAnalysis') ? 'active-btn text-muted' : '' }}">Trade Analysis</a></li>
                    <li class="mr-1"><a href="{{route('trading_setups_analysis')}}" class="text-muted {{Request::is('trading_setups_analysis') ? 'active-btn' : '' }}">Trading Setups Analysis</a></li>
                </ul> 
            </div>
            <div class="top-right-bar">
                <ul class="list-unstyled">
                   {{--  <li class="dropright"><a type="button" href="#" class="" data-toggle="dropdown"><span class="material-icons cyan icon-md">
                        search
                        </span></a> 
                        <div class="dropdown-menu ">
                            <span class="material-icons lighter icon-sm">search</span>
                            <input type="text" class="search-input-dropdown-menu">
                        </div></li>
                    <li class=""><a href="#" class=""><span class="material-icons cyan icon-md">
                        language
                        </span></a> </li> --}}
                        <li class=" mr-3">
                            <a type="button" href="{{route('plan')}}" class="border">
                                <span class="dark font-weight-light">Plan: </span>
                                {{$plan->name ?? ""}}
                            </a>
                        </li>
                        <li class=""><span class="text-muted toggle-rightbar name_and_avatar">
                            {{strtok(Auth::user()->name, " ") }}
                            <span class="avatar-name font-lg text-uppercase">{{ Auth::user()->name[0] }}</span>
                        </span></li>
                   
                </ul> 
            </div>
        </div>
    </div>
    <div class="top-bar d-flex justify-content-between">
        <div class="top-left-bar">
            <ul class="list-unstyled">
                <li class="mr-1"><a href="{{route('trade_analysis')}}" class="text-muted {{Request::is('tradeAnalysis') ? 'active-btn' : '' }}">Trade Analysis</a></li>
                <li class="mr-1"><a href="{{route('trading_setups_analysis')}}" class="text-muted {{Request::is('trading_setups_analysis') ? 'active-btn' : '' }}">Trading Setups Analysis</a></li>
            </ul> 
        </div>
        
        <div class="top-right-bar">
            <ul class="list-unstyled ">
                {{-- <li class=""><a type="button" href="#" class="" data-toggle="dropdown"><span class="material-icons cyan icon-md">
                    search
                    </span></a> 
                    <div class="dropdown-menu dropdown-search">
                        <span class="material-icons lighter icon-sm">search</span>
                        <input type="text" class="search-input-dropdown-menu">
                    </div>
                </li>
                <li class=""><a href="#" class=""><span class="material-icons cyan icon-md">
                    language
                    </span></a>
                 </li> --}}
                 <li class=" mr-3">
                    <a type="button" href="{{route('plan')}}" class="border">
                        <span class="dark font-weight-light">Plan: </span>
                        {{$plan->name ?? ""}}
                    </a>
                 </li>

                
                <li class=""><span class="text-muted toggle-rightbar name_and_avatar">
                    {{strtok(Auth::user()->name, " ") }}
                    <span class="avatar-name font-lg text-uppercase">{{ Auth::user()->name[0] }}</span>
                </span>
            </li>
               
            </ul> 
        </div>
    </div>
   <app-navbar></app-navbar>
</div>
