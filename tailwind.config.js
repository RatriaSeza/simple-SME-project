import withMT from "@material-tailwind/html/utils/withMT";

/** @type {import('tailwindcss').Config} */
export default withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            zIndex: {
                "-1": "-1",
            },
            flexGrow: {
                5: "5",
            },
            fontFamily: {
                poppins: ["Poppins"],
            },
        },
    },
    plugins: [],
});
