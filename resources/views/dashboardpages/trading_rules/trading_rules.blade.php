@extends('layouts.master')

@section('content')
<div class="main-content-container">
  
    <div class="content-container" >
        <section class="dashboard_container_content col-12 col-xl-10 p-0 pb-4 ">
            <div class="d-flex border-bottom p-4">
                <h4 class="font-weight-500 m-0">Rules</h4>
            </div>
            <div id="VueRules">
                <app-rules></app-rules>
            </div>
        </section>
    </div>
</div>
@endsection    