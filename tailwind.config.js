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
          100: '#CD9AFF',
          200: '#8308FF'
        }
      }
    },
    fontSize: {
      xxs: '8px'
    },
    width:{
      '17': '72px'
    }
  },
  plugins: [],
}

