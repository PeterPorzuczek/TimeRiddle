<template>
<div>
    <div
    class="t-fullscreen"
    :class="`
        t-bg-hero-${headerBackgroundName}-${themeColors.primary}
        t-bg-main-${themeColors.hue}
    `"/>
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
    headerBackgroundName: { type: String, default: 'overcast' }
  },
}
</script>

<style>

</style>
