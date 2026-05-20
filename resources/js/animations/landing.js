export default function (gsap) {
    const tl = gsap.timeline();

    // Coordinated split reveal: use vertical entrance (from bottom) to avoid lateral motion
    tl.from('.hero-split .left', {
        y: 28,
        opacity: 0,
        duration: 1.0,
        ease: 'power3.out',
    });

    tl.from('.hero-split .right .hero-media', {
        y: 28,
        opacity: 0,
        duration: 1.0,
        ease: 'power3.out',
    }, '-=0.85');

    // Slight stagger for internal elements (vertical only)
    tl.from('.hero-split .left .text-body-large, .hero-split .left .btn-primary, .hero-split .left .btn-pill-outline', {
        y: 12,
        opacity: 0,
        duration: 0.75,
        stagger: 0.10,
        ease: 'power3.out',
    }, '-=0.7');

    // Parallax-like float for hero media
    const media = document.querySelectorAll('.hero-media');
    media.forEach((el, i) => {
        gsap.to(el, {
            y: i % 2 === 0 ? -8 : -5,
            duration: 8 + i * 2,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
        });
    });
}
