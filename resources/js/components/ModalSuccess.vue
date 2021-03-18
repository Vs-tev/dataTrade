<template>
    <div class="modal" id="modal-success">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-body m-auto py-5">
                    <div class="container m-auto text-center">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="124" height="124" viewBox="0 0 24 24" stroke-width="0.9" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="12" r="9" />
                        <path d="M9 12l2 2l4 -4" />
                        </svg>
                  
                        <div class="h3 lighter font-weight-light mt-3"> {{text}} update successfully </div>
                        <button class="btn btn-primary font-500 mx-auto mt-4" data-dismiss="modal">Close</button>
                    </div>
                       
                </div>
               
            </div>

        </div>
    </div>

     
</template>
<script>
export default {
  name: "ModalSuccess",
  props: ["text"],
};
</script>
