<template>
  <div
    class="content-page
      t-sm:t-p-2 t-sm:t--m-2 t-p-8
      t-sm:t-w-full t-w-9/10
      t-shadow-add t-rounded-sm t-relative"
    style="background: #ffffffc7">
    <code-highlighter-theme-switch v-if="codeThemeSwitchVisible"/>
    <content-box
        :content="content"
        @showCodeThemeSwitch="codeThemeSwitchVisible=true"
        @hideCodeThemeSwitch="codeThemeSwitchVisible=false"/>
    <a href="#"
        class="t-no-underline t-float-right"
        @click="scrollToTop">/^^^UP^^^/</a>
  </div>
</template>

<script>
import ContentBox from './ContentBox.vue';
import CodeHighlighterThemeSwitch from './Code/CodeHighlighterThemeSwitch.vue';

export default {
  name: 'ContentPage',
  components: {
    ContentBox,
    CodeHighlighterThemeSwitch,
  },
  props: {
    content: { type: Object, default: () => ({}) },
  },
  data() {
    return {
      codeThemeSwitchVisible: false,
    };
  },
  methods: {
    scrollToTop() {
      window.scrollTo(0, 0);
    },
  },
};
</script>
