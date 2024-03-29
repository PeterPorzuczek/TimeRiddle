<template>
  <div class="code-highlighter-theme-switch">
    <div
        @click="toggleAllCodes"
        class="code-toggle-all t-fill-current"
        :class="`
            t-text-${themeColors.primary}
            t-bg-${themeColors.contentBackgroundTertiary}
        `"
        v-html="toggleIcon"></div>
    <div
        class="select-dropdown t-py-1 t-flex t-justify-center
            t-rounded-full t-items-center t-opacity-75 hover:t-opacity-100"
        :class="[
        isDark
                ? `t-bg-gradient-l-${themeColors.primary}`
                : `t-bg-gradient-r-${themeColors.primary} t-text-white`
        ]"
        >
      <select v-model="currentTheme">
        <option
          v-for="(theme, index) in themes"
          :key="`theme-${index}-${theme}`"
          v-bind:value="theme">
          {{ theme }}
        </option>
      </select>
    </div>
    <div class="t-hidden">
      <link
        :href="themeAddress"
        rel="stylesheet">
    </div>
  </div>
</template>

<script>
import toggleIcon from './toggleIcon';

export default {
  name: 'CodeHighlighterThemeSwitch',
  data() {
    return {
      themes: [
          'lighter',
          'darker',
          'oceanic',
          'cave-dark',
          'lake-dark',
          'evening-dark',
          'sea-dark',
          'desert-dark',
          'meadow-dark',
          'forest-dark',
          'space-dark',
          'drawbridge-dark',
          'morning-dark',
          'heath-dark',
          'suburb-dark',
          'earth-dark',
          'pool-dark',
          'suburb-light',
          'heath-light',
          'morning-light',
          'space-light',
          'forest-light',
          'meadow-light',
          'sea-light',
          'desert-light',
          'evening-light',
          'lake-light',
          'earth-light',
          'pool-light',
          'cave-light',
          'drawbridge-light'
          ],
      currentTheme: 'oceanic',
      addressPrefix: '/lib/rawcdn.githack.com/dutchenkoOleg/prismjs-material-theme/',
      addressMiddle: 'a4515a0a25904e57b43ed09c7b5e54095f27e909/css/',
      codeToggleAllCounter: 0,
      toggleIcon: toggleIcon
    };
  },
  created() {
      this.$root.$on('reset-view', this.reset);
  },
  computed: {
    themeAddress() {
      return `${this.addressPrefix}${this.addressMiddle}${this.currentTheme}.min.css`;
    },
  },
  methods: {
    reset() {
      this.codeToggleAllCounter = 0;
    },
    toggleAllCodes() {
      this.codeToggleAllCounter = this.codeToggleAllCounter + 1;
      this.$root.$emit('toggle-all-codes', this.codeToggleAllCounter % 2);
    },
  },
};
</script>

<style scoped>
.code-toggle-all {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  border-radius: 25px;
  width: 23px;
  height: 23px;
  margin-right: 20px;

}
.code-highlighter-theme-switch {
  opacity: .5;
  float: right;
  border-radius: 2px;
  padding: 5px 10px;
  font-size: .6em;
  line-height: 3em;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  overflow-x: auto;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}
.code-highlighter-theme-switch:hover {
  opacity: 1;
}
.select-dropdown {
  position: relative;
  width: auto;
  float: right;
  max-width: 100%;
}
.select-dropdown select {
  max-width: 100%;
  padding: 0px 16px 0px 8px;
  border: none;
  background-color: transparent;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  font-size: .6rem;
  line-height: 1rem;
}
.select-dropdown select:active, .select-dropdown select:focus {
  outline: none;
  box-shadow: none;
}
.select-dropdown:after {
  content: " ";
  position: absolute;
  top: 50%;
  margin-top: -2px;
  right: 8px;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #bbb;
}
</style>
