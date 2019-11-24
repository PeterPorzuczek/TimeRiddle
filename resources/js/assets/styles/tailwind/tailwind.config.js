const config = require('tailwindcss/defaultConfig');

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

const bgcolors = {
  'red-light': '#ef5753',
  'orange-light': '#faad63',
  'green-light': '#51d88a',
  'blue-light': '#09c'
};

config.theme.colors = colors;

config.theme.textColor = colors;

config.theme.borderColor = colors;

config.theme.backgroundColor = global.Object.assign(bgcolors, colors);

config.theme.screens = {
  't-sm': { min: '0px', max: '718px' },
  't-md': { min: '719px', max: '991px' },
  't-lg': { min: '992px', max: '1999px' },
};

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

config.theme.fontSize = {
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

config.theme.lineHeight = {
  none: 1,
  tight: 1.25,
  normal: 1.5,
  loose: 2,
};

config.theme.letterSpacing = {
  tight: '-0.05em',
  normal: '0',
  wide: '0.05em',
};

config.theme.backgroundSize = {
  auto: 'auto',
  cover: 'cover',
  contain: 'contain',
};

config.theme.borderWidth = {
  0: '0px',
  default: '1px',
  4: '4px',
  6: '6px',
  8: '8px',
};

config.theme.borderRadius = {
  none: '0',
  sm: '.125rem',
  default: '.25rem',
  full: '9999px',
};

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

config.theme.maxHeight = {
  full: '100%',
  screen: '100vh',
};

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
  '-px': '-1px',
  '-1': '-0.25rem',
  '-2': '-0.5rem',
  '-3': '-0.75rem',
  '-4': '-1rem',
  '-6': '-1.5rem',
  '-8': '-2rem',
  '-9': '-3rem'
};

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

config.theme.opacity = {
  0: '0',
  25: '.25',
  50: '.5',
  75: '.75',
  100: '1',
};

config.theme.fill = {
  current: 'currentColor',
};

config.theme.stroke = {
  current: 'currentColor',
};

config.variants = {
    accessibility: [],
    alignContent: ['responsive'],
    alignItems: ['responsive'],
    alignSelf: ['responsive'],
    appearance: ['responsive'],
    backgroundAttachment: [],
    backgroundColor: ['responsive', 'hover'],
    backgroundPosition: ['responsive'],
    backgroundRepeat: [],
    backgroundSize: ['responsive'],
    borderCollapse: [],
    borderColor: ['responsive', 'hover'],
    borderRadius: ['responsive'],
    borderStyle: [],
    borderWidth: ['responsive'],
    boxShadow: ['responsive', 'hover'],
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
    fontSmoothing: [],
    fontStyle: [],
    fontWeight: ['responsive', 'hover'],
    height: ['responsive'],
    inset: ['responsive'],
    justifyContent: ['responsive'],
    letterSpacing: ['responsive'],
    lineHeight: ['responsive'],
    listStylePosition: [],
    listStyleType: [],
    margin: ['responsive'],
    maxHeight: ['responsive'],
    maxWidth: ['responsive'],
    minHeight: ['responsive'],
    minWidth: ['responsive'],
    objectFit: [],
    objectPosition: [],
    opacity: ['responsive'],
    order: [],
    outline: ['focus'],
    overflow: ['responsive'],
    padding: ['responsive'],
    placeholderColor: [],
    pointerEvents: ['responsive'],
    position: ['responsive'],
    resize: [],
    stroke: [],
    tableLayout: [],
    textAlign: ['responsive'],
    textColor: ['responsive', 'hover'],
    textSize: ['responsive'],
    textDecoration: [],
    textTransform: ['responsive'],
    userSelect: [],
    verticalAlign: ['responsive'],
    visibility: ['responsive'],
    whitespace: ['responsive'],
    width: ['responsive'],
    wordBreak: ['responsive'],
    zIndex: ['responsive']
};

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
      "low": "0.02"
    }
  })
];

config.corePlugins = {
    preflight: false
};

config.prefix = 't-';

module.exports = config;
