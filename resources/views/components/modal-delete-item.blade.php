<div {{$attributes->merge(['class' => 'modal'])}} id="modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form {{$attributes->merge(['class' => 'modal-content'])}} action="/action_page.php">
            <div {{$attributes->merge(['class' => 'modal-header'])}}>
                <h5 {{$attributes->merge(['class' => 'modal-title'])}}>Delete "Test Portfolio"</h5>
                <button type="button" {{$attributes->merge(['class' => 'close'])}} data-dismiss="modal" aria-label="Close">
                    <span {{$attributes->merge(['class' => 'material-icons ml-auto close-btn'])}}>close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$message}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" {{$attributes->merge(['class' => 'btn btn-secondary'])}} data-dismiss="modal">Close</button>
                <button type="submit" {{$attributes->merge(['class' => 'btn btn-primary'])}}>Delete</button>
            </div>
        </form>
    </div>
</div>