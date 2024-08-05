/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    fontFamily: {
      icomoon: "icomoon",
      Montserrat: "'Montserrat', sans-serif",
      OpenSans: "'Open Sans', sans-serif",
    },

    extend: {
      screens: {
        sm: "640px",
        md: "769px",
        lg: "1025px",
        xl: "1281px",
        "2xl": "1537px",
        "3xl": "1681px",
      },

      colors: {
        primary: "#C29C6A",
        // primary_accent: "#DAEAF7",
        secondary: "#C1C1C1",
        secondary_accent: "#313131",
        tertiary: "#0E0E0E",
        tertiary_accent: "#626262",
        quaternary: "#747474",
        quaternary_accent: "#1E1E1E",
        quinary: "#484848",
        // senary: "#2476BB",
        black: "#000000",
        white: "#FFFFFF",
      },
    },
  },

  plugins: [require("daisyui")],

  daisyui: {
    themes: false,
    darkTheme: "light",
    base: true,
    styled: true,
    utils: true,
    rtl: false,
    prefix: "",
    logs: true,
    themeRoot: ":root",
    themes: ["light", "cupcake"],
  },
};

