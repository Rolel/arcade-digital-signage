// require('../css/app.css');
require('reveal.js/css/reveal.scss');
require('../reveal-theme/arcade.scss');

import Reveal from 'reveal.js';
import YouTubePlayer from 'youtube-player';


Reveal.initialize({
    controls: false,
    progress: false,
    history: true,
    center: true,
    loop: true,
    autoSlideStoppable: false,
    width: 1920,
    height: 1080,
    transition: 'convex',
});

Reveal.addEventListener( 'ready', function( event ) {
    videoSlide(event.currentSlide);
} );
Reveal.addEventListener( 'slidechanged', function( event ) {
    // event.previousSlide, event.currentSlide, event.indexh, event.indexv
    videoSlide(event.currentSlide);
} );


function videoSlide(slide) {
    if (slide.attributes["data-video"] == undefined) return;
    if ( slide.youtubePlayer == undefined) {
        // let dataSlideId = slide.attributes["data-slideid"].value
        let videoId = youtubeID(slide.attributes["data-video"].value)
        let player;
        player = YouTubePlayer(slide.getElementsByClassName('video-player')[0])
        player.loadVideoById(videoId)
        player.getIframe()
            .then((iframe) => {
                // We toggle overview so the stretch is taken into account
                Reveal.toggleOverview()
                iframe.classList.add('stretch')
                Reveal.toggleOverview()
            });
        player.mute()
        player.playVideo()
        slide.youtubePlayer = player
    } else {
        // Will pause when slide change, we restart it
        slide.youtubePlayer.playVideo()
    }

    /*
    // Try to fullscreen, won't work because of browser security
    player.getIframe()
        .then((iframe) => {
            let requestFullScreen = iframe.requestFullScreen || iframe.mozRequestFullScreen || iframe.webkitRequestFullScreen;
            if (requestFullScreen) {
                requestFullScreen.bind(iframe)();
            }
        });
    */
}

function youtubeID(url){
    var id = url;
    url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    if(url[2] !== undefined) {
        id = url[2].split(/[^0-9a-z_\-]/i)[0];
    }
    return id;
}