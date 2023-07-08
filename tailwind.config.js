/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "App/Views/**/*.php"
  ],
  theme: {
    extend: {
      screens: {
        mm: '576px'
      }
    },
  },
  plugins: [],
}

