class ZoieImageCarouselElementorHandler extends elementorModules.frontend.handlers.Base {
	
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.zoie-image__carousel',
            },
        };
    }

    getDefaultElements() {
        const selectors = ( this.getSettings('selectors') );

        return {
            $wrapper: this.$element.find(selectors.wrapper),
        };
    }

    bindEvents() {
        this.elements.$wrapper.slick({
			variableWidth: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			centerMode: false,
			focusOnSelect: false,
			autoplaySpeed: 2000,
			arrows: true,
            dots: false,
			infinite: true,
			pauseOnHover: false,
			pauseOnFocus: false,
            responsive: [
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
                },
            ]
        });
    }
	
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(ZoieImageCarouselElementorHandler, {
            $element,
        });
    };
    // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
    elementorFrontend.hooks.addAction('frontend/element_ready/zoie_image_carousel.default', addHandler);
})