(function () {
    const gate = document.querySelector("[data-gate]");
    const openBtn = document.querySelector("[data-open]");
    const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function unlock() {
        document.body.classList.remove("is-locked");
        if (gate) gate.classList.add("is-gone");
    }

    if (openBtn) {
        openBtn.addEventListener("click", unlock);
    }

    if (reduced) {
        unlock();
    } else {
        document.body.classList.add("is-locked");
    }

    const nodes = document.querySelectorAll("[data-reveal]");
    if (!nodes.length || reduced || !("IntersectionObserver" in window)) {
        nodes.forEach(function (el) {
            el.classList.add("is-in");
        });
        return;
    }

    const io = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-in");
                    io.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.18, rootMargin: "0px 0px -8% 0px" }
    );

    nodes.forEach(function (el) {
        io.observe(el);
    });
})();
