<template>
  
    <div class="content-container" >
       <sorting-trades></sorting-trades>
        <section class="dashboard_container_content">
            <div class="d-flex col-12 justify-content-start align-items-center">
                <label for="">Show</label>
                <div>
                    <select id="sort_by_profit" class="form-control" name="sort_by_profit">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <label for="">Trades</label>
            </div>
            <div class="d-md-flex mt-3 mb-2 justify-content-between">
                <div class="form-group col-12 col-md-3 mb-2">
                    <input type="text" class="form-control search-input" name="text" placeholder="Search Trade">
                    <span class="material-icons font-sm icon-sm search-i">search</span>
                </div>
                <div class="dropdown col mt-3 mt-md-0">
                    <button type="button" class="btn btn-primary float-md-right" data-toggle="dropdown">
                        <span class="material-icons white mr-1">description</span>Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <h5 class="dropdown-header indigo">OPTIONS</h5>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">PDF</a>
                        <a class="dropdown-item" href="#">Email</a>
                    </div>
                </div>
            </div>
            <div class="col px-0 px-md-3">
                <div class="row p-0 justify-content-start" id="table-view" style="display">
                 <table class="table table-sm table-hover" >
                    <thead class="">
                        <tr>
                            <th class="pl-3 pl-md-0">Symbol <span class="unicode-arrow">&#8645;</span></th>
                            <th>
                                <div class="d-none d-md-block">Quantity <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Type side<span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Entry price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Exit price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Sl price <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Entry date <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th>
                                <div class="d-none d-md-block">Exit date <span class="unicode-arrow">&#8645;</span></div>
                            </th>
                            <th class="pl-3 pl-md-0">Profit <span class="unicode-arrow">&#8645;</span></th>
                            <th class="pl-3 pl-md-0">Actions <span class="unicode-arrow"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-3 pl-md-0">EUR/USD</td>
                            <td>
                                <div class="d-none d-md-block">85000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">SELL</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45000</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.45620</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">1.44950</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">10.11.20</div>
                            </td>
                            <td>
                                <div class="d-none d-md-block">12.11.20</div>
                            </td>
                             <td class="pl-3 pl-md-0">180 Eur / 18 pips</td>
                            <td class="pl-3 pl-md-0">
                                <div class="d-flex">
                                    <button class="btn btn-link mr-3"><span class="material-icons close-trade-deteils">visibility</span></button>
                                    <button class="btn btn-link"><span class="material-icons" data-target="#modal_delete" data-toggle="modal">delete</span></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>         
              </div>
                <div class="row p-0 justify-content-start large-row-view" id="large-row-view" style="display:none">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        
                        <div class="border rounded">
                            <div class="header-trade dropdown d-flex justify-content-between pb-3">
                                <h4 class="font-500 dark">EURJPY/15min</h4>
                                <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                                <div class="dropdown-menu dropdown-menu-left">
                                    <h5 class="dropdown-header indigo">OPTIONS</h5>
                                    <a class="dropdown-item" href="#">Except trade</a>
                                    <a class="dropdown-item" href="#">Deteils</a>
                                </div>
                            </div>
                            <div class="my-flex-view">
                                <img src="https://www.tradingview.com/x/ANOGgEdq/" alt="" style="height: 100px">
                                <div class="d-flex flex-column justify-content-between ml-3">
                                    <span class=" font-500 lighter"><span class="red">SELL </span>12500 units</span>
                                    <div class="font-500 text-muted d-flex align-items-center">Profit: +185.50 Eur
                                    </div>
                                    <div class=" font-500 lighter d-flex align-items-center">Return: +1.20%
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-4">
                                <span><span>&#9900;</span> Entry Price:</span>
                                <span class="lighter">1.4585</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> Exit Price:</span>
                                <span class="lighter">1.4234</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2">
                                <span><span>&#9900;</span> SL:</span>
                                <span class="lighter">1.5232</span>
                            </div>
                            <div class="d-flex justify-content-between font-500 mt-2 mb-4">
                                <span><span>&#9900;</span> Date trade</span>
                                <span class="lighter">05 Mai 20 - 06 Mai 20</span>
                            </div>
                            <div class="commentar-container mx-0  mb-4">
                                <h5 class="px-3 pt-3">Trade commentar</h5>
                                <p class="p-3">
                                    <!-- max lengh show on trade comentar with if statement -> veche sym go pravil s project description -->
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                    tempora sint blanditiinonnsequatur, illum illo accusamus?
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary red mr-3" data-target="#modal_delete" data-toggle="modal">Delete trade</button>
                                <button type="button" class="btn btn-primary close-trade-deteils">Deteils</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- Pagination -->
            <div class="d-flex">
                <ul class="pagination pagination-sm m-auto">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
           
        </section>
        <deteils-trade></deteils-trade>
    </div>
 
</template>
<script>
import SortingTrades from "./SortingTrades.vue";
import DeteilsTrade from "./DeteilsTrade.vue";

export default {
  components: { SortingTrades, DeteilsTrade },
  name: "TradeHistory",

  data() {
    return {};
  },
  methods: {},
};
</script>