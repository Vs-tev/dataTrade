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
                    <button class="btn btn-primary" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sing out</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                   </form>
                </div>
            </div>
        <hr>
        <p class="font-lg text-muted my-4">Settings</p>
        <a href="{{route('user_settings')}}" class="settings-container d-flex">     
            <span class="material-icons icon-lg indigo">
                manage_accounts
            </span>
            <div class="ml-3">
              <h5 class="m-0 p-1">User settings</h5>
               <p class="m-0 p-1 text-muted">{{Auth::user()->email}}</p>
            </div>
        </a>
        <hr>
        <a class="settings-container d-flex" href="{{ route('plan') }}">     
            <span class="material-icons icon-lg indigo">
                payment
            </span>
            <div class="ml-3">
               <h5 class="m-0 p-1">Plans</h5>
               <p class="m-0 p-1 text-muted">Billing</p>
            </div>
        </a>
    </div>
</div>