/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
  theme: {
    extend: {
        colors: {
            'primary': '#007BFF',
            'secondary': '#FF4500',
            'accent': '#32CD32',
            'neutral': '#F5F5F5',
            'typography': '#333333'
        },
        fontFamily: {
            'poppins': ["Poppins", "sans-serif"],
        },
        fontSize: {
            'x': '0.75rem'
        }
    },
  },
  plugins: [],
}

