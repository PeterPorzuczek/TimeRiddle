<template>
  <div
    class="navbar"
    :class="[
    isDark
    ? `
      t-bg-gradient-l-${themeColors.primary}-dark
      t-border-gradient-b-${themeColors.primary}-dark
    `
    : `
      t-bg-${themeColors.contentBackgroundSecondary}
      t-border-gradient-b-${themeColors.primary}
    `, `
      t-shadow-nm-${themeColors.hue}
      t-text-${themeColors.contentText}
      t-border
      t-border-r-0 t-border-t-0 t-border-b-0
      t-border-l-8
      t-items-center t-justify-center
    `]"
    >
    <div class="t-flex t-w-full">
      <span class="t-px-6 t-text-xl"></span>
      <h1
        class="navbar__title t-w-3/5 t-flex-col
          t-sm:t-text-sm t-sm:t-pt-1 t-sm:t-leading-normal
          t-md:t-text-sm t-flex t-m-auto t-align-middle
          t-justify-center"
        :class="`
            t-text-${themeColors.quaternary}
        `">{{ title }}</h1>
      <div class="navbar__links t-w-2/5 t-flex-col t-text-right">
        <a v-for="(link, index) in Object.keys(linksObj)"
          :key="`topbar-link-${index}`"
          :href="linksObj[link]"
          target="blank"
          style="border-radius: 30px;"
          class="link t-mr-1 t-text-xs t-no-underline t-shadow
            t-p-1 t-px-2 t-rounded-full hover:t-opacity-100"
          :class="[`
            t-text-${themeColors.tertiary}
            hover:t-shadow-md-${themeColors.primary}
            t-bg-gradient-r-${themeColors.primary}`,
            isDark ? `t-opacity-75` : `t-opacity-75`
            ]"
        >
          {{ link }}
          </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TopBar',
  props: {
    title: { type: String, default: '' },
    links: { type: String, default: '{}' },
  },
  computed: {
    linksObj() {
      return JSON.parse(this.links);
    },
  },
  methods: {

  },
};
</script>

<style>
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9;
  padding: .9rem 1.5rem;
  line-height: 2.2rem;
  height: 4.3rem;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  display: flex;
  align-items: center;
}
.navbar__title {
  margin: 0px;
  padding: 0px;
  font-size: 1.2rem;
  line-height: 2;
}
@media (min-width: 453px) and (max-width: 700px) {
  .navbar__title {
    font-size: .85rem !important;
    line-height: 1.4;
  }
}
@media (min-width: 701px) and (max-width: 832px) {
  .navbar__title {
    font-size: .85rem !important;
    line-height: 2.5;
  }
}
@media (max-width: 452px) {
  .navbar__title {
    width: 90%;
    font-size: .9rem !important;
    line-height: 1.4;
  }
  .navbar__links {
    display: none;
  }
}
@media (min-width: 453px) and (max-width: 640px) {
  .navbar__links {
    font-size: 0.76rem !important;
    line-height: 1.4;
  }
}
</style>
