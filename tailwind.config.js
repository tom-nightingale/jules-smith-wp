module.exports = {
  content: ["./_views/**/*.twig", './safelist.txt'],
  safelist: [
    'bg-reviews-grey',
    'bg-reviews-orange',
    'bg-reviews-mustard',
    'bg-reviews-hotPink',
    'bg-reviews-charcoal',
    'bg-reviews-mocha',
    'text-reviews-grey',
    'text-reviews-orange',
    'text-reviews-mustard',
    'text-reviews-hotPink',
    'text-reviews-charcoal',
    'text-reviews-mocha',
    'locked',
  ],
  theme: {
    screens: {
      "2xs": "375px",
      xs: "480px",
      sm: "600px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1400px",
      "3xl": "1600px",
      "4xl": "2000px",
    },
    fontFamily: {
      sans: ["Poppins", "sans-serif"],
      serif: ['Libre Caslon Text', "serif"],
      script: ['Mali', 'cursive'],
    },
    extend: {
      colors: {
        primary: {
          light: "#eee",
          DEFAULT: "#ccc",
          dark: "#666",
        },
        secondary: {
          light: "#f83",
          DEFAULT: "#ff6a00",
          dark: "#883900",
        },
        black: {
          DEFAULT: "#333333",
        },
        teal: {
          DEFAULT: "#368F87",
          dark: "#57847D",
        },
        yellow: {
          DEFAULT: "#F8F073",
          dark: "#F5E509",
        },
        blue: {
          light: "#39C6F4",
          DEFAULT: "#288BC9",
        },
        red: {
          DEFAULT: "#EF485C",
        },
        pink: {
          DEFAULT: "#C96BAC",
        },
        orange: {
          DEFAULT: "#E15E42",
        },
        reviews: {
          DEFAULT: "#A1B1CA",
          grey: "#A1B1CA",
          orange: "#F17829",
          mustard: "#7E772F",
          hotPink: "#EF485C",
          charcoal: "#4E4B52",
          mocha: "#BFABAA",
        }
      },
      maxWidth: (theme) => ({
        ...theme("spacing"),
      }),
      screens: {
        'landscape': {'raw': '(orientation: landscape)'},
      },
    },
  },
  plugins: [],
  corePlugins: {
    container: false,
  },
}
