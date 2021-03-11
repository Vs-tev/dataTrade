<template>
     <div class="modal" id="modal-upgrade-plan">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form  class="modal-content rounded-0">
                <div class="modal-header border-0">
                    <h4 class="font-500 my-auto lighter">Upgrade plan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-lg">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center pb-3">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-arrows-vertical" width="84" height="84" viewBox="0 0 24 24" stroke-width="0.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M18 21v-14" />
                            <path d="M9 15l3 -3l3 3" />
                            <path d="M15 10l3 -3l3 3" />
                            <line x1="3" y1="21" x2="21" y2="21" />
                            <line x1="12" y1="21" x2="12" y2="12" />
                            <path d="M3 6l3 -3l3 3" />
                            <path d="M6 21v-18" />
                            </svg>
                        </div>
                        <h2 class="font-weight-bolder dark">{{text[0].text}}</h2>
                    <p class="font-lg font-weight-bold pb-4">{{text[0].subtext}}
                    </p>
                    <a type="button" href="/plan" class="btn btn-primary font-lg mx-auto my-4 w-25 font-500">Upgrade Now!</a>
                    </div>
                </div>

            </form>
        </div>
     </div>
</template>
<script>
export default {
  name: "ModalUpgradePlan",
  props: ["text"],
};
</script>