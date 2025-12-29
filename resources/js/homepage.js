// Mobile Touch Pause + Resume
// document.addEventListener('DOMContentLoaded', function () {
//     const track = document.querySelector('.marquee-track');

//     let isTouched = false;

//     // Pause on touch
//     track.addEventListener('touchstart', () => {
//         track.style.animationPlayState = 'paused';
//         isTouched = true;
//     });

//     // Resume after touch ends
//     track.addEventListener('touchend', () => {
//         setTimeout(() => {
//             track.style.animationPlayState = 'running';
//             isTouched = false;
//         }, 1500);
//     });
// });

document.addEventListener('DOMContentLoaded', () => {
    const scroll = document.querySelector('.marquee-scroll');
    const track = document.querySelector('.marquee-track');

    let isDown = false;
    let startX;
    let scrollLeft;
    let autoResumeTimer;

    // Desktop auto-scroll pause on hover
    scroll.addEventListener('mouseenter', () => {
        track.style.animationPlayState = 'paused';
    });

    scroll.addEventListener('mouseleave', () => {
        track.style.animationPlayState = 'running';
    });

    // Mouse drag (desktop)
    scroll.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - scroll.offsetLeft;
        scrollLeft = scroll.scrollLeft;
        track.style.animationPlayState = 'paused';
    });

    scroll.addEventListener('mouseleave', () => isDown = false);
    scroll.addEventListener('mouseup', () => {
        isDown = false;
        resumeAuto();
    });

    scroll.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scroll.offsetLeft;
        const walk = (x - startX) * 1.5;
        scroll.scrollLeft = scrollLeft - walk;
    });

    // Touch support (mobile)
    scroll.addEventListener('touchstart', () => {
        track.style.animationPlayState = 'running';
        clearTimeout(autoResumeTimer);
    });

    scroll.addEventListener('touchend', () => {
        resumeAuto();
    });

    function resumeAuto() {
        autoResumeTimer = setTimeout(() => {
            if (window.innerWidth > 768) {
                track.style.animationPlayState = 'running';
            }
        }, 1500);
    }
});
