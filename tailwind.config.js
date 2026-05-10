module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'luxury-black': '#111111',
        'luxury-white': '#fdfdfd',
        'luxury-beige': '#f5f5f0',
        'luxury-wood': '#8b5a2b',
      },
      fontFamily: {
        sans: ['Cairo', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
