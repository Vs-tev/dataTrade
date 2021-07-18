@extends('layouts.master')

@section('content')

<div class="main-content-container">
    <div class="content-container">
        <section class="dashboard_container_content p-0">  
            <div class="border-bottom px-4 py-3">
                <h4 class="font-weight-normal m-0">Import Trades</h4>
            </div>
            <form class="d-md-flex flex-wrap mb-3" action="trades/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-12 p-0">
                    <div class="border-bottom px-4">
                        @if (session('message'))
                        <div class="alert bg-info col-12 mt-3 mb-0 text-white mx-auto text-left alert-dismissible">
                            <button type="button" data-dismiss="alert" class="close font-xxl font-weight-light white">×</button> 
                            <div>{{session('message')}}</div>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <div class="col-md-4 px-0 py-4">
                                <div class="px-0 pb-4">
                                    <label>Choose portfolio</label>
                                    <select name="portfolio" class="custom-select">
                                        @foreach ($portfolios as $portfolio)
                                            <option value="{{$portfolio->id}}">{{$portfolio->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file"></label>
                                </div>
                            </div>
                        
                            @if (Auth::user()->unreadNotifications)
                        
                                <div class="alert-content col-md-6 my-3 py-2 pb-4 rounded-sm border">
                                    <div class="mb-3">
                                        <i class="font-500">Output:</i>
                                    </div>

                                    @forelse (Auth::user()->unreadNotifications as $notification)
                                        <div class="notification-item rounded bg-light my-3 p-3">
                                            <div class="dark pb-1 underline">Date: {{$notification->created_at->format('M jS Y, H:i:s')}}</div>
                                                @foreach ($notification->data['data'] as $message)
                                                    <div class="text-muted pb-1">- {{$message}}</div>
                                                @endforeach
                                                <div class="text-right pt-2">
                                                    <a href="#" class="mark-as-read" data-id="{{ $notification->id }}">
                                                        Mark as read
                                                    </a>
                                                </div>
                                            </div>
                                            @if($loop->last )
                                                <a href="#" id="mark-all">
                                                    <a href="#" class="mark-all-as-read">Mark all as read</a>
                                                </a>
                                            @endif
                                    @empty
                                        <div class="lighter"><i>Empty</i></div>
                                    @endforelse
                                </div>
                              
                            @endif
                            
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
        <section class="dashboard_container_content p-0 mb-4">  
            <div class="border-bottom px-4 py-3">
                <h4 class="font-weight-normal m-0">How to import? </h4>
            </div>
            <div class="px-4 py-3">
                <p>- To import exsisting trades from your excel file, you need to do some preparations to upload your trades with all data that you have.</p>
                <p>- This fields are required: <i class="text-muted"> <a href="#" data-toggle="modal" data-target="#modal-symbol"> Symbol</a> Type side, Quantity, Entry price, Exit price, Sl price, 
                    Entry date, Exit date, Profit currency, Profit pips. </i></p>
                <p>- Optional fields: <i class="text-muted">Time Frame, Fees, Commentar, Return(in %), Risk reward.</i></p> 
                <p>- You have to have Heading row like the following example: </p>
                <img src="{{ asset('storage/Excel-example.png') }}" class="w-100" alt="excel-example">
            </div>
        </section>
    </div>
</div>
<app-modal-symbols></app-modal-symbols>
@endsection

@section('scripts')
<script>
    $(function() {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            $(".import-file-btn").prop("disabled", false);
        });
    });

    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('importNotification.markAsRead') }}", {
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id
            }
        });
    }

    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.notification-item').remove();
            });
        });  

        $('.mark-all-as-read').click(function(){
            let request = sendMarkRequest();
            request.done(() => {
                $('div.notification-item').remove();
            })
        })   
    });
</script>
@endsection
