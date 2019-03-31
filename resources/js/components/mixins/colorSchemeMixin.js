const colorSchemeMixin = {
    props: {
      /**
       * Check for dark component
       */
      isDark: { type: Boolean, default: false },

      /**
       * Color name - available:
       *
       * 'red', 'orange',
       * 'green', 'teal',
       * 'blue', 'yellow',
       * 'grey', 'indigo',
       * 'purple', 'pink'
       *
       */
      color: { type: String, default: 'grey' }
    },
    computed:{
      themeColors() {
        const color = this.color;
        const dark = this.isDark;

        return {
          contentTextActive: "black",
          contentText: dark
            ? "white" : "black",
          contentBackgroundPrimary: dark
            ? "content-dark" : 'content-light',
          contentBackgroundSecondary: dark
            ? "grey-dark" : 'grey-light',
          contentBackgroundTertiary: dark
            ? "grey-darker" : 'grey-lighter',
          contentBackgroundQuaternary: dark
            ? "grey-darkest" : 'grey-lightest',
          primary: color,
          secondary: dark
            ? `${color}-light` : `${color}-dark`,
          tertiary: dark
            ? `${color}-lighter` : `${color}-darker`,
          quaternary: dark
            ? `${color}-lightest` : `${color}-darkest`,
          hue: dark
            ? `dark` : `light`
        };
      }
    }
  };
  export default colorSchemeMixin;
