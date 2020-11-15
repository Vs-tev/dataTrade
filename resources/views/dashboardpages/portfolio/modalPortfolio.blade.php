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
                <button type="submit" class="btn btn-primary">Create</button>
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


{{-- modal transactions --}}
<div class="modal" id="transactions" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction "Test Portfolio"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-lg dark mb-3">Make Transaction:</p>
               <form action="/action_page.php" class="form-inline align-items-center">
                <div class="form-group mb-4 mr-3">
                    <label for="portfolio_name" class="mr-0 mr-md-1">Amount:</label>
                    <input type="text" name="amount_transaction" class="form-control" placeholder="For withdrawal type -100"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-4  mr-3">
                    <label for="transaction_date" class="mr-0 mr-md-1">Date:</label>
                    <input type="date" name="transaction_date" class="form-control" placeholder="Enter portfolio name"
                        id="portfolio_name">
                </div>
                <div class="form-group mb-sm-4">
                    <button type="submit" class="btn btn-primary">Save transaction</button>
               </div>
                </form>

                <p class="font-lg dark mt-5 mb-3">Transaction History:</p>
                <div class="transactions_deteils">
                    <div class="form-group w-50 mb-2">
                        <input type="text" class="form-control search-input" name="text"
                            placeholder="Search Transaction">
                        <span class="material-icons search-i">search</span>
                    </div>
                   
                    <table class="table table-sm table-hover">
                        <thead class="">
                            <tr>
                                <th>Action date <span class="unicode-arrow">&#8645;</span></th>
                              
                                <th>Transaction <span class="unicode-arrow">&#8645;</span></th>
                                <th>Action <span class="unicode-arrow">&#8645;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2020-11-14</td>
                               
                                <td>950 USD</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                        <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2020-11-14</td>
                               
                                <td>950 USD</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                        <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                               
                                <td>2020-11-14</td>
                                
                                <td>950 USD</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                        <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>2020-11-14</td>
                                
                                <td>950 USD</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                        <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal delete weill be with components build --}}
