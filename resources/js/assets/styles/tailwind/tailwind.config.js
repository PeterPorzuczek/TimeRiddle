/*
  Tailwind - The Utility-First CSS Framework
  A project by Adam Wathan (@adamwathan), Jonathan Reinink (@reinink),
  David Hemphill (@davidhemphill) and Steve Schoger (@steveschoger).
  Welcome to the Tailwind config file. This is where you can customize
  Tailwind specifically for your project. Don't be intimidated by the
  length of this file. It's really just a big JavaScript object and
  we've done our very best to explain each section.
  View the full documentation at https://tailwindcss.com.
*/

/*
  |-----------------------------------------------------------------------------
  | config
  |-----------------------------------------------------------------------------
  |
  | This variable contains the default Tailwind config.theme. You don't have
  | to use it, but it can sometimes be helpful to have available. For
  | example, you may choose to merge your custom configuration
  | values with some of the Tailwind defaults.
  |
*/

const config = require('tailwindcss/defaultConfig');

/*
  |-----------------------------------------------------------------------------
  | Colors                                   https://tailwindcss.com/docs/colors
  |-----------------------------------------------------------------------------
  |
  | Here you can specify the colors used in your project. To get you started,
  | we've provided a generous palette of great looking colors that are perfect
  | for prototyping, but don't hesitate to change them for your project. You
  | own these colors, nothing will break if you change everything about them.
  |
  | We've used literal color names ("red", "blue", etc.) for the default
  | palette, but if you'd rather use functional names like "primary" and
  | "secondary", or even a numeric scale like "100" and "200", go for it.
  |
*/

const colors = {

  'black': '#000',
  'white': '#fff',

  'content-dark': '#3e4850',
  'content-light': '#fff',

  'grey-darkest': '#384148',
  'grey-darker': '#4b5761',
  'grey-dark': '#3d4852',
  'grey': '#b8c2cc',
  'grey-light': '#f7fafc',
  'grey-lighter': '#f2f7f6',
  'grey-lightest': '#fafafa',

  'red-darkest': '#3b0d0c',
  'red-darker': '#621b18',
  'red-dark': '#cc1f1a',
  'red': '#e3342f',
  'red-light': '#ef5753',
  'red-lighter': '#e9f0f7',
  'red-lightest': '#fcebea',

  'orange-darkest': '#462a16',
  'orange-darker': '#613b1f',
  'orange-dark': '#de751f',
  'orange': '#f6993f',
  'orange-light': '#faad63',
  'orange-lighter': '#fcd9b6',
  'orange-lightest': '#fff5eb',

  'yellow-darkest': '#453411',
  'yellow-darker': '#684f1d',
  'yellow-dark': '#f2d024',
  'yellow': '#ffed4a',
  'yellow-light': '#fff382',
  'yellow-lighter': '#fff9c2',
  'yellow-lightest': '#fcfbeb',

  'green-darkest': '#0f2f21',
  'green-darker': '#1a4731',
  'green-dark': '#1f9d55',
  'green': '#38c172',
  'green-light': '#51d88a',
  'green-lighter': '#a2f5bf',
  'green-lightest': '#e3fcec',

  'teal-darkest': '#0d3331',
  'teal-darker': '#20504f',
  'teal-dark': '#38a89d',
  'teal': '#4dc0b5',
  'teal-light': '#64d5ca',
  'teal-lighter': '#a0f0ed',
  'teal-lightest': '#e8fffe',

  'blue-darkest': '#12283a',
  'blue-darker': '#1c3d5a',
  'blue-dark': '#2779bd',
  'blue': '#3490dc',
  'blue-light': '#6cb2eb',
  'blue-lighter': '#bcdefa',
  'blue-lightest': '#eff8ff',

  'indigo-darkest': '#191e38',
  'indigo-darker': '#2f365f',
  'indigo-dark': '#5661b3',
  'indigo': '#6574cd',
  'indigo-light': '#7886d7',
  'indigo-lighter': '#b2b7ff',
  'indigo-lightest': '#e6e8ff',

  'purple-darkest': '#21183c',
  'purple-darker': '#382b5f',
  'purple-dark': '#794acf',
  'purple': '#9561e2',
  'purple-light': '#a779e9',
  'purple-lighter': '#d6bbfc',
  'purple-lightest': '#f3ebff',

  'pink-darkest': '#451225',
  'pink-darker': '#6f213f',
  'pink-dark': '#eb5286',
  'pink': '#f66d9b',
  'pink-light': '#fa7ea8',
  'pink-lighter': '#ffbbca',
  'pink-lightest': '#ffebef',

  transparent: 'transparent',
};

const bgcolors = colors;

/*
  |-----------------------------------------------------------------------------
  | Colors                                  https://tailwindcss.com/docs/colors
  |-----------------------------------------------------------------------------
  |
  | The color palette defined above is also assigned to the "colors" key of
  | your Tailwind config.theme. This makes it easy to access them in your CSS
  | using Tailwind's config helper. For example:
  |
  | .error { color: config('colors.red') }
  |
*/

config.theme.colors = colors;

/*
  |-----------------------------------------------------------------------------
  | Text colors                         https://tailwindcss.com/docs/text-color
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your text colors. By default these use the
  | color palette we defined above, however you're welcome to set these
  | independently if that makes sense for your project.
  |
  | Class name: .text-{color}
  |
*/
config.theme.textColor = colors;

/*
  |-----------------------------------------------------------------------------
  | Border colors                     https://tailwindcss.com/docs/border-color
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your border colors. By default these use the
  | color palette we defined above, however you're welcome to set these
  | independently if that makes sense for your project.
  |
  | Take note that border colors require a special "default" value set
  | as well. This is the color that will be used when you do not
  | specify a border color.
  |
  | Class name: .border-{color}
  |
*/

config.theme.borderColor = colors;

/*
  |-----------------------------------------------------------------------------
  | Background colors             https://tailwindcss.com/docs/background-color
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your background colors. By default these use
  | the color palette we defined above, however you're welcome to set
  | these independently if that makes sense for your project.
  |
  | Class name: .bg-{color}
  |
*/

config.theme.backgroundColor = global.Object.assign(bgcolors, colors);

/*
  |-----------------------------------------------------------------------------
  | Screens                      https://tailwindcss.com/docs/responsive-design
  |-----------------------------------------------------------------------------
  |
  | Screens in Tailwind are translated to CSS media queries. They define the
  | responsive breakpoints for your project. By default Tailwind takes a
  | "mobile first" approach, where each screen size represents a minimum
  | viewport width. Feel free to have as few or as many screens as you
  | want, naming them in whatever way you'd prefer for your project.
  |
  | Tailwind also allows for more complex screen definitions, which can be
  | useful in certain situations. Be sure to see the full responsive
  | documentation for a complete list of options.
  |
  | Class name: .{screen}:{utility}
  |
*/

config.theme.screens = {
  't-sm': { min: '0px', max: '718px' },
  't-md': { min: '719px', max: '991px' },
  't-lg': { min: '992px', max: '1999px' },
};

/*
  |-----------------------------------------------------------------------------
  | Fonts                                    https://tailwindcss.com/docs/fonts
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your project's font stack, or font families.
  | Keep in mind that Tailwind doesn't actually load any fonts for you.
  | If you're using custom fonts you'll need to import them prior to
  | defining them here.
  |
  | By default we provide a native font stack that works remarkably well on
  | any device or OS you're using, since it just uses the default fonts
  | provided by the platform.
  |
  | Class name: .font-{name}
  |
*/

config.theme.fontFamily = {
  sans: [
    'system-ui',
    'BlinkMacSystemFont',
    '-apple-system',
    'Segoe UI',
    'Roboto',
    'Oxygen',
    'Ubuntu',
    'Cantarell',
    'Fira Sans',
    'Droid Sans',
    'Helvetica Neue',
    'sans-serif',
  ],
  serif: [
    'Constantia',
    'Lucida Bright',
    'Lucidabright',
    'Lucida Serif',
    'Lucida',
    'DejaVu Serif',
    'Bitstream Vera Serif',
    'Liberation Serif',
    'Georgia',
    'serif',
  ],
  body: ['Roboto Mono'],
  normal: ['Roboto Mono'],
};

/*
  |-----------------------------------------------------------------------------
  | Text sizes                         https://tailwindcss.com/docs/text-sizing
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your text sizes. Name these in whatever way
  | makes the most sense to you. We use size names by default, but
  | you're welcome to use a numeric scale or even something else
  | entirely.
  |
  | By default Tailwind uses the "rem" unit type for most measurements.
  | This allows you to set a root font size which all other sizes are
  | then based on. That said, you are free to use whatever units you
  | prefer, be it rems, ems, pixels or other.
  |
  | Class name: .text-{size}
  |
*/

config.theme.textSize = {
  xs: '.75rem',
  sm: '.8125rem',
  base: '1rem', // 16px
  lg: '1.125rem', // 18px
  xl: '1.25rem', // 20px
  '2xl': '1.5rem', // 24px
  '3xl': '1.875rem', // 30px
  '4xl': '2.25rem', // 36px
  '5xl': '3rem', // 48px
};

/*
|-----------------------------------------------------------------------------
| Font weights                       https://tailwindcss.com/docs/font-weight
|-----------------------------------------------------------------------------
|
| Here is where you define your font weights. We've provided a list of
| common font weight names with their respective numeric scale values
| to get you started. It's unlikely that your project will require
| all of these, so we recommend removing those you don't need.
|
| Class name: .font-{weight}
|
*/

config.theme.fontWeight = {
  hairline: 100,
  thin: 200,
  light: 300,
  normal: 400,
  medium: 500,
  semibold: 600,
  bold: 700,
  extrabold: 800,
  black: 900,
};

/*
  |-----------------------------------------------------------------------------
  | Leading (line height)              https://tailwindcss.com/docs/line-height
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your line height values, or as we call
  | them in Tailwind, leadings.
  |
  | Class name: .leading-{size}
  |
*/

config.theme.lineHeight = {
  none: 1,
  tight: 1.25,
  normal: 1.5,
  loose: 2,
};

/*
  |-----------------------------------------------------------------------------
  | Tracking (letter spacing)       https://tailwindcss.com/docs/letter-spacing
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your letter spacing values, or as we call
  | them in Tailwind, tracking.
  |
  | Class name: .tracking-{size}
  |
*/

config.theme.letterSpacing = {
  tight: '-0.05em',
  normal: '0',
  wide: '0.05em',
};

/*
  |-----------------------------------------------------------------------------
  | Background sizes               https://tailwindcss.com/docs/background-size
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your background sizes. We provide some common
  | values that are useful in most projects, but feel free to add other sizes
  | that are specific to your project here as well.
  |
  | Class name: .bg-{size}
  |
*/

config.theme.backgroundSize = {
  auto: 'auto',
  cover: 'cover',
  contain: 'contain',
};

/*
  |-----------------------------------------------------------------------------
  | Border widths                     https://tailwindcss.com/docs/border-width
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your border widths. Take note that border
  | widths require a special "default" value set as well. This is the
  | width that will be used when you do not specify a border width.
  |
  | Class name: .border{-side?}{-width?}
  |
*/

config.theme.borderWidth = {
  0: '0px',
  default: '1px',
  4: '4px',
  6: '6px',
  8: '8px',
};

/*
  |-----------------------------------------------------------------------------
  | Border radius                    https://tailwindcss.com/docs/border-radius
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your border radius values. If a `default` radius
  | is provided, it will be made available as the non-suffixed `.rounded`
  | utility.
  |
  | If your scale includes a `0` value to reset already rounded corners, it's
  | a good idea to put it first so other values are able to override it.
  |
  | Class name: .rounded{-side?}{-size?}
  |
*/

config.theme.borderRadius = {
  none: '0',
  sm: '.125rem',
  default: '.25rem',
  full: '9999px',
};

/*
  |-----------------------------------------------------------------------------
  | Width                                    https://tailwindcss.com/docs/width
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your width utility sizes. These can be
  | percentage based, pixels, rems, or any other units. By default
  | we provide a sensible rem based numeric scale, a percentage
  | based fraction scale, plus some other common use-cases. You
  | can, of course, modify these values as needed.
  |
  |
  | It's also worth mentioning that Tailwind automatically escapes
  | invalid CSS class name characters, which allows you to have
  | awesome classes like .w-2/3.
  |
  | Class name: .w-{size}
  |
*/

config.theme.width = {
  auto: 'auto',
  px: '1px',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
  10: '2.5rem',
  12: '3rem',
  16: '4rem',
  24: '6rem',
  28: '7rem',
  32: '8rem',
  36: '9rem',
  40: '10rem',
  44: '11rem',
  48: '12rem',
  52: '14rem',
  64: '16rem',
  72: '18rem',
  80: '20rem',
  88: '22rem',
  92: '23rem',
  96: '24rem',
  'sticky-panel': '14.5rem',
  panel: '12.625rem',
  content: '31rem',
  'content-box': '60rem',
  '1/2': '50%',
  '1/3': '33.33333%',
  '2/3': '66.66667%',
  '1/4': '25%',
  '3/4': '75%',
  '1/5': '20%',
  '2/5': '40%',
  '3/5': '60%',
  '4/5': '80%',
  '1/6': '16.66667%',
  '5/6': '83.33333%',
  '7/10': '70%',
  '9/10': '90%',
  full: '100%',
  screen: '100vw',
};

/*
  |-----------------------------------------------------------------------------
  | Height                                  https://tailwindcss.com/docs/height
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your height utility sizes. These can be
  | percentage based, pixels, rems, or any other units. By default
  | we provide a sensible rem based numeric scale plus some other
  | common use-cases. You can, of course, modify these values as
  | needed.
  |
  | Class name: .h-{size}
  |
*/

config.theme.height = {
  auto: 'auto',
  px: '1px',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
  10: '2.5rem',
  12: '3rem',
  16: '4rem',
  20: '5rem',
  24: '6rem',
  32: '8rem',
  40: '10rem',
  48: '12rem',
  52: '14rem',
  64: '16rem',
  72: '18rem',
  80: '20rem',
  88: '22rem',
  96: '24rem',
  104: '26rem',
  112: '28rem',
  full: '100%',
  screen: '100vh',
  bar: '50px',
};

/*
  |-----------------------------------------------------------------------------
  | Minimum width                        https://tailwindcss.com/docs/min-width
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your minimum width utility sizes. These can
  | be percentage based, pixels, rems, or any other units. We provide a
  | couple common use-cases by default. You can, of course, modify
  | these values as needed.
  |
  | Class name: .min-w-{size}
  |
*/

config.theme.minWidth = {
  0: '0',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
  10: '2.5rem',
  12: '3rem',
  16: '4rem',
  24: '6rem',
  32: '8rem',
  48: '12rem',
  64: '16rem',
  72: '18rem',
  80: '20rem',
  88: '22rem',
  92: '23rem',
  96: '24rem',
  '1/2': '50%',
  '1/3': '33.33333%',
  '2/3': '66.66667%',
  '1/4': '25%',
  '3/4': '75%',
  '1/5': '20%',
  '2/5': '40%',
  '3/5': '60%',
  '4/5': '80%',
  '1/6': '16.66667%',
  '5/6': '83.33333%',
  full: '100%',
  'sticky-panel': '14.5rem',
  panel: '12.625rem',
  content: '31rem',
  'content-box': '60rem',
};

/*
  |-----------------------------------------------------------------------------
  | Minimum height                      https://tailwindcss.com/docs/min-height
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your minimum height utility sizes. These can
  | be percentage based, pixels, rems, or any other units. We provide a
  | few common use-cases by default. You can, of course, modify these
  | values as needed.
  |
  | Class name: .min-h-{size}
  |
*/

config.theme.minHeight = {
  auto: 'auto',
  px: '1px',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  48: '12rem',
  full: '100%',
  screen: '100vh',
  bar: '50px',
};

/*
  |-----------------------------------------------------------------------------
  | Maximum width                        https://tailwindcss.com/docs/max-width
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your maximum width utility sizes. These can
  | be percentage based, pixels, rems, or any other units. By default
  | we provide a sensible rem based scale and a "full width" size,
  | which is basically a reset utility. You can, of course,
  | modify these values as needed.
  |
  | Class name: .max-w-{size}
  |
*/

config.theme.maxWidth = {
  xs: '20rem',
  sm: '30rem',
  md: '40rem',
  lg: '50rem',
  xl: '60rem',
  '2xl': '70rem',
  '3xl': '80rem',
  '4xl': '90rem',
  '5xl': '100rem',
  full: '100%',
};

/*
  |-----------------------------------------------------------------------------
  | Maximum height                      https://tailwindcss.com/docs/max-height
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your maximum height utility sizes. These can
  | be percentage based, pixels, rems, or any other units. We provide a
  | couple common use-cases by default. You can, of course, modify
  | these values as needed.
  |
  | Class name: .max-h-{size}
  |
*/

config.theme.maxHeight = {
  full: '100%',
  screen: '100vh',
};

/*
|-----------------------------------------------------------------------------
| Padding                                https://tailwindcss.com/docs/padding
|-----------------------------------------------------------------------------
|
| Here is where you define your padding utility sizes. These can be
| percentage based, pixels, rems, or any other units. By default we
| provide a sensible rem based numeric scale plus a couple other
| common use-cases like "1px". You can, of course, modify these
| values as needed.
|
| Class name: .p{side?}-{size}
|
*/

config.theme.padding = {
  px: '1px',
  0: '0',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
};

/*
|-----------------------------------------------------------------------------
| Margin                                  https://tailwindcss.com/docs/margin
|-----------------------------------------------------------------------------
|
| Here is where you define your margin utility sizes. These can be
| percentage based, pixels, rems, or any other units. By default we
| provide a sensible rem based numeric scale plus a couple other
| common use-cases like "1px". You can, of course, modify these
| values as needed.
|
| Class name: .m{side?}-{size}
|
*/

config.theme.margin = {
  auto: 'auto',
  px: '1px',
  0: '0',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
};

/*
  |-----------------------------------------------------------------------------
  | Negative margin                https://tailwindcss.com/docs/negative-margin
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your negative margin utility sizes. These can
  | be percentage based, pixels, rems, or any other units. By default we
  | provide matching values to the padding scale since these utilities
  | generally get used together. You can, of course, modify these
  | values as needed.
  |
  | Class name: .-m{side?}-{size}
  |
*/

config.theme.negativeMargin = {
  auto: 'auto',
  px: '1px',
  0: '0',
  1: '0.25rem',
  2: '0.5rem',
  3: '0.75rem',
  4: '1rem',
  6: '1.5rem',
  8: '2rem',
  9: '3rem',
};

/*
  |-----------------------------------------------------------------------------
  | Shadows                                https://tailwindcss.com/docs/shadows
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your shadow utilities. As you can see from
  | the defaults we provide, it's possible to apply multiple shadows
  | per utility using comma separation.
  |
  | If a `default` shadow is provided, it will be made available as the non-
  | suffixed `.shadow` utility.
  |
  | Class name: .shadow-{size?}
  |
*/

config.theme.boxShadow = {
  default: '0 2px 4px 0 rgba(0,0,0,0.10)',
  sm: '1px 1px 2px 0 rgba(0,0,0,.2)',
  md: '0 4px 8px 0 rgba(0,0,0,0.12), 0 2px 4px 0 rgba(0,0,0,0.08)',
  lg: '0 15px 30px 0 rgba(0,0,0,0.11), 0 5px 15px 0 rgba(0,0,0,0.08)',
  inner: 'inset 0 2px 4px 0 rgba(0,0,0,0.08)',
  none: 'none',
  add: '0 10px 40px -6px rgba(0,0,0,.1)',
  box: '0 10px 40px -6px rgba(0,0,0,.03)',
  'inner-sm': 'inset 0 -1px 0 0 rgba(0,0,0,.2),1px 1px 2px 0 rgba(0,0,0,.2)',
  'nm-light': ' rgba(0,0,0,.02) 0 4px 6px -1px,rgba(0,0,0,.06) 0 2px 4px -1px',
  'nm-dark': '0 2px 12px 0 #0000005e',
  'md-grey': `0 4px 8px 0 ${colors.grey}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-red': `0 4px 8px 0 ${colors.red}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-orange': `0 4px 8px 0 ${colors.orange}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-yellow': `0 4px 8px 0 ${colors.yellow}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-green': `0 4px 8px 0 ${colors.green}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-teal': `0 4px 8px 0 ${colors.teal}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-blue': `0 4px 8px 0 ${colors.blue}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-indigo': `0 4px 8px 0 ${colors.indigo}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-purple': `0 4px 8px 0 ${colors.purple}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
  'md-pink': `0 4px 8px 0 ${colors.pink}69, 0 2px 4px 0 rgba(0,0,0,0.08)`,
};

/*
  |-----------------------------------------------------------------------------
  | Z-index                                https://tailwindcss.com/docs/z-index
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your z-index utility values. By default we
  | provide a sensible numeric scale. You can, of course, modify these
  | values as needed.
  |
  | Class name: .z-{index}
  |
*/

config.theme.zIndex = {
  auto: 'auto',
  0: 0,
  10: 10,
  20: 20,
  30: 30,
  40: 40,
  50: 50,
  150: 150,
  200: 200,
  250: 250,
  300: 300,
  310: 310,
};

/*
  |-----------------------------------------------------------------------------
  | Opacity                                https://tailwindcss.com/docs/opacity
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your opacity utility values. By default we
  | provide a sensible numeric scale. You can, of course, modify these
  | values as needed.
  |
  | Class name: .opacity-{name}
  |
*/

config.theme.opacity = {
  0: '0',
  25: '.25',
  50: '.5',
  75: '.75',
  100: '1',
};

/*
  |-----------------------------------------------------------------------------
  | SVG fill                                   https://tailwindcss.com/docs/svg
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your SVG fill colors. By default we just provide
  | `fill-current` which sets the fill to the current text color. This lets you
  | specify a fill color using existing text color utilities and helps keep the
  | generated CSS file size down.
  |
  | Class name: .fill-{name}
  |
*/

config.theme.fill = {
  current: 'currentColor',
};

/*
  |-----------------------------------------------------------------------------
  | SVG stroke                                 https://tailwindcss.com/docs/svg
  |-----------------------------------------------------------------------------
  |
  | Here is where you define your SVG stroke colors. By default we just provide
  | `stroke-current` which sets the stroke to the current text color. This lets
  | you specify a stroke color using existing text color utilities and helps
  | keep the generated CSS file size down.
  |
  | Class name: .stroke-{name}
  |
*/

config.theme.stroke = {
  current: 'currentColor',
};

/*
|-----------------------------------------------------------------------------
| Variants                  https://tailwindcss.com/docs/configuration#modules
|-----------------------------------------------------------------------------
|
| Here is where you control which modules are generated and what variants are
| generated for each of those modules.
|
| Currently supported variants:
|   - responsive
|   - hover
|   - focus
|   - active
|   - group-hover
|
| To disable a module completely, use `false` instead of an array.
|
*/

config.theme.variants = {
  alignContent: ['responsive'],
  alignItems: ['responsive'],
  alignSelf: ['responsive'],
  appearance: ['responsive'],
  backgroundAttachment: ['responsive'],
  backgroundColor: ['responsive', 'hover', 'focus'],
  backgroundPosition: ['responsive'],
  backgroundRepeat: ['responsive'],
  backgroundSize: ['responsive'],
  borderCollapse: ['responsive'],
  borderColor: ['responsive', 'hover', 'focus'],
  borderRadius: ['responsive'],
  borderStyle: ['responsive'],
  borderWidth: ['responsive'],
  boxShadow: ['responsive', 'hover', 'focus'],
  cursor: ['responsive'],
  display: ['responsive'],
  fill: ['responsive'],
  flex: ['responsive'],
  flexDirection: ['responsive'],
  flexGrow: ['responsive'],
  flexShrink: ['responsive'],
  flexWrap: ['responsive'],
  float: ['responsive'],
  fontFamily: ['responsive'],
  fontSize: ['responsive'],
  fontSmoothing: ['responsive'],
  fontStyle: ['responsive'],
  fontWeight: ['responsive', 'hover', 'focus'],
  height: ['responsive'],
  inset: ['responsive'],
  justifyContent: ['responsive'],
  letterSpacing: ['responsive'],
  lineHeight: ['responsive'],
  listStylePosition: ['responsive'],
  listStyleType: ['responsive'],
  margin: ['responsive'],
  maxHeight: ['responsive'],
  maxWidth: ['responsive'],
  minHeight: ['responsive'],
  minWidth: ['responsive'],
  objectFit: ['responsive'],
  objectPosition: ['responsive'],
  opacity: ['responsive'],
  order: ['responsive'],
  outline: ['responsive', 'focus'],
  overflow: ['responsive'],
  padding: ['responsive'],
  pointerEvents: ['responsive'],
  position: ['responsive'],
  resize: ['responsive'],
  stroke: ['responsive'],
  tableLayout: ['responsive'],
  textAlign: ['responsive'],
  textColor: ['responsive', 'hover', 'focus'],
  textDecoration: ['responsive', 'hover', 'focus'],
  textTransform: ['responsive'],
  userSelect: ['responsive'],
  verticalAlign: ['responsive'],
  visibility: ['responsive'],
  whitespace: ['responsive'],
  width: ['responsive'],
  wordBreak: ['responsive'],
  zIndex: ['responsive']
};

/*
|-----------------------------------------------------------------------------
| Plugins                                https://tailwindcss.com/docs/plugins
|-----------------------------------------------------------------------------
|
| Here is where you can register any plugins you'd like to use in your
| project. Tailwind's built-in `container` plugin is enabled by default to
| give you a Bootstrap-style responsive container component out of the box.
|
| Be sure to view the complete plugin documentation to learn more about how
| the plugin system works.
|
*/

config.plugins = [
  require('tailwindcss-border-gradients')({
    variants: ['responsive'],
    directions: {
      't': 'to top',
      'r': 'to right',
      'b': 'to bottom',
      'l': 'to left',
    },
    gradients: {
        'grey-dark': [colors['grey-darker'], colors['grey-darkest']],
        'grey': [colors['grey-light'], colors['grey']],
        'red-dark': [colors['red-darker'], colors['red-darkest']],
        'red': [colors['red-light'], colors['red-dark']],
        'orange-dark': [colors['orange-darker'], colors['orange-darkest']],
        'orange': [colors['orange-light'], colors['orange-dark']],
        'yellow-dark': [colors['yellow-darker'], colors['yellow-darkest']],
        'yellow': [colors['yellow-light'], colors['yellow-dark']],
        'green-dark': [colors['green-darker'], colors['green-darkest']],
        'green': [colors['green-light'], colors['green-dark']],
        'teal-dark': [colors['teal-darker'], colors['teal-darkest']],
        'teal': [colors['teal-light'], colors['teal-dark']],
        'blue-dark': [colors['blue-darker'], colors['blue-darkest']],
        'blue': [colors['blue-light'], colors['blue-dark']],
        'indigo-dark': [colors['indigo-darker'], colors['indigo-darkest']],
        'indigo': [colors['indigo-light'], colors['indigo-dark']],
        'purple-dark': [colors['purple-darker'], colors['purple-darkest']],
        'purple': [colors['purple-light'], colors['purple-dark']],
        'pink-dark': [colors['pink-darker'], colors['pink-darkest']],
        'pink': [colors['pink-light'], colors['pink-dark']],
    },
  }),
  require('tailwindcss-gradients')({
    variants: ['responsive'],
    directions: {
      't': 'to top',
      'r': 'to right',
      'b': 'to bottom',
      'l': 'to left',
    },
    gradients: {
        'grey-dark': [colors['grey-darker'], colors['grey-darkest']],
        'grey': [colors['grey-light'], colors['grey']],
        'red-dark': [colors['red-darker'], colors['red-darkest']],
        'red': [colors['red-light'], colors['red-dark']],
        'orange-dark': [colors['orange-darker'], colors['orange-darkest']],
        'orange': [colors['orange-light'], colors['orange-dark']],
        'yellow-dark': [colors['yellow-darker'], colors['yellow-darkest']],
        'yellow': [colors['yellow-light'], colors['yellow-dark']],
        'green-dark': [colors['green-darker'], colors['green-darkest']],
        'green': [colors['green-light'], colors['green-dark']],
        'teal-dark': [colors['teal-darker'], colors['teal-darkest']],
        'teal': [colors['teal-light'], colors['teal-dark']],
        'blue-dark': [colors['blue-darker'], colors['blue-darkest']],
        'blue': [colors['blue-light'], colors['blue-dark']],
        'indigo-dark': [colors['indigo-darker'], colors['indigo-darkest']],
        'indigo': [colors['indigo-light'], colors['indigo-dark']],
        'purple-dark': [colors['purple-darker'], colors['purple-darkest']],
        'purple': [colors['purple-light'], colors['purple-dark']],
        'pink-dark': [colors['pink-darker'], colors['pink-darkest']],
        'pink': [colors['pink-light'], colors['pink-dark']],
    },
  }),
  require("tailwind-heropatterns")({
    variants: [],
    patterns: [
        "overcast",
        "happy-intersection",
        "random-shapes",
        "cutout",
        "death-star",
        "steel-beams",
        "morphing-diamonds",
        "leaf"
    ],
    colors: {
      "grey": colors.grey,
      "red": colors.red,
      "orange": colors.orange,
      "yellow": colors.yellow,
      "green": colors.green,
      "teal": colors.teal,
      "blue": colors.blue,
      "indigo": colors.indigo,
      "purple": colors.purple,
      "pink": colors.pink,
    },
    opacity: {
      default: "0.1",
      "low": "0.015"
    }
  })
];

/*
  |-----------------------------------------------------------------------------
  | Advanced Options         https://tailwindcss.com/docs/configuration#options
  |-----------------------------------------------------------------------------
  |
  | Here is where you can tweak advanced configuration options. We recommend
  | leaving these options alone unless you absolutely need to change them.
  |
*/

config.prefix = 't-';

module.exports = config;
