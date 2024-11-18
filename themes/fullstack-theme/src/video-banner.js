window.addEventListener('DOMContentLoaded', (event) => {
    const videoElement = document.querySelector('body.home .wp-block-cover__video-background');
    if (videoElement) {
        videoElement.removeAttribute('loop')
    }
});