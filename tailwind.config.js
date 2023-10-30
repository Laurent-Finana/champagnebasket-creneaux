/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        navbarBg: "#B09746",
        colorProB: "#ffff00",
        colorLigue2: "#fc87f9",
        colorEspoirs: "#00b0f0",
        colorU18: "#92d050",
        colorCdfFeminines: "#EE9209",
        greenTheme: "#06bb64",
        buttonYellow: "#e9b308",
      },
    },
  },
  plugins: [require("@tailwindcss/forms"), require("flowbite/plugin")],
};
