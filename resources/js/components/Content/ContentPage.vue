<template>
  <div
    class="content-page
      t-sm:t-p-2 t-sm:t--m-2 t-p-8
      t-sm:t-w-full t-w-9/10
      t-rounded-sm t-relative
      t-overflow-hidden
    "
    :class="`
        t-shadow-nm-${themeColors.hue}
        t-bg-${themeColors.contentBackgroundPrimary}
        t-text-${themeColors.contentText}
    `">
    <div
      class="content-page__header"
      :class="`
        t-bg-hero-${headerBackgroundName}-${themeColors.primary}
      `"></div>
    <code-highlighter-theme-switch
        v-if="codeThemeSwitchVisible"
        :is-dark="isDark"
        :color="color"/>
    <content-box
        :is-dark="isDark"
        :color="color"
        :content="content"
        @showCodeThemeSwitch="codeThemeSwitchVisible=true"
        @hideCodeThemeSwitch="codeThemeSwitchVisible=false"/>
    <div
        class="t-no-underline t-float-right t-text-sm t-font-body"
        @click="scrollToTop">/^^^UP^^^/</div>
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
    headerBackgroundName: { type: String, default: 'overcast' }
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
<style>
.content-page__header {
  position: absolute;
  width: 115%;
  height: 111px;
  padding: 0px;
  margin: 0px;
  margin-left: -32px;
  margin-top: -35px;
  opacity: 0.5;
  box-shadow: 0 2px 2px 0 rgba(0,0,0,0.08), 0 1px 5px 0 rgba(0,0,0,0.06);
}
</style>
