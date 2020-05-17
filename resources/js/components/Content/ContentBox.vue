<template>
  <div class="t-pb-8">
    <div v-for="(contentElement, index) in contentElements" :key="`key-${index}`">
      <div v-if="!(index % 2)" style="margin-bottom: 50px;">
        <div v-html="addPropertiesToElements(contentElement)"/>
        <code-highlighter
          v-if="index < contentElements.length-1"
          :is-dark="isDark"
          :color="color"
          :code="contentElements[index+1]"
        />
      </div>
    </div>
    <slot />
  </div>
</template>

<script>
import CodeHighlighter from "./Code/CodeHighlighter.vue";

export default {
  name: "ContentBox",
  components: {
    CodeHighlighter
  },
  props: {
    content: { type: Object, default: () => ({}) },
    headerBackgroundName: { type: String, default: "overcast" }
  },
  created() {
      this.$root.$on('reset-view', this.reset);
  },
  computed: {
    contentElements() {
      return this.content && this.content.content
        ? this.splitByPre(this.content.content)
        : [];
    }
  },
  watch: {
    contentElements: {
      handler: function (newValue) {
        if (newValue.length > 1) {
            this.$emit("showCodeThemeSwitch");
        } else {
            this.$emit("hideCodeThemeSwitch");
        }
      },
      deep: true
    },
    isDark() {
        this.reset();
    }
  },
  methods: {
    splitByPre(html) {
      return html.split(/(<pre>.*?<\/pre>)/gs);
    },
    addPropertiesToElements(html) {
      let content = html;
      content = this.addBorderClass(content);
      content = this.addH1Class(content);
      content = this.addToFirstH1Class(content);
      content = this.addH2Class(content);

      content = this.addTargetToLinks(content);

      return content;
    },
    addBorderClass(html) {
      return html.replace(
        /<blockquote>/gi,
        `<blockquote class="t-border-gradient-t-${this.themeColors.primary}">`
      );
    },
    addH1Class(html) {
      return html.replace(
        /<h1/g,
        `
      <h1 class="
            t-text-${this.themeColors.quaternary}
            t-border t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8 t-border-gradient-t-${this.themeColors.primary}
            t-pl-8 t-pb-2
        "
        style="
            margin-left: -32px;
            padding-right: 25px;
        "
        `
      );
    },
    addToFirstH1Class(html) {
      return html.replace(
        /<h1/,
        `
      <h1 style="
            margin-left: -32px;
            padding-right: 25px;
            padding-top: 65px;
            margin-top: -30px;
            transition: all .28s ease-in-out;
            box-shadow: 0 2px 2px 0 rgba(0,0,0,0.06), 0 1px 5px 0 rgba(0,0,0,0.06);
        "
        class="
            t-text-${this.themeColors.quaternary}
            t-border t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8 t-border-gradient-t-${this.themeColors.primary}
            t-pl-8 t-pb-2
            t-bg-hero-${this.headerBackgroundName}-${
          this.themeColors.primary
        }-low
        "`
      );
    },
    addH2Class(html) {
      return html.replace(
        /<h2>/gi,
        `
      <h2 class="
            t-text-${this.themeColors.tertiary}
            t-border t-border-r-0 t-border-t-0 t-border-b-8
            t-border-l-8 t-border-gradient-b-${this.themeColors.primary}
            t-pl-8 t-pb-2
        "
        style="
            margin-left: -32px;
            padding-right: 25px;
            padding-bottom: 15px;
        ">`
      );
    },
    addTargetToLinks(html) {
      return html.replace(
        /<a /gi,
        `<a target="_blank" `
      );
    },
    reset() {
        this.$nextTick(() => {
            Prism.highlightAll();
        });
    },
  }
};
</script>
