<template>
  <div class="t-pb-8" style="border-bottom: 1px dashed #1f74de">
    <div v-for="(contentElement, index) in contentElements" :key="`key-${index}`">
      <div v-if="!(index % 2)" style="margin-bottom: 50px;">
        <div v-html="contentElement"/>
        <code-highlighter
          v-if="index < contentElements.length-1"
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
  },
};
</script>
