<template>
    <div>
         <div class="d-none d-sm-flex">
            <ul class="pagination pagination-sm m-auto">
                <li class="page-item" v-for="page in pages.data" :key="page.label"
                    :class="{'active': page.active == true }"><a class="page-link"
                    @click="setPage(page.url)" v-html="page.label"></a>
                </li>
            </ul>

        </div>
        <div class="d-flex d-sm-none">
            <ul class="pagination pagination-sm m-auto">
                <li class="page-item">
                    <a class="page-link font-lg" @click="setPage(pagination.first_page_url)">&laquo;</a>
                </li>
                <li class="page-item">
                    <a class="page-link" @click="setPage(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" @click="setPage(pagination.next_page_url)">Next</a>
                </li>
                <li class="page-item">
                    <a class="page-link font-lg" @click="setPage(pagination.last_page_url)">&raquo;</a>
                </li>
            </ul>

        </div>
    </div>
</template>
<script>
export default {
  name: "Pagination",
  props: ["pagination", "pages"],

  methods: {
    setPage: function setPage(page) {
      this.$emit("setPage", page);
    },
  },
};
</script>