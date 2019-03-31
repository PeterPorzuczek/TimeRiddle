<template>
  <div>
    <div
        @click="showHide"
        class="code-toggle t-fill-current"
        :class="`
            t-text-${themeColors.primary}
            t-bg-${themeColors.contentBackgroundTertiary}
        `"
        v-html="toggleIcon"></div>
    <div v-show="visible" v-html="addLineNumbersClass(code)"/>
  </div>
</template>

<script>
import toggleIcon from './toggleIcon';

export default {
  name: 'CodeHighlighter',
  props: {
    code: { type: String, default: '' },
  },
  data() {
    return {
      visible: false,
      toggleIcon: toggleIcon,
    };
  },
  created() {
    this.$root.$on('reset-view', this.reset);
    this.$root.$on('toggle-all-codes', this.changeVisibilty);
  },
  watch: {
    code() {
      this.refreshHighlight();
    },
    visible() {
      this.refreshHighlight();
    },
  },
  methods: {
    changeVisibilty(visibility) {
      this.visible = visibility;
    },
    reset() {
      this.visible = false;
    },
    showHide() {
      this.visible = !this.visible;
    },
    addLineNumbersClass(html) {
      return html.replace(/<pre>/ig, '<pre class="line-numbers t-shadow-nm hover:t-shadow-lg">');
    },
    refreshHighlight() {
      this.$nextTick(() => {
        Prism.highlightAll();
      });
    },
  },
};
</script>

<style>
.code-toolbar {
  display: flex;
}
.code-toggle {
  display: flex !important;
  position: relative;
  justify-content: center;
  align-items: center;
  text-align: center;
  border-radius: 25px;
  float: right;
  margin-left: 5px;
  top: -15px;
  right: 25px;
  width: 23px;
  height: 23px;

}
@media (min-width: 0px) and (max-width: 327px) {
  .code-toggle {
    top: -10px;
  }
}
</style>
