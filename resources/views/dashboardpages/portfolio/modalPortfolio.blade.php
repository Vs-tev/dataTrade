{{-- modal create --}}
<div class="modal" id="modal_create" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <form class="modal-content" action="/action_page.php">
            <div class="modal-header">
                <h5 class="modal-title">Create portfolio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn">close</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group mb-4">
                    <label for="portfolio_name">Portfolio name</label>
                    <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-4">
                    <label for="start_capital">Amount start capital</label>
                    <input type="text" name="start_capital" class="form-control" placeholder="Enter start capital"
                        id="start_capital">
                </div>
                <div class="form-group mb-4">
                    <label for="currency">Currency</label>
                    <select id="currency" name="currency" data-max="1" multiple="multiple">
                        <option value="usd">EUR</option>
                        <option value="usd">USD</option>
                        <option value="chf">CHF</option>
                        <option value="aud">AUD</option>
                        <option value="cad">CAD</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="start_date">Start date</label>
                    <input type="date" name="start_date" class="form-control" id="Start date">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>


{{-- modal edit --}}
<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form class="modal-content" action="/action_page.php">
            <div class="modal-header">
                <h5 class="modal-title">Edit "Test Portfolio"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="portfolio_name">Portfolio name</label>
                    <input type="text" name="portfolio_name" class="form-control" placeholder="Enter portfolio name"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-4">
                    <label for="currency">Currency</label>
                    <select id="currency" name="currency" data-max="1" multiple="multiple">
                        <option value="usd">EUR</option>
                        <option value="usd">USD</option>
                        <option value="chf">CHF</option>
                        <option value="aud">AUD</option>
                        <option value="cad">CAD</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal delete weill be with components build --}}
