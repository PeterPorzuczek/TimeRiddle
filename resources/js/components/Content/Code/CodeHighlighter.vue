<template>
  <div>
    <div @click="showHide" class="code-toggle" v-html="toggleIcon"></div>
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
      return html.replace(/<pre>/ig, '<pre class="line-numbers t-shadow hover:t-shadow-lg">');
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
  float: right;
  top: -15px;
  display: flex !important;
  right: 25px;
  background: #de751f1a;
  border-radius: 25px;
  width: 23px;
  height: 23px;
  text-align: center;
  align-items: center;
  justify-content: center;
  position: relative;
  margin-left: 5px;
  -webkit-transition: all .28s ease-in-out;
  transition: all .28s ease-in-out;
  color: #de751f;
}
@media (min-width: 0px) and (max-width: 327px) {
  .code-toggle {
    top: -10px;
  }
}
</style>
