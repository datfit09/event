/**
 * File navigation.js.
 *
 */

(function( $ ) {
    var pull        = $('#pull'),
        menu        = $('nav ul'),
        menuHeight  = menu.height();
 
    pull.on('click', function( e ) {
        e.preventDefault();
        menu.slideToggle();
    });

    $(window).resize(function(){
        var w = $(window).width();
        if(w > 991 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });
})( jQuery );

jQuery( document.body ).on( 'click', '.primary-menu .menu-item a', function( e ) {

    e.preventDefault();

    var t         = jQuery( this ),
        next      = t.next(),
        nextAlias = t.parent().parent().find( 'li .sub-menu' );

    // Go to url if not have sub-menu.
    if ( ! t.siblings().length ) {
        // hash.
        window.location.href = t.prop( 'href' );
    }

    if ( next.hasClass( 'show' ) ) {
        next.removeClass( 'show' );
        next.slideUp( 200 );
    } else {
        nextAlias.removeClass( 'show' );
        nextAlias.slideUp( 200 );
        next.toggleClass( 'show' );
        next.slideToggle( 200 );
    }
});