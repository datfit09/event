'use strict';

// An/hien menu tren mobile.
function toggleMenu() {
    var btn = jQuery( '.toggle-menu-btn' ),
        overlay = jQuery( '.menu-overlay' );

    if ( ! btn.length || ! overlay.length ) {
        return;
    }

    btn.on( 'click', function() {
        jQuery( this ).addClass( 'actice' );
        jQuery( document.body ).addClass( 'mobile-open' );
    } );

    overlay.on( 'click', function() {
        btn.removeClass( 'actice' );
        jQuery( document.body ).removeClass( 'mobile-open' );
    } );
}

(function() {
    jQuery( document ).ready( function() {
        jQuery( window ).on( 'load', function() {
        } );
        toggleMenu();
    } );

    // Menu tren mobile.
    jQuery(document.body).on('click', '.sidebar-menu ul a', function(e) {
        e.preventDefault();
        var t = jQuery(this);
        // Go to url if not have sub-menu.
        if (!t.siblings().length) {
            window.location.href = t.prop('href');
        }
        if (t.next().hasClass('show')) {
            t.next().removeClass('show');
            t.next().slideUp(200);
        } else {
            t.parent().parent().find('li .sub-menu').removeClass('show');
            t.parent().parent().find('li .sub-menu').slideUp(200);
            t.next().toggleClass('show');
            t.next().slideToggle(200);
        }
    });
})();

/*Modal search*/

(function modal() {
    var modal    = document.querySelector( '.modal' ),
        btn      = document.querySelector( '.demo-btn' ),
        closeBtn = document.querySelectorAll( '.modal-close' ),
        saveBtn  = document.querySelector( '.modal-save' );
 
    btn.addEventListener( 'click', function( e ) {
        e.preventDefault();

        document.body.classList.add( 'modal-open' );
    } );

    closeBtn.forEach( function( ele ) {
        ele.addEventListener( 'click', function() {
            document.body.classList.remove( 'modal-open' );

            if ( ele.classList.contains( 'modal-save' ) ) {
                var url = btn.href;
                window.location = url;
            }
        } );
    });
})();