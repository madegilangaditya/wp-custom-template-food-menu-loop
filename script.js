(function ($) {
    
    // Food menu by categories
    let foodTypeList = $('.zoiecafe-food-type-item').first().addClass("active").attr('data-set');
    $('.zoiecafe-food-type-' + foodTypeList).addClass("food-type-active");
    $(document).on('click', '.zoiecafe-food-type-item', function(e){
        e.preventDefault();
        foodTypeList = $(this).attr('data-set');
        $(this).addClass("active");
        // let test = $('.zoiecafe-food-menu-listing-wrapper__item').attr('id');
        // console.log(test);
        $('.zoiecafe-food-type-item').not($(this)).removeClass("active");
        $('.zoiecafe-food-type-' + foodTypeList).addClass("food-type-active");
		$('.zoiecafe-food-menu-listing__item:not(.zoiecafe-food-type-' + foodTypeList + ")").removeClass("food-type-active");
    });

    $('.zoiecafe-food-type-item').hover(function () {
        $(this).find('.img-normal').attr('src', function (i, src) {
            return src.replace('.svg', '-o.svg')
        })
    }, function () {
        $(this).find('.img-normal').attr('src', function (i, src) {
            return src.replace('-o.svg', '.svg')
        })
    });

   

})(jQuery);