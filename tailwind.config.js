/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'templates/**/*.html.twig',
    'assets/js/**/*.js',
    'assets/js/**/*.jsx'
  ],
  theme: {
    extend: {
      colors: {
        purple: {
          100: '#FEFCFF',
          200: '#F8F0FF',
          300: '#8308FF',
          400: '#270B44',
        },
        lavande: {
          100: '#B8A7C9',
          200: '#8556B2',
        },
        blue: {
          100: '#E6F6FF',
          200: '#0747EB',
        },
        green: {
          100: '#E0FFE1',
          200: '#8556B2',
        },
        orange: {
          100: '#FFEFE0',
          200: '#B85712',
        }
      }
    },
    fontSize: {
      xxs: '8px'
    },
    width:{
      '17': '72px'
    },
    height:{
      '17': '72px'
    }
  },
  plugins: [],
}

