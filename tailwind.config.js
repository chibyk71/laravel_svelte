/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.svelte",
  ],
  darkMode:"class",
  theme: {
    extend: {
      colors: {
        primary: "var(--primary)",
        light: "rgba(var(--white),<alpha-value>)",
        dark: "rgba(var(--black),<alpha-value>)",
        secondary: "rgba(112, 79, 254,<alpha-value>)",
        lightbg: "rgba(var(--light-bg),<alpha-value>)",
        success: "#198754",
      }
    },
  },
  plugins: [],
}

