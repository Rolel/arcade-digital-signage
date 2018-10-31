/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('reveal/index.css');
require('reveal/theme/default.css');

let Reveal = require('reveal');

// Full list of configuration options available here:
// https://github.com/hakimel/reveal.js#configuration
Reveal.initialize({
    controls: false,
    progress: false,
    history: true,
    center: true,
    loop: true,
    width: 1920,
    height: 1080,
    // default/cube/page/concave/zoom/linear/fade/none
    transition: 'concave',
});
