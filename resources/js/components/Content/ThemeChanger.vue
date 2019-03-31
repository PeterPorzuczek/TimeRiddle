<template>
<div class="t-flex t-items-center t-justify-center t-px-2">
  <label class="switch">
    <input type="checkbox" v-model="dark">
    <span class="slider round" :class="`t-bg-${themeColors.primary}`"></span>
  </label>
  <div class="select-dropdown t-mx-2 t-py-1 t-flex t-justify-center t-items-center">
    <select v-model="currentTheme">
      <option
        v-for="(theme, index) in themes"
        :key="`theme-${index}-${theme}`"
        v-bind:value="theme">
        {{ theme }}
      </option>
    </select>
  </div>
</div>
</template>

<script>
export default {
  name: "ThemeChanger",
  data() {
    return {
       dark: false,
       currentTheme: "blue",
       themes: [
            'grey',
            'red',
            'orange',
            'yellow',
            'green',
            'teal',
            'blue',
            'indigo',
            'purple',
            'pink',
        ],
    }
  },
  watch: {
    isDark: {
      immediate: true,
      handler(value) {
        this.dark = value;
      }
    },
    color: {
      immediate: true,
      handler(value) {
        this.currentTheme = value;
      }
    },
    dark(value) {
      this.$emit('hue-change', value);
    },
    currentTheme(value) {
      this.$emit('theme-change', value);
    }
  }
}
</script>

<style scoped>
.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 20px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: .4;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  opacity: 1;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(9px);
  -ms-transform: translateX(9px);
  transform: translateX(9px);
}

.slider.round {
  border-radius: 20px;
}

.slider.round:before {
  border-radius: 50%;
}

.select-dropdown {
  position: relative;
  background-color: #fafafa;
  width: auto;
  float: right;
  max-width: 100%;
  border-radius: 2px;
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
