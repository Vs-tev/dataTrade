<div class="navbar_top">
    <div class="dark-navbar-992px">
        <h5>dataTrade</h5>
        <ul class="list-unstyled">
            <li class=""><a href="#" id="toggle-sidebar"><span class="material-icons">
                menu
                </span></a></li>
            <li class=""><a href="#" id="toggle-navbar"><span class="material-icons">person_outline</span></a></li>
        </ul> 
    </div>
    <div class="dropdown-user-992px" id="dropdown-user-992px">
        <div class="d-flex justify-content-center justify-content-sm-between flex-wrap ">
            <div class="top-left-bar">
                <ul class="list-unstyled">
                    <li class=""><a href="#" class="text-muted">Trading Analysis</a></li>
                    <li class=""><a href="#" class="text-muted">Strategy Analysis</a></li>
                    <li class=""><a href="#" class="text-muted ">Rules Analysis</a></li>
                </ul> 
            </div>
            <div class="top-right-bar">
                <ul class="list-unstyled">
                    <li class="dropright"><a type="button" href="#" class="" data-toggle="dropdown"><span class="material-icons cyan icon-md">
                        search
                        </span></a> 
                        <div class="dropdown-menu ">
                            <span class="material-icons lighter icon-sm">search</span>
                            <input type="text" class="search-input-dropdown-menu">
                        </div></li>
                    <li class=""><a href="#" class=""><span class="material-icons cyan icon-md">
                        language
                        </span></a> </li>
                    <li class=""><a href="#" class="text-muted toggle-rightbar name_and_avatar">
                        Vasil 
                        <span class="avatar-name font-lg">V</span>
                    </a></li>
                   
                </ul> 
            </div>
        </div>
    </div>
    <div class="top-bar d-flex justify-content-between">
        <div class="top-left-bar">
            <ul class="list-unstyled">
                <li class="mr-1"><a href="#" class="text-muted active-btn">Trade Analysis</a></li>
                <li class="mr-1"><a href="#" class="text-muted">Strategy Analysis</a></li>
                <li class="mr-1"><a href="#" class="text-muted">Rules Analysis</a></li>
            </ul> 
        </div>
        
        <div class="top-right-bar">
            <ul class="list-unstyled ">
                <li class=""><a type="button" href="#" class="" data-toggle="dropdown"><span class="material-icons cyan icon-md">
                    search
                    </span></a> 
                    <div class="dropdown-menu dropdown-search">
                        <span class="material-icons lighter icon-sm">search</span>
                        <input type="text" class="search-input-dropdown-menu">
                    </div>
                </li>
                <li class=""><a href="#" class=""><span class="material-icons cyan icon-md">
                    language
                    </span></a> </li>
                <li class=""><span class="text-muted toggle-rightbar name_and_avatar">
                    {{strtok(Auth::user()->name, " ") }}
                    <span class="avatar-name font-lg text-uppercase">{{ Auth::user()->name[0] }}</span>
                </span></li>
               
            </ul> 
        </div>
    </div>
    <div class="downbar">
        <div class="down-left d-flex justify-content-between">
            <ul class="list-unstyled">
                <li class="mr-3"><span class="font-lg dark">&#8226; Trade Record</span></li>
                <li class=""><a href="#" class="lighter">the name of active portfolio (Actual Balance )</a> </li>
            </ul> 
        </div>
    </div>
</div>
