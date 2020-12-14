<div class="rightbar_container p-4" id="rightbar_container">
        <div class="d-flex align-items-center py-2">
            <h4>User Profile</h4>
            <span class="material-icons icon-sm toggle-rightbar ml-auto close-btn">close</span>
        </div>
    <div class="scroll_content">
            <div class="avatar_and_info d-flex mt-4">
            <span class="avatar text-uppercase">{{Auth::user()->name[0]}}</span>
                <div class="ml-3">
                    <p class="font-lg">{{Auth::user()->name}}</p>
                    <p class="text-muted d-flex align-items-center"><span class="material-icons cyan mr-1">email</span> 
                        {{Auth::user()->email}}</p>
                    <a type="button" class="btn btn-primary" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sing out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                   </form>
                </div>
            </div>
        <hr>
        <p class="font-lg text-muted my-4">Settings</p>
        <div class="settings-container d-flex">     
            <span class="material-icons icon-lg indigo" style="transform: rotate(90deg) scale(1,-1)">
                vpn_key
            </span>
            <div class="ml-3">
               <a href="#"><h5>Change Password</h5></a>
               <p class="m-0 p-1">&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;</p>
            </div>
        </div>
        <div class="settings-container d-flex">     
            <span class="material-icons icon-lg indigo">
                mail
            </span>
            <div class="ml-3">
               <a href="#"><h5 class="m-0 p-1">Change Email</h5></a> 
               <p class="m-0 p-1 text-muted">{{Auth::user()->email}}</p>
            </div>
        </div>
        <div class="settings-container d-flex">     
            <span class="material-icons icon-lg indigo">
                    account_balance_wallet 
            </span>
            <div class="ml-3">
               <a href="#"><h5 class="m-0 p-1">Manage Portfolios</h5></a> 
               <p class="m-0 p-1 text-muted">2 portfolios</p>
            </div>
        </div>
    </div>
</div>