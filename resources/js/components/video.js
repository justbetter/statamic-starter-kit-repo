export default (autoplay = false) => ({
    init() {
        let video = this.$el;
        let sources = video.querySelectorAll('source[data-src]');

        if (sources.length) {
            sources.forEach((source) => {
                source.src = source.dataset.src;
                source.removeAttribute('data-src');
            });

            video.load();
        }

        if (!autoplay) {
            return;
        }

        let reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        let update = () => {
            if (reducedMotion.matches) {
                video.pause();
                video.controls = true;

                return;
            }

            video.play().catch(() => {
                video.controls = true;
            });
        };

        update();
        reducedMotion.addEventListener('change', update);
    },
});
