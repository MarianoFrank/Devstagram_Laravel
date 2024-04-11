/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primario-50": "#eff6ff",
                "primario-100": "#dbeafe",
                "primario-200": "#bfdbfe",
                "primario-300": "#93c5fd",
                "primario-400": "#60a5fa",
                "primario-500": "#3b82f6",
                "primario-600": "#2563eb",
                "primario-700": "#1d4ed8",
                "primario-800": "#1e40af",
                "primario-900": "#1e3a8a",
                "primario-950": "#172554",
            },
        },
    },
};
