<template>
  <div
    class="navbar "
    :class="`
      t-shadow-nm-${themeColors.hue}
      t-bg-${themeColors.contentBackgroundSecondary}
      t-text-${themeColors.contentText}
    `"
    >
    <div class="t-flex">
      <span class="t-px-6 t-text-xl"></span>
      <h1
        class="navbar__title t-w-3/5 t-flex-col
          t-sm:t-text-sm t-sm:t-pt-1 t-sm:t-leading-normal
          t-md:t-text-sm"
        :class="`
            t-text-${themeColors.quaternary}
        `">{{ title }}</h1>
      <div class="navbar__links t-w-2/5 t-flex-col t-text-right t-font-body">
        <a v-for="(link, index) in Object.keys(linksObj)"
          :key="`topbar-link-${index}`"
          :href="linksObj[link]"
          target="blank"
          class="navbar__links t-mr-2 t-text-xs t-no-underline"
          :class="`
            t-text-${themeColors.tertiary}
          `"
        >
          {{ link }} /
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
}
.navbar__title {
  margin: 0px;
  padding: 0px;
  font-size: 1.1rem;
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
