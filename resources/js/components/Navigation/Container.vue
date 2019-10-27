<template>
<div>
    <div
    class="t-fullscreen"
    :class="[
      isDark
    ? `
      t-bg-hero-${backgroundName}-${themeColors.primary}
      t-bg-main-${themeColors.hue}
      t-bg-${themeColors.primary}-darkest
    `
    : `
      t-bg-hero-${backgroundName}-${themeColors.primary}
      t-bg-main-${themeColors.hue}
    `]"/>
    <div
        class="t-font-main"
        :class="`
            t-${themeColors.hue}
        `">
        <slot />
    </div>
</div>
</template>

<script>
export default {
  name: "Container",
  props: {
    backgroundName: { type: String, default: 'overcast' }
  },
  watch: {
    isDark: {
      immediate: true,
      handler() {
        this.changeHueOnBody();
      }
    },
    color: {
      immediate: true,
      handler() {
        this.changeHueOnBody();
      }
    }
  },
  methods: {
    changeHueOnBody() {
      if (document && document.body) {
          document.body.className = this.isDark ?
          `t-bg-${this.themeColors.primary}-darkest` :
          '';
      }
    }
  }
}
</script>

<style>

</style>
