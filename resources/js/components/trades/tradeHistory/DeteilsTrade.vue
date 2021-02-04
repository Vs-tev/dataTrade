<template>
     
        <section class="trade_deteils" id="trade_deteils">
        <div class="header_trade_deteils align-items-center d-flex px-4 py-4">
            <div class="my-auto">
                <div class="d-flex align-content-center">
                    <h4 class="font-weight-bold m-0">EURUSD / </h4>
                    <h4><span class="font-weight-bold indigo ml-1 m-0">Buy</span></h4>
                </div>
                <p class="font-500 font-lg m-0">Test Portfolio 1 <span class="text-muted ">&nbsp;&nbsp; 12 Jan 2020</span></p>
            </div>
            <span class="material-icons icon-sm ml-auto close-btn close-trade-deteils">close</span>
        </div>

        <div class="scroll-content">
                <div class="img-container d-flex flex-column flex-md-row align-content-center px-4">
                    <div class="selected-img d-flex  align-items-center mb-3 mb-md-0">
                        
                        <img src="https://www.tradingview.com/x/NSwr4nQM/" alt="">
                        <img src="https://www.tradingview.com/x/666Hwj5t/" alt="">
                        <img src="https://www.tradingview.com/x/l5DgNzQ0/" alt="">
                        
                    </div>
                    <div class="thumbnails-img d-flex d-flex-row flex-md-column justify-content-between">
                        <img onclick="currentSlide(1)" src="https://www.tradingview.com/x/NSwr4nQM/" alt="">
                        <img onclick="currentSlide(2)" src="https://www.tradingview.com/x/666Hwj5t/" alt="">
                        <img onclick="currentSlide(3)" src="https://www.tradingview.com/x/l5DgNzQ0/" alt="">
                    </div>
                </div>
    

            <div class="buttons-img d-flex justify-content-center align-content-center mt-2">
                <button class="btn btn-primary ml-3" onclick="plusSlides(-1)">
                    <span class="material-icons white p-0">keyboard_arrow_left</span>
                </button>
                <button class="btn btn-primary ml-3" onclick="plusSlides(1)">
                    <span class="material-icons white p-0">keyboard_arrow_right</span>
                </button>
            </div>

            <div class="col-12 col-lg-10 row current-trade-performance px-4 px-lg-0 mx-lg-auto my-5">
                <div class="col-12 col-lg-9 pr-lg-5">
                    <table class="">
                        <thead>
                            <tr>
                                <th class="font-md">DESCRIPTION</th>
                                <th class="font-md">ENTRY</th>
                                <th class="font-md">EXIT</th>
                                <th class="font-md">STOP LOSS</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center ">
                                    <span class="material-icons cyan icon-sm mr-1">fiber_manual_record</span>
                                    Price</div>
                            </td>
                            <td>1.5000</td>
                            <td>1.5030</td>
                            <td>1.4030</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center ">
                                    <span class="material-icons text-muted icon-sm mr-1">fiber_manual_record</span>
                                    Date</div>
                            </td>
                            <td>11 Jun 2020</td>
                            <td>13 Jun 2020</td>
                            <td>-</td>
                        </tr>
                    </table>
                    <hr class="py-1">
                    <table class="table-rules">
                        <tr>
                            <td class="">
                                <div class="d-flex align-items-center ">
                                    <span class="material-icons lighter icon-sm mr-1">fiber_manual_record</span>
                                    <p>Entry Rules</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div>
                                    <span class="badge badge-light text-muted mb-1 mb-xl-0">double top confirmation</span>
                                    <span class="badge badge-light text-muted mb-1 mb-xl-0">Rsi oversold</span>
                                    <span class="badge badge-light text-muted mb-1 mb-xl-0">candlestick confirmation</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center ">
                                    <span class="material-icons orange icon-sm mr-1">fiber_manual_record</span>
                                    <p>Exit Reason</p>
                                </div>
                            </td>
                            <td class="pl-2"><span class="badge bg-orange red">SL Hit</span></td>

                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center ">
                                    <span class="material-icons cyan icon-sm mr-1">fiber_manual_record</span>
                                    <p>Used strategy</p>
                                </div>
                            </td>
                            
                            <td class="pl-2"><span class="badge badge-light cyan">Double top retest 0.618</span></td>
                        </tr>
                    </table>
                    <hr class="py-1">
                    <div class="trade-comentar-container d-flex align-items-strat">
                        <div class="commentar-icon rounded-circle">
                            <span class="material-icons cyan" style="transform: scale(-1, 1);">
                                chat_bubble_outline
                            </span>
                        </div>
                        <div class="commentar-container ml-3">
                            <h5 class="pt-3 pl-3">Trade commentar</h5>
                            <p class="p-3">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, iste quibusdam ipsam ipsa
                                tempora sint blanditiis quo veritatis in velit doloribus reiciendis enim vel esse. Unde
                                incidunt nesciunt minus non.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="profit-container">
                        <div class="pb-4 pt-3">
                            <h4 class="font-weight-bold lighter">PROFIT</h4>
                            <h2>185,41 EUR</h2>
                            <h5 class="font-500">15.6 PIPS </h5>
                        </div>
                        <div class="py-4 border-top">
                            <h5 class="lighter"><span>&#9900;</span> RETURN</h5>
                            <h5 class="">1.27%</h5>
                        </div>

                        <div class="py-4 border-top">
                            <h5 class="lighter"><span>&#9900;</span>  DRADE DURATION  </h5>
                            <h5 class="">1.5 days</h5>
                        </div>
                        <div class="py-4 border-top">
                            <h5 class="lighter"><span>&#9900;</span> RISK REWARD  </h5>
                            <h5 class="">3.50</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
  name: "DeteilsTrade",
};
</script>