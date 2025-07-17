// bs.js
const browserSync = require("browser-sync").create();

browserSync.init({
	proxy: "http://localhost:81/wp/thegioibang/",
	files: ["**/*.php", "**/*.css", "**/*.scss", "**/*.js"],
	reloadDelay: 200,
	open: true,
});
