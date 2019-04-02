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
    <div class="t-inline-flex t-relative t-float-right">
        <code-highlighter-theme-switch
            v-show="codeThemeSwitchVisible"
            :is-dark="isDark"
            :color="color"/>
        <slot />
    </div>
    <content-box
        :is-dark="isDark"
        :color="color"
        :content="content"
        :header-background-name="headerBackgroundName"
        @showCodeThemeSwitch="codeThemeSwitchVisible=true"
        @hideCodeThemeSwitch="codeThemeSwitchVisible=false"/>
    <div
        @click="scrollToTop"
        style="width: 20px;height: 35px;display: flex;justify-content: center;align-items: center;"
        class="t-no-underline t-float-right t-text-sm t-font-body
         t-bg-grey-lightest t-text-grey t-px-2 t-rounded-full t-shadow"
        :class="`hover:t-shadow-md-${themeColors.primary}`"
        >
        UP
        </div>
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
