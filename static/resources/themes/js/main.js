String.prototype.escape = String.prototype.escape || function() {
    var tagsToReplace = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;'
    };
    return this.replace(/[&<>]/g, function(tag) {
        return tagsToReplace[tag] || tag;
    });
};
String.prototype.ellipsis = String.prototype.ellipsis || function(cutoff){
    return this.length < cutoff ?
        this :
        this.substr(0, cutoff-1) +'&#8230;';
};
Number.prototype.format = Number.prototype.format || function ( thousands, decimal, precision, prefix, postfix ) {
    var negative = this < 0;
    var negative_koxx = function(x, yes){
        if (yes){
            return '('+x+')';
        }else{
            return x;
        }
    };
    var flo = parseFloat( this );

    // If NaN then there isn't much formatting that we can do - just
    // return immediately, escaping any HTML (this was supposed to
    // be a number after all)
    if ( isNaN( flo ) ) {
            return this.escape();
    }

    flo = flo.toFixed( precision );
    var d = Math.abs( flo );

    var intPart = parseInt( d, 10 );
    var floatPart = precision ?
            decimal+(d - intPart).toFixed( precision ).substring( 2 ):
            '';
    
    return negative_koxx((prefix||'') +
            intPart.toString().replace(
                    /\B(?=(\d{3})+(?!\d))/g, thousands
            ) +
            floatPart, negative) +
            (postfix||'');
};
String.prototype.padLeft = String.prototype.padLeft || function(length, char){
    if (char === undefined){
        char = '0';
    }
    var arr = this.split("");
    var gap = length - arr.length;
    if (gap<=0){
        return this;
    }
    var str = '';
    for (var i=0; i<gap; i++){
        str+= char;
    }
    return str+this;
};
String.prototype.padRight = String.prototype.padRight || function(length, char){
    if (char === undefined){
        char = '0';
    }
    var arr = this.split("");
    var gap = length - arr.length;
    if (gap<=0){
        return this;
    }
    var str = '';
    for (var i=0; i<gap; i++){
        str+= char;
    }
    return this+str;
};

$(document).ready(function (){
    
    /************************
    /*	LAYOUT
    /************************/

    /* set minimum height for content wrapper */
    $('.content-wrapper').css('min-height', $('.wrapper').outerHeight(true) - $('.top-bar').outerHeight(true));


    /************************
    /*	MAIN NAVIGATION
    /************************/

    $('.main-menu .js-sub-menu-toggle').click( function(e){

        e.preventDefault();

        $li = $(this).parent('li');
        if( !$li.hasClass('active')){
            $li.find(' > a .toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');
            $li.addClass('active');
        }
        else {
            $li.find(' > a .toggle-icon').removeClass('fa-angle-down').addClass('fa-angle-left');
            $li.removeClass('active');
        } 

        $li.find(' > .sub-menu').slideToggle(300);
    });

    $('.js-toggle-minified').clickToggle(
        function() {
            $('.left-sidebar').addClass('minified');
            $('.content-wrapper').addClass('expanded');

            $('.left-sidebar .sub-menu')
            .css('display', 'none')
            .css('overflow', 'hidden');

            $('.main-menu > li > a > .text').animate({opacity: 0}, 200);

            $('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
        },
        function() {
            $('.left-sidebar').removeClass('minified');
            $('.content-wrapper').removeClass('expanded');
            $('.main-menu > li > a > .text').animate({opacity: 1}, 600);

            $('.sidebar-minified').find('i.fa-angle-left').toggleClass('fa-angle-right');
        }
    );

    // main responsive nav toggle
    $('.main-nav-toggle').clickToggle(
        function() {
            $('.left-sidebar').slideDown(300)
        },
        function() {
            $('.left-sidebar').slideUp(300);
        }
    );
    
    /************************
    /*	WINDOW RESIZE
    /************************/

    $(window).bind("resize", resizeResponse);

    function resizeResponse() {

        if( $(window).width() < (992-15)) {
            if( $('.left-sidebar').hasClass('minified') ) {
                $('.left-sidebar').removeClass('minified');
                $('.left-sidebar').addClass('init-minified');
            }

        }else {
            if( $('.left-sidebar').hasClass('init-minified') ) {
                $('.left-sidebar')
                .removeClass('init-minified')
                .addClass('minified');
            }
        }
    }
    
    $('form.form-validation').on('keydown', 'input, select, textarea', function(e) {
        var self = $(this)
          , form = self.parents('form:eq(0)')
          , focusable
          , next
          ;
        if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            }
            /*
            else {
                form.submit();
            }*/
            return false;
        }
    });
    
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    }).on('changeDate', function (e){
        $(this).datepicker('hide');
    });

    //widget
    $('.widget .btn-remove').click(function (e) {
        e.preventDefault();
        $(this).parents('.widget').fadeOut(300, function () {
            $(this).remove();
        });
    });
    // widget toggle expand
    var affectedElement = $('.widget-content');

    $('.widget .btn-toggle-expand').clickToggle(
        function (e) {
            e.preventDefault();

            // if has scroll
            if ($(this).parents('.widget').find('.slimScrollDiv').length > 0) {
                affectedElement = $('.slimScrollDiv');
            }

            $(this).parents('.widget').find(affectedElement).slideUp(300);
            $(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');
        },
        function (e) {
            e.preventDefault();

            // if has scroll
            if ($(this).parents('.widget').find('.slimScrollDiv').length > 0) {
                affectedElement = $('.slimScrollDiv');
            }

            $(this).parents('.widget').find(affectedElement).slideDown(300);
            $(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');
        }
    );

    // widget focus
    $('.widget .btn-focus').clickToggle(
        function (e) {
            e.preventDefault();
            $(this).find('i.fa-eye').toggleClass('fa-eye-slash');
            $(this).parents('.widget').find('.btn-remove').addClass('link-disabled');
            $(this).parents('.widget').addClass('widget-focus-enabled');
            $('body').addClass('focus-mode');
            $('<div id="focus-overlay"></div>').hide().appendTo('body').fadeIn(300);

        },
        function (e) {
            e.preventDefault();
            $theWidget = $(this).parents('.widget');

            $(this).find('i.fa-eye').toggleClass('fa-eye-slash');
            $theWidget.find('.btn-remove').removeClass('link-disabled');
            $('body').removeClass('focus-mode');
            $('body').find('#focus-overlay').fadeOut(function () {
                $(this).remove();
                $theWidget.removeClass('widget-focus-enabled');
            });
        }
    );

});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
    return this.each( function() {
        var clicked = false;
        $(this).bind('click', function() {
            if(clicked) {
                clicked = false;
                return f2.apply(this, arguments);
            }

            clicked = true;
            return f1.apply(this, arguments);
        });
    });

}