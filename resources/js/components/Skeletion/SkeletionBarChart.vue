<template>
    <div class="d-flex justify-content-between align-items-baseline pt-5">
        <skeletion-box :width="'1.5em'" :height="'19.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'5.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'8.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'9.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'19.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'10.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'8.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'18.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'8.5em'" class="rounded-sm my-2"></skeletion-box>
        <skeletion-box :width="'1.5em'" :height="'18.5em'" class="rounded-sm my-2"></skeletion-box>
    </div>
</template>
<script>
import SkeletionBox from "./SkeletionBox.vue";
export default {
  name: "SkeletionBarChart",
  components: { SkeletionBox },
};
</script>