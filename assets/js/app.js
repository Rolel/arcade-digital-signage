require('reveal.js/css/reveal.scss');
require('../reveal-theme/arcade.scss');
require('../css/app.scss');

require('../img/arcade.png');

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
    height: '100%',
    transition: 'convex',
});

Reveal.addEventListener( 'ready', function( event ) {
    videoSlide(event.currentSlide);
} );
Reveal.addEventListener( 'slidechanged', function( event ) {
    // event.previousSlide, event.currentSlide, event.indexh, event.indexv
    videoSlide(event.currentSlide);
    scrollSlide(event.currentSlide);
} );


clock('clock');

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
    let id = url;
    url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    if(url[2] !== undefined) {
        id = url[2].split(/[^0-9a-z_\-]/i)[0];
    }
    return id;
}


function clock(classname){
    let date = new Date();
    let h = date.getHours(); // 0 - 23
    let m = date.getMinutes(); // 0 - 59
    let s = date.getSeconds(); // 0 - 59

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    // s = (s < 10) ? "0" + s : s;

    let time = h + ":" + m;

    let element = document.getElementsByClassName(classname)
    Array.from(element).forEach(function(elt) {
        elt.innerText = time
        elt.textContent = time
    })

    setTimeout(clock, 1000, classname);
}


function scrollSlide(section) {

    let scrollable = section.querySelector('.scrollable')
    if (scrollable != null) {
        let slides = section.parentNode

        let scrollableHeight = scrollable.clientHeight
        let sectionHeight = section.clientHeight
        let slidesHeight = slides.clientHeight
        let fixedHeight = sectionHeight - scrollableHeight
        let scrollViewportHeight = slidesHeight - fixedHeight

        if (scrollViewportHeight < scrollableHeight) {

            let scrollLength = scrollableHeight - scrollViewportHeight
            /*
            let div = document.createElement('span')
            let spacer = scrollable.insertBefore(div, scrollable.childNodes[0])

            // The spacer height is equal to out of box part
            spacer.classList.add('spacer')
            spacer.style.height = scrollLength + 'px'
*/
            console.log(sectionHeight)
            console.log(slidesHeight);
            console.log(scrollableHeight);
            console.log(scrollViewportHeight);
            console.log(scrollLength);
            console.log('#####');
            scrollable.childNodes[0].animate([
                // keyframes
                { transform: 'translateY(0px)' },
                { transform: 'translateY(-' + scrollLength + 'px)' }
            ], {
                // timing options
                duration: 10000,
                iterations: 2,
                easing: 'ease-in',
                direction: 'alternate'
            });
        }
    }
}