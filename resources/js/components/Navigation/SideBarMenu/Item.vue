<template>
  <div
    class="vsm-item"
    :class="[
      {'first-item' : firstItem},
      {'open-item' : show},
      {'active-item' : active},
      {'parent-active-item' : childActive}]"
    @mouseenter="mouseEnter($event)"
  >
    <template v-if="isRouterLink">
      <router-link
        class="vsm-link"
        :class="[
            show ? `
            t-bg-gradient-r-${themeColors.primary}
            t-border
            t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8
            t-border-gradient-t-${themeColors.primary}
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
        <template v-if="!isCollapsed">
          <span
            v-if="item.badge"
            :style="[
              rtl
              ? (item.child ? {'margin-left' : '30px'} : '')
              : (item.child ? {'margin-right' : '30px'} : '')]"
            class="vsm-badge"
            :class="[item.badge.class ? item.badge.class : 'default-badge']"
          >{{ item.badge.text }}</span>
          <span class="vsm-title">{{ item.title }}</span>
          <i v-if="item.child" class="vsm-arrow" :class="{'open-arrow' : show}"/>
        </template>
      </router-link>
    </template>
    <template v-else>
      <div
        class="vsm-link"
        :class="[
            show ? `
            t-bg-gradient-r-${themeColors.primary}
            t-border
            t-border-r-0 t-border-t-0 t-border-b-0
            t-border-l-8
            t-border-gradient-t-${themeColors.primary}
            t-shadow-md-${themeColors.primary}
            ` : '',
            isDark ? 't-opacity-75' : ''
        ]"
        :disabled="item.disabled"
        @click="linkClick($event, false, item, show)"
      >
        <i v-if="item.icon" class="vsm-icon" :class="item.icon"/>
        <template v-if="!isCollapsed">
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
                show ? `
                t-text-${themeColors.contentTextActive}
                ` : `t-text-${themeColors.contentText}`
            ]">
            {{ item.title }}
            </span>
          <i v-if="item.child" class="vsm-arrow" :class="{'open-arrow' : show}"/>
        </template>
      </div>
    </template>
    <template v-if="item.child">
      <template v-if="!isCollapsed">
        <transition
          name="expand"
          @enter="expandEnter"
          @afterEnter="expandAfterEnter"
          @beforeLeave="expandBeforeLeave"
        >
          <div
            v-if="show"
            class="vsm-dropdown"
            :class="[
              true ? `
                  t-bg-${themeColors.contentBackgroundQuaternary}
              ` : ''
            ]">
            <div
              class="vsm-list">
              <sub-item
                v-for="(subItem, index) in item.child"
                :key="index"
                :item="subItem"
                :is-dark="isDark"
                :color="color"/>
            </div>
          </div>
        </transition>
      </template>
    </template>
  </div>
</template>

<script>
import SubItem from './SubItem.vue';
import { itemMixin, animationMixin } from './mixin';

export default {
  components: {
    SubItem,
  },
  mixins: [itemMixin, animationMixin],
  props: {
    item: {
      type: Object,
      required: true,
    },
    firstItem: {
      type: Boolean,
      default: false,
    },
    isCollapsed: {
      type: Boolean,
    },
  },
  created() {
    this.$root.$on('item-clicked', this.changeActive);
  },
  methods: {
    mouseEnter(event) {
      if (this.isCollapsed && this.firstItem) {
        this.$parent.$emit('mouseEnterItem', {
          item: this.item,
          pos:
            event.currentTarget.getBoundingClientRect().top
            - this.$parent.$el.getBoundingClientRect().top,
          height: this.$el.offsetHeight,
        });
      }
    },
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
