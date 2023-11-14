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
          500: '#8308FF',
          700: '#270B44',
        },
        lavande: {
          400: '#B8A7C9',
          500: '#8556B2',
        },
        blue: {
          100: '#E6F6FF',
          500: '#0747EB',
        },
        green: {
          100: '#E0FFE1',
          500: '#8556B2',
        },
        orange: {
          100: '#FFEFE0',
          500: '#B85712',
        }
      },
      fontSize: {
        xxs: '8px',
        '3xl': '32px'
      },
      width: {
        '17': '72px'
      },
      height: {
        '17': '72px'
      }
    }
  },
  plugins: [],
}

