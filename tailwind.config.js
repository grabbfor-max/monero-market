module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['MarketMono', 'Helvetica', 'Arial', 'sans-serif'],
            },
            keyframes: {
                'swing': {
                    '0%,100%': {transform: 'rotate(15deg)'},
                    '50%': {transform: 'rotate(-15deg)'},
                }
            },
            animation: {
                'swing': 'swing 1s infinite'
            }
        },
    },
    plugins: [
        require("daisyui"),
    ],
    daisyui: {
        themes: ["fantasy", "night"],
    },
    darkMode: 'class',
}

