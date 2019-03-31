<template>
  <div class="t-pb-8">
    <div v-for="(contentElement, index) in contentElements" :key="`key-${index}`">
      <div v-if="!(index % 2)" style="margin-bottom: 50px;">
        <div v-html="addClassNamesToElements(contentElement)"/>
        <code-highlighter
          v-if="index < contentElements.length-1"
          :is-dark="isDark"
          :color="color"
          :code="contentElements[index+1]"/>
      </div>
    </div>
  </div>
</template>

<script>
import CodeHighlighter from './Code/CodeHighlighter.vue';

export default {
  name: 'ContentBox',
  components: {
    CodeHighlighter,
  },
  props: {
    content: { type: Object, default: () => ({}) },
  },
  computed: {
    contentElements() {
      return this.content && this.content.content
        ? this.splitByPre(this.content.content) : [];
    },
  },
  watch: {
    contentElements(value) {
      if (value.length > 1) {
        this.$emit('showCodeThemeSwitch');
      } else {
        this.$emit('hideCodeThemeSwitch');
      }
    }
  },
  methods: {
    splitByPre(html) {
      return html.split(/(<pre>.*?<\/pre>)/sg);
    },
    addClassNamesToElements(html) {
      let content = html;
      content = this.addBorderClass(content);
      content = this.addH1Class(content);
      content = this.addH2Class(content);

      return content
    },
    addBorderClass(html) {
      return html.replace(/<blockquote>/ig, `<blockquote class="t-border-gradient-t-${this.themeColors.primary}">`);
    },
    addH1Class(html) {
      return html.replace(/<h1>/ig, `
      <h1 class="
            t-text-${this.themeColors.quaternary}
            t-border t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8 t-border-gradient-t-${this.themeColors.primary}
            t-pl-8 t-pb-2
        "
        style="
            margin-left: -32px;
        ">`);
    },
    addH2Class(html) {
      return html.replace(/<h2>/ig, `
      <h2 class="
            t-text-${this.themeColors.tertiary}
            t-border t-border-r-0 t-border-t-0 t-border-b-4
            t-border-l-8 t-border-gradient-b-${this.themeColors.primary}
            t-pl-8 t-pb-2
        "
        style="
            margin-left: -32px;
            padding-right: 25px;
            padding-bottom: 15px;
        ">`);
    },
  },
};
</script>
