<div>
    <div {{$attributes->merge(['class' => 'modal'])}} id="modal_create" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form {{$attributes->merge(['class' => 'modal-content'])}} action="/action_page.php">
                <div {{$attributes->merge(['class' => 'modal-header'])}}>
                    <h5 {{$attributes->merge(['class' => 'modal-title'])}}>Create</h5>
                    <button type="button" {{$attributes->merge(['class' => 'close'])}} data-dismiss="modal" aria-label="Close">
                        <span {{$attributes->merge(['class' => 'material-icons ml-auto close-btn icon-sm'])}}>close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>{{$modal_body}}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" {{$attributes->merge(['class' => 'btn btn-secondary'])}} data-dismiss="modal">Close</button>
                    <button type="submit" {{$attributes->merge(['class' => 'btn btn-primary'])}}>Create</button>
                </div>
            </form>
        </div>
    </div>
    {{$slot}}
</div>