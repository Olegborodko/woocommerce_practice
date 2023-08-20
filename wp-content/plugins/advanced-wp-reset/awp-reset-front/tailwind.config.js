/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./**/*.{html,js,php}"],
	theme: {
		extend: {
			fontFamily: {
				"awpr-base": ["Poppins", "system-ui"],
			},

			colors: {
				awpr: {
					brand: "#822abb",
					"danger-dark": "#DC3154",
					danger: "#F04675",
					"danger-light": "#FFE9F1",
					success: "#37AE53",
					"success-light": "#F8FFFC",
					border: "#DCE5EA",
					gray: "#7A6A84",
					"dark-gray": "#473651",
					"light-gray": "#EEF3F6",
				},
			},

			animation: {
				"spin-reverse": "spin-reverse 1s linear infinite",
			},

			keyframes: {
				"spin-reverse": {
					"0%": { transform: "rotate(0deg)" },
					"100%": { transform: "rotate(-360deg)" },
				},
			},
		},
	},
	plugins: [],
};
