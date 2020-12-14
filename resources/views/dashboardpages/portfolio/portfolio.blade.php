@extends('layouts.master')

<div class="main-content-container">
    @include('layouts.sidebar')
    @include('layouts.navbar')
    @include('layouts.rightbar')
    {{-- @include('dashboardpages.portfolio.modalPortfolio') --}}
    <div class="content-container" id="VuePortfolio">

        <crud-app></crud-app>
           
    </div>
</div>

