<template>
<div class="content-container pt-0 ">
    <div class="row">

    <!-- Entry Rules -->
    <div class="col-6">
        <div class="mb-3 dashboard_container_content p-0">
            <div class="d-flex justify-content-between align-items-center border-bottom p-4">
                <div>
                    <h4 class="font-weight-500 m-0">Entry Rules</h4>
                   
                </div>
                <div class="">
                    <button type="button" class="btn btn-link font-lg pt-2 text-muted border-0 font-500 dropdown-toggle" data-toggle="dropdown">Time Frame 
                        <span class="lighter px-2 underline">{{text_time_frame}} </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('all', 'All')">All</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('1 min', '1 min')">1 min</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('5 min', '5 min')">5 min</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('15 min', '15 min')">15 min</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('30 min', '30 min')">30 min</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('1 hour', '1 hour')">1 hour</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('2 hours', '2 hours')">2 hours</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('4 hours', '4 hours')">4 hours</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('1 day', '1 day')">1 day</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('1 week', '1 week')">1 week</li> 
                        <li class="list-group-item list-group-item-action" @click="setTimeFrame('1 month', '1 month')">1 month</li>
                    </ul>

                </div>
                

            </div>
           <div class="">
            <div class="col-12 dashboard_container_content p-0">
              
                <ul class="list-group list-group-flush px-1">
                    <li class="list-group-item" v-for="rule in entryrules" :key="rule.name">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                   {{rule.name}}
                                </div>
                                 <div class="font-normal font-weigt-normal text-muted mt-1">
                                    Created: {{rule.created_at}}
                                </div>
                                
                            </div>
                            <div class="font-lg font-weigt-normal text-muted">
                               Success : <span class="text-primary">45.74%</span> 
                               <div class="font-normal">Total 5 Trades</div>
                            </div>

                            <div>
                                Chart here
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
            
        </div>
    </div>
   

    <div class="col-6">
        <div class="mb-3 dashboard_container_content p-0">
            Exit Reasons
        </div>
    </div>
    </div> 
    
 
    
    <!-- <hr>
    <h2 v-for="exitreason in exitreasons" :key="exitreason.name">{{exitreason.name}} </h2>
    <hr>
    <h1 v-for="strategy in strategies" :key="strategy.name">{{strategy.name}}</h1> -->

</div>
</template>
<script>
export default {
  name: "SetupAnalysis",
  props: ["entryrules", "exitreasons", "strategies"],
  data() {
    return {
      time_frame: "All",
      text_time_frame: "All",
    };
  },

  mounted() {
    this.setTimeFrame();
  },

  methods: {
    setTimeFrame(time_frame, text_time_frame) {
      if (time_frame || text_time_frame) {
        this.time_frame = time_frame;
        this.text_time_frame = text_time_frame;
      }
    },
  },
};
</script>