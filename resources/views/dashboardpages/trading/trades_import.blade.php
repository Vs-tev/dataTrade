@extends('layouts.master')

@section('content')

<div class="main-content-container">
  
   
    <div class="content-container">
        <section class="dashboard_container_content p-0 mb-4">  
            <div class="border-bottom px-4 py-3">
            <h4 class="font-weight-normal m-0">Instructions </h4>
        </div>
        </section>
        <section class="dashboard_container_content p-0">  
            <div class="border-bottom px-4 py-3">
              <h4 class="font-weight-normal m-0">Import Trades</h4>
            </div>
            <form class="d-md-flex flex-wrap mb-3" action="trades/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-12 p-0">
                    

               
                   
                <div class="border-bottom px-4">
                    @if (session('status'))
                    <div class="alert bg-primary col-12 mt-3 mb-0 text-white mx-auto text-left alert-dismissible">
                        <button type="button" data-dismiss="alert" class="close font-xxl font-weight-light white">×</button> 
                        <div>{{session('status')}}</div>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <div class="col-md-4 px-0 py-4">
                            <div class="px-0 pb-4">
                                <label for="">Choose portfolio</label>
                                <select name="portfolio" class="custom-select">
                                    @foreach ($portfolios as $portfolio)
                                        <option value="{{$portfolio->id}}">{{$portfolio->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file"></label>
                                @if (session('status'))
                                    
                                @endif
                            </div>
                        </div>
                        <div class="alert-content col-md-6 my-3 rounded-sm bg-light">
                            <i class="font-lg ">Errors:</i>
                           
                            <ul class="list-unstyled pt-2">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                        <li class="text-danger">
                                        - {{$item}}
                                        </li>   
                                    @endforeach 
                                @else
                                    <li>No errors found</li> 
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>   
                <div class="m-4">
                    <button type="submit" class="btn btn-primary d-flex align-items-center import-file-btn" disabled>Import trades
                        <span class="material-icons-outlined pl-2 ">
                            cloud_upload
                        </span>
                    </button>
                </div>
                    
                </div>
            </form>
        </section>
    </div>
</div>

@endsection
@section('scripts')
<script>
$( document ).ready(function() {
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $(".import-file-btn").prop("disabled", false);
    });
});
</script>
@endsection
