
@extends('layouts.master')

@section('content')

<div class="main-content-container">
    
    <div id="VueStrategies">
        <app-strategies></app-strategies>
    </div>
    {{-- <select class="easySelect" id="" >
        @foreach ($strategy as $item)
            <option value="">{{$item->name}}</option> 
        @endforeach
   
    </select> --}}

</div>


<div class="modal" id="modal_create">
    <div class="modal-dialog ">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn icon-sm">close</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="portfolio_name">Strategy name</label>
                    <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                </div>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create</button>

            </div>

        </form>
    </div>
</div>

@endsection
