import 'jquery-parallax.js';

export const parallaxWindow = () => {
    
    const exitHandler = () => {
        if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null) {
            setTimeout(() => {
                jQuery(window).trigger('resize').trigger('scroll');
                $('.parallax-window').parallax({
                    naturalWidth: 600,
                    naturalHeight: 400
                });
            }, 100);
        }
    };

    if (document.addEventListener) {
        $(document)
            .off("webkitfullscreenchange")
            .on("webkitfullscreenchange", exitHandler);

        $(document)
            .off("mozfullscreenchange")
            .on("mozfullscreenchange", exitHandler);

        $(document)
            .off("fullscreenchange")
            .on("fullscreenchange", exitHandler);

        $(document)
            .off("MSFullscreenChange")
            .on("MSFullscreenChange", exitHandler);
    }

    jQuery(window).trigger('resize').trigger('scroll');
    $('.parallax-window').parallax({
        naturalWidth: 600,
        naturalHeight: 400
    });
}