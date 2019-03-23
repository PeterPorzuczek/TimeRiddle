<template>
  <div class="">
    <span
      class="t-text-xl t-z-20 t-fixed"
      style="margin-top: -45px; padding: 5px; padding-left: 20px; overflow: hidden;"
      @click="onShowMenuClick"> ☰ </span>
    <sidebar-menu
      :menu="menu"
      :showOneChild="true"
      :width="`${widthComp}px`"
      theme="white-theme"
      class="t-shadow"
      :style="visibility ? 'left: 0px' : `left: -${widthComp}px`"
      @itemClick="onItemClick"
    />
  </div>
</template>

<script>
import SidebarMenu from './SideBarMenu/SidebarMenu.vue';

export default {
  name: 'SideBar',
  components: {
    SidebarMenu,
  },
  props: {
    course: { type: Array, default: () => [{}] },
  },
  data() {
    return {
      visibility: true,
      width: '270',
      window: {
        width: 0,
        height: 0,
      },
    };
  },
  computed: {
    menu() {
      return this.course.length > 0 && this.course[0].topics
        ? this.course[0].topics
        : [];
    },
    widthComp() {
      return this.window.width < 718
        ? (this.window.width * (40 / 100))
        : (this.window.width * (20 / 100));
    },
  },
  watch: {
    window: {
      handler(value) {
        if (value.width < 718) {
          this.$root.$emit('hide-menu');
        }
      },
      deep: true,
    },
  },
  created() {
    this.$root.$on('hide-menu', this.hide);
    this.$root.$on('show-menu', this.show);
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
    hide() {
      this.visibility = false;
    },
    show() {
      this.visibility = true;
    },
    onItemClick(event, item) {
      this.$emit('select-content', item);
    },
    onShowMenuClick() {
      this.visibility = !this.visibility;
      this.$root.$emit(this.visibility ? 'show-menu' : 'hide-menu');
    },
  },
};
</script>
<style>
.v-sidebar-menu .vsm-title {
  display: block;
  font-weight: 600;
  font-size: 0.9rem;
  margin-left: 15px;
  white-space: nowrap;
}
.v-sidebar-menu .vsm-item .vsm-item .vsm-title {
  display: block;
  font-weight: 200;
  font-size: 0.8rem;
  margin-left: 15px;
  white-space: nowrap;
}
.v-sidebar-menu {
  z-index: 8;
  padding-top: 70px;
  border-right: 1px dashed #de751f;
}
.vsm-arrow {
  display: none;
}
.v-sidebar-menu.white-theme.vsm-default .vsm-item.first-item.open-item>.vsm-link {
  background: #6c3910;
  box-shadow: inset 5px 0 0 0 #de751f !important;
}
.v-sidebar-menu.white-theme .collapse-btn {
  display: none;
}
.v-sidebar-menu .vsm-dropdown>.vsm-list {
    padding: 0px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.v-sidebar-menu.white-theme .vsm-dropdown>.vsm-list .vsm-link:hover {
  background-color: rgba(255, 255, 255, 0.5);
}
.v-sidebar-menu.vsm-default {
}
.v-sidebar-menu.vsm-collapsed {
}
.v-sidebar-menu .vsm-header {
}
.v-sidebar-menu .vsm-list {
}
.v-sidebar-menu .vsm-dropdown > .vsm-list {
}
.v-sidebar-menu .vsm-item {
    border-bottom: 1px dashed #fff;
}
.v-sidebar-menu .vsm-item.first-item {
  border-bottom: 1px dashed #de751f;
}
.v-sidebar-menu.white-theme
.vsm-item.first-item.active-item>.vsm-link {
  box-shadow: inset 3px 0 0 0 #6c3910 !important;
}
.v-sidebar-menu .vsm-item.mobile-item {
}
.v-sidebar-menu .vsm-item.open-item {
  border-bottom: 1px dashed #fff;
}
.v-sidebar-menu .vsm-list
.vsm-item.first-item.open-item.active-item
.vsm-link .vsm-title {
  font-weight: bold;
}
.v-sidebar-menu
.vsm-item.first-item.open-item
.vsm-dropdown .vsm-list
.vsm-item.active-item
.vsm-link .vsm-title {
  font-weight: bold;
}
.v-sidebar-menu
.vsm-item.first-item.open-item
.vsm-dropdown .vsm-list
.vsm-item.active-item {
  background-color: #fcd6b7;
  box-shadow: inset 5px 0 0 0 #6c3910 !important;
}
.v-sidebar-menu.white-theme .vsm-dropdown>.vsm-list {
  background-color: #fbebde6b;
}
.v-sidebar-menu
.vsm-item.first-item.open-item
.vsm-dropdown .vsm-list
.vsm-item .vsm-link .vsm-title {
  font-weight: normal;
}
.v-sidebar-menu .vsm-item .vsm-link .vsm-title {
  font-weight: normal;
}
.v-sidebar-menu .vsm-item.parent-active-item {
}
.v-sidebar-menu .vsm-link {
    overflow: hidden !important;
}
.v-sidebar-menu .vsm-title {
}
.v-sidebar-menu .vsm-icon {
}
.v-sidebar-menu .vsm-arrow {
}
.v-sidebar-menu .vsm-arrow.open-arrow {
}
.v-sidebar-menu .vsm-mobile-bg {
}
.v-sidebar-menu .vsm-badge {
}
.v-sidebar-menu.white-theme {
    background-color: #ffffff9e;
}
@media (max-width: 700px) {
  .v-sidebar-menu.white-theme {
    background-color: #ffffff;
  }
}
</style>
