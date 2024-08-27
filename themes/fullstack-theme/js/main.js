window.addEventListener('DOMContentLoaded', (event) => {
    const videoElement = document.querySelector('.wp-block-cover__video-background');
    if (videoElement) {
        videoElement.loop = false;
    }
});