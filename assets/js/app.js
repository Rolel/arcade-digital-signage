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
    autoSlideStoppable: false,
    width: 1920,
    height: 1080,
    // default/cube/page/concave/zoom/linear/fade/none
    transition: 'concave',
});
