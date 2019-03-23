<template>
    <div class="t-flex t-w-full t-justify-end" style="margin-top: 57px;">
      <div
        :class="full
          ? 't-flex t-w-full t-justify-center'
          : 't-flex t-md:t-w-4/5 t-lg:t-w-4/5 t-sm:t-w-full t-justify-center'">
        <slot />
      </div>
    </div>
</template>

<script>
export default {
  name: 'MainPage',
  data() {
    return {
      full: false,
    };
  },
  created() {
    this.$root.$on('show-menu', this.showWithSide);
    this.$root.$on('hide-menu', this.showFull);
  },
  methods: {
    showFull() {
      this.full = true;
    },
    showWithSide() {
      this.full = false;
    },
  },
};
</script>
