<template>
<div>
    <div class="row justify-content-center pb-5">
        <div class="col-12 d-flex justify-content-center mb-4 mt-3">
            <button type="button" @click="plans = $props.monthly_plans" :class="plans[0].billing_period == 'monthly' ? 'btn-primary border-0': '' " class="btn  border ml-3 width-90">Monthly</button>
            <button type="button" @click="plans = $props.yearly_plans" :class="plans[0].billing_period == 'yearly' ? 'btn-primary border-0' : '' " class="btn  border ml-3 width-90">Yearly</button>
        </div>
      
          <div
              class="col-12 col-md-4 col-xl-3 mb-5 mb-md-0"
              v-for="(plan, index) in plans"
              :key="index">
            
              <div class="bg-white d-flex flex-column pt-3 rounded border"
              :class="plan.stripe_plan_id == currentplan.stripe_plan ? 'shadow border-primary': 'border'">
                  <div class="plan-content p-4 text-center">
                      <span class="font-weight-bold cardTitle text-dark pt-4 pb-3">{{plan.name}}</span>
                      <h5 class="font-weight-light mt-2 mb-4 h-80">{{plan.plan_description}}</h5>

                      <div class="h-20">
                          <span class="h4 font-weight-bold dark" v-if="plan.name == 'Pro' && plan.billing_period == 'yearly'">
                              <s>€35.88</s>
                          </span>
                          <span class="h4 font-weight-bold dark" v-if="plan.name == 'Premium' && plan.billing_period == 'yearly'">
                              <s>€59.88</s>
                          </span>
                      </div>
                      <div class="py-2 d-flex justify-content-center">
                          <h4 class="font-weight-bolder">€</h4>
                          <div class="font-weight-bolder cardPrice dark px-1">{{(plan.price / 100).toFixed(2)}}</div>
                          <span class="mb-0 align-self-end" v-if="plan.billing_period == 'monthly'">EUR/mo</span>
                          <span class="mb-0 align-self-end" v-if="plan.billing_period == 'yearly'">EUR/yr</span>
                      </div>
                      <div class="mb-5 h-20">
                          <span
                              v-if="plan.name == 'Pro' && plan.billing_period == 'yearly'"
                              class="h4 font-weight-light dark">You save
                              <span class="font-weight-bold">€5.98</span>
                          </span>
                          <span
                              v-if="plan.name == 'Premium' && plan.billing_period == 'yearly'"
                              class="h4 font-weight-light dark">You save
                              <span class="font-weight-bold">€9.98</span>
                          </span>

                      </div>
                
                <!-- If we have subscibed plan and subscriptionstatus is true -->
                  <div v-if="currentplan && subscriptionstatus">
                      <a 
                        :href="plan.stripe_plan_id !== currentplan.stripe_plan && plan.name !== 'Free' ? '/checkout/' + plan.id : (plan.name == 'Free' && on_grace_period !== 1 ? '/cancel': '#' )" 
                        class="btn btn-primary font-weight-500 p-3 mb-2" 
                        :class="plan.stripe_plan_id == currentplan.stripe_plan ? 'disabled cursor-auto' : '' " 
                        v-html="plan.stripe_plan_id == currentplan.stripe_plan ? 'YOUR CURRENT PLAN': 'GET THIS PLAN'"></a>
                        
                        <div class="cancel-plan h-20">
                          <a  href="/cancel" v-if="plan.stripe_plan_id == currentplan.stripe_plan && on_grace_period !== 1 && plan.name !== 'Free'">Cancel plan</a>
                        </div>

                        
                        <div v-if="plan.stripe_plan_id == currentplan.stripe_plan && on_grace_period == 1">
                          <p v-if="on_grace_period == 1 && plan.stripe_plan_id == currentplan.stripe_plan">
                          Your subscription will end at {{currentplan.ends_at}} and will continue with Free Plan</p>
                          <a :href="'/resume/' + plan.id" class=" font-500 " >Resume subscription</a>
                        </div>
                  </div>
                  <!-- Else if subscription is out of period -->
                  <div v-else-if="!subscriptionstatus">
                      <a 
                      :href="plan.name !== 'Free' ? '/checkout/' + plan.id : '#' "
                      :class="plan.name == 'Free' ? 'bg-light border-0 text-muted cursor-auto' : '' " 
                      class="btn btn-primary font-weight-500 p-3 mb-5" 
                      v-html="plan.name == 'Free' ? 'YOUR CURRENT PLAN': 'GET THIS PLAN'"></a>
                  </div>

                   <!-- Else if there is no suscription at all -->
                 <!--  <div v-else>
                    <a 
                      :href="plan.name !== 'Free' ? '/checkout/' + plan.id : '#' "
                      :class="plan.name == 'Free' ? 'bg-light border-0 text-muted cursor-auto' : '' " 
                      class="btn btn-primary font-weight-500 p-3 mb-5" 
                      v-html="plan.name == 'Free' ? 'YOUR CURRENT PLAN': 'GET THIS PLAN'"></a>
                </div> -->
                  <hr>
                    <div class="text-left pt-3">
                        <h5 class="font-weight-bold font-lg dark pb-2">Your benefits:</h5>
                        <ul class="list-unstyled" v-if="plan.name ==  'Free'">
                          <li
                            class="list-item pb-2 dark"
                            v-for="(item, index) in freePlan.list"
                            :key="index">
                            <span class="lighter font-xl pr-2">&#8226;</span>{{item}}
                          </li> 
                        </ul>
                        <ul class="list-unstyled" v-else-if="plan.name == 'Pro'">
                          <li
                            class="list-item pb-2 dark"
                            v-for="(item, index) in proPlan.list"
                            :key="index">
                            <span class="lighter font-xl pr-2">&#8226;</span>{{item}}
                          </li> 
                        </ul>
                        <ul class="list-unstyled" v-else-if="plan.name == 'Premium'">
                          <li
                            class="list-item pb-2 dark"
                            v-for="(item, index) in premiumPlan.list"
                            :key="index">
                            <span class="lighter font-xl pr-2">&#8226;</span>{{item}}
                          </li> 
                        </ul>
                    </div>

                      </div>
              </div>
          </div>
     

        </div>
    </div>
    
</template>
<script>
export default {
  name: "Plans",
  props: [
    "monthly_plans",
    "yearly_plans",
    "currentplan",
    "on_grace_period",
    "subscriptionstatus",
  ],

  data() {
    return {
      plans: this.$props.monthly_plans,
      freePlan: {
        list: [
          "1 Recording Portfolios",
          "2 Testing Strategies",
          "5 Entry rules",
          "5 Exit Reasons",
          "100 Trades",
        ],
      },
      proPlan: {
        list: [
          "2 Recording Portfolios",
          "5 Testing Strategies",
          "10 Entry rules",
          "10 Exit Reasons",
          "500 Trades",
        ],
      },
      premiumPlan: {
        list: [
          "5 Recording Portfolios",
          "10 Testing Strategies",
          "20 Entry rules",
          "20 Exit Reasons",
          "Unlimited Trades",
        ],
      },

      currentFrequency: "monthly",
      planssss: [
        {
          name: "Free",
          subtext: "Everything what you need to keep track on your trading",
          benefits: {
            list: [
              "2 Recording Portfolios",
              "5 Testing Strategies",
              "10 Entry rules",
              "10 Exit Reasons",
              "500 Trades",
            ],
          },
          pricing: {
            monthly: { price: 0.0, label: "/mo" },
            yearly: { price: 0.0, label: "/yr" },
          },
        },
        {
          name: "Pro",
          subtext:
            "Everything in Basic, plus more space. Take things to the next level",
          benefits: {
            list: [
              "2 Recording Portfolios",
              "5 Testing Strategies",
              "10 Entry rules",
              "10 Exit Reasons",
              "1000 Trades",
            ],
          },
          pricing: {
            monthly: { price: 2.99, label: "/mo" },
            yearly: {
              strike_price: 35.88,
              price: 29.9,
              label: "/yr",
              save: 5.98,
            },
          },
        },
        {
          name: "Premium",
          subtext: "The complete package with maximum space and fetures",
          benefits: {
            list: [
              "5 Recording Portfolios",
              "10 Testing Strategies",
              "20 Entry rules",
              "20 Exit Reasons",
              "Unlimited Trades",
            ],
          },
          pricing: {
            monthly: { price: 4.99, label: "/mo" },
            yearly: {
              strike_price: 59.88,
              price: 49.99,
              label: "/yr",
              save: 9.98,
            },
          },
        },
      ],
    };
  },
};
</script>