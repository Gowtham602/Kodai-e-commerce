// Mobile Touch Pause + Resume
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.marquee-track');

    let isTouched = false;

    // Pause on touch
    track.addEventListener('touchstart', () => {
        track.style.animationPlayState = 'paused';
        isTouched = true;
    });

    // Resume after touch ends
    track.addEventListener('touchend', () => {
        setTimeout(() => {
            track.style.animationPlayState = 'running';
            isTouched = false;
        }, 1500);
    });
});

