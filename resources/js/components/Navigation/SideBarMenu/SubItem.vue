<template>
  <div
    class="vsm-item"
    :class="[
      {'open-item' : show},
      {'active-item' : active},
      {'parent-active-item' : childActive}]"
  >
    <template v-if="isRouterLink">
      <router-link
        class="vsm-link"
        :class="[
            show ? `
            t-bg-gradient-l-${themeColors.primary}
            t-border
            t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8
            t-border-gradient-b-${themeColors.primary}
            t-shadow-md-${themeColors.primary}
            ` : '',
            isDark ? 't-opacity-75' : ''
        ]"
        :to="item.href"
        :disabled="item.disabled"
        :event="item.disabled ? '' : 'click'"
        @click.native="clickEvent($event, false, item, show)"
      >
        <i v-if="item.icon" class="vsm-icon" :class="item.icon"/>
        <span
          v-if="item.badge"
          :style="[
            rtl
              ? (item.child ? {'margin-left' : '30px'} : '')
              : (item.child ? {'margin-right' : '30px'} : '')]"
          class="vsm-badge"
          :class="[item.badge.class ? item.badge.class : 'default-badge']"
        >{{ item.badge.text }}</span>
        <span
            class="vsm-title"
            :class="[
                active ? `
                t-text-${themeColors.contentTextActive}
                ` : `t-text-${themeColors.contentText}`
            ]">
            {{ item.title }}
        </span>
        <i v-if="item.child" class="vsm-arrow" :class="{'open-arrow' : show}"/>
      </router-link>
    </template>
    <template v-else>
      <div
        class="vsm-link"
        :class="[
            active ? `
            t-bg-gradient-l-${themeColors.primary}
            t-border
            t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8
            t-border-gradient-b-${themeColors.primary}
            t-shadow-md-${themeColors.primary}
            ` : '',
            isDark ? 't-opacity-75' : ''
        ]"
        :disabled="item.disabled"
        @click="linkClick($event, false, item, show)"
      >
        <i v-if="item.icon" class="vsm-icon" :class="item.icon"/>
        <span
          v-if="item.badge"
          :style="[
            rtl
            ? (item.child ? {'margin-left' : '30px'} : '')
            : (item.child ? {'margin-right' : '30px'} : '')]"
          class="vsm-badge"
          :class="[item.badge.class ? item.badge.class : 'default-badge']"
        >{{ item.badge.text }}</span>
        <span
            class="vsm-title"
            :class="[
                active ? `
                t-text-${themeColors.contentTextActive}
                ` : `t-text-${themeColors.contentText}`
            ]">
        {{ item.title }}
        </span>
        <i v-if="item.child" class="vsm-arrow" :class="{'open-arrow' : show}"/>
      </div>
    </template>
    <template v-if="item.child">
      <transition
        name="expand"
        @enter="expandEnter"
        @afterEnter="expandAfterEnter"
        @beforeLeave="expandBeforeLeave"
      >
        <div v-if="show" class="vsm-dropdown">
          <div
            class="vsm-list">
            <item
                v-for="(subItem, index) in item.child"
                :key="index"
                :item="subItem"
                :is-dark="isDark"
                :color="color"/>
          </div>
        </div>
      </transition>
    </template>
  </div>
</template>

<script>
import Item from './Item.vue';
import { itemMixin, animationMixin } from './mixin';

export default {
  components: {
    Item,
  },
  mixins: [itemMixin, animationMixin],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  beforeCreate() {
    this.$options.components.Item = require('./Item.vue').default;
  },
  created() {
    this.$root.$on('item-clicked', this.changeActive);
  },
  methods: {
    changeActive(item) {
      this.active = item.title === this.item.title;
    },
    linkClick($event, mobile, item, show) {
      this.$root.$emit('item-clicked', item);
      this.clickEvent($event, mobile, item, show);
    },
  },
};
</script>
