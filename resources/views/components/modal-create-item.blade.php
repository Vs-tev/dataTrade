<div>
    <div {{$attributes->merge(['class' => 'modal'])}} id="modal_create" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div {{$attributes->merge(['class' => 'modal-content'])}} action="/action_page.php">
            
                    <div>{{$modal_content}}</div>
               
            </div>
        </div>
    </div>
    {{$slot}}
</div>