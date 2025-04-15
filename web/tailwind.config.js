/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./src/**/*.{js,ts,jsx,tsx}",
      "./pages/**/*.{js,ts,jsx,tsx}",
      "./app/**/*.{js,ts,jsx,tsx}",
      "./components/**/*.{js,ts,jsx,tsx}"
    ],
    theme: {
      extend: {
        animation: {
          'spin-slow': 'spin 6s linear infinite',
        },
      },
    },
    safelist: [
      {
        pattern: /(from|to)-(orange|green|blue|yellow|pink|cyan|purple|gray|red|indigo)-(300|400|500|600|700)/,
      }
    ],
    plugins: [],
  }
  