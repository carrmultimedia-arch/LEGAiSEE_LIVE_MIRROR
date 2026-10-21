// ======================================================
// LEGAiSEE — INTERACTION ENGINE
// Scroll reveal + depth + cinematic behavior layer
// ======================================================

const reveals = document.querySelectorAll(".reveal-frame, .museum-card");

const observer = new IntersectionObserver(
    (entries) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
            }

        });

    },
    {
        threshold: 0.18
    }
);

reveals.forEach(el => observer.observe(el));


// ======================================================
// SOFT PARALLAX FOR HERO BACKGROUNDS
// ======================================================

window.addEventListener("scroll", () => {

    const heroes = document.querySelectorAll(".hero-bg");

    heroes.forEach(bg => {

        let offset = window.scrollY * 0.18;

        bg.style.transform = `scale(1.06) translateY(${offset}px)`;

    });

});