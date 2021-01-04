<template>
    <editor v-model="item.description" name="description"
        :key="item.id"
        api-key="6q52b91hsd3vy6c451g44vjkn1avc5pmzr0z102fs62j21na" :init="{
        placeholder: 'Well written description will help you to improve your strategy and help you to make better trading decisions',
        branding: false,
        height: 261,
        min_height: 150,
        max_height: 350,
        menubar: false,
        lineheight_formats: '0.5',
        toolbar_mode: 'floating',
        plugins:['lists'],
        block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
        toolbar: 'numlist bullist | undo redo | underline | bold italic | alignleft aligncenter alignright',
        }">
    </editor>
</template>
<script>
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "Texteditor",

  props: ["item"],
  components: {
    editor: Editor,
  },
};
</script>