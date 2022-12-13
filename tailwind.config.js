/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'success': {
          '50': '#f7fcf9',
          '100': '#f0f8f3',
          '200': '#d9eee0',
          '300': '#c3e3ce',
          '400': '#95cea9',
          '500': '#68B984',
          '600': '#5ea777',
          '700': '#4e8b63',
          '800': '#3e6f4f',
          '900': '#335b41'
        },'accent': {
          '50': '#fdfffe',
          '100': '#fafffc',
          '200': '#f3fff8',
          '300': '#ecfef3',
          '400': '#ddfeea',
          '500': '#CFFDE1',
          '600': '#bae4cb',
          '700': '#9bbea9',
          '800': '#7c9887',
          '900': '#657c6e'
        },'secondary': {
          '50': '#f5f7f7',
          '100': '#eceeee',
          '200': '#cfd5d5',
          '300': '#b1bbbb',
          '400': '#778989',
          '500': '#3D5656',
          '600': '#374d4d',
          '700': '#2e4141',
          '800': '#253434',
          '900': '#1e2a2a'
        },'primary': {
          '50': '#fffdf6',
          '100': '#fffaed',
          '200': '#fff3d2',
          '300': '#ffecb6',
          '400': '#fede80',
          '500': '#FED049',
          '600': '#e5bb42',
          '700': '#bf9c37',
          '800': '#987d2c',
          '900': '#7c6624'
        }
      }
    },
  },
  plugins: [],
}
