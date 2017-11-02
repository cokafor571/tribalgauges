/* global starterpackScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {
    var masthead, menuToggle, siteNavContain, siteNavigation;

    function initMainNavigation( container ) {

        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $( '<span />', { 'class': 'dropdown-symbol', html: '<i class="fa fa-angle-down" aria-hidden="true"></i>' , 'aria-expanded': false })
            .append( $( '<span />', { 'class': 'screen-reader-text', text: starterpackScreenReaderText.expand }) );

        container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

        // Listen for clicks outside of menu
        $('body').on('click', function (e) {
            if (!$('li.menu-item-has-children').is(e.target) && $('li.menu-item-has-children').has(e.target).length === 0 && $('.toggled-on').has(e.target).length === 0) {
                $('li.menu-item-has-children, .dropdown-symbol + .sub-menu').removeClass('toggled-on');
            }
        });

        if ( $(window).width() < 600 ) {
        
            container.find( '.menu-item-has-children > a, .menu-item-has-children > span' ).click( function( e ) {
                var _this = $(this).parent( '.menu-item-has-children' ),
                    screenReaderSpan = _this.find( '.screen-reader-text' );
                    dropdownSymbol = _this.find( '.dropdown-symbol' );
                    dropdownSymbol.html( dropdownSymbol.html() === '<i class="fa fa-angle-right" aria-hidden="true"></i>' ? '<i class="fa fa-angle-down" aria-hidden="true">' : '<i class="fa fa-angle-right" aria-hidden="true"></i>' );

                e.preventDefault();

                //$('li.menu-item-has-children, .dropdown-symbol + .sub-menu').removeClass('toggled-on');
                
                _this.toggleClass( 'toggled-on' );
                _this.find( '.dropdown-symbol + .sub-menu' ).toggleClass( 'toggled-on' );

                _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

                screenReaderSpan.text( screenReaderSpan.text() === starterpackScreenReaderText.expand ? starterpackScreenReaderText.collapse : starterpackScreenReaderText.expand );
            });
        } else {
            
            container.find( '.menu-item-has-children > a, .menu-item-has-children > span' ).click( function( e ) {
                var _this = $(this).parent( '.menu-item-has-children' ),
                    screenReaderSpan = _this.find( '.screen-reader-text' );
                    dropdownSymbol = _this.find( '.dropdown-symbol' );
                    dropdownSymbol.html( dropdownSymbol.html() === '<i class="fa fa-angle-right" aria-hidden="true"></i>' ? '<i class="fa fa-angle-down" aria-hidden="true">' : '<i class="fa fa-angle-right" aria-hidden="true"></i>' );

                e.preventDefault();

                //$('li.menu-item-has-children, .dropdown-symbol + .sub-menu').removeClass('toggled-on');
                
                _this.toggleClass( 'toggled-on' );
                _this.find( '.dropdown-symbol + .sub-menu' ).toggleClass( 'toggled-on' );

                _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

                screenReaderSpan.text( screenReaderSpan.text() === starterpackScreenReaderText.expand ? starterpackScreenReaderText.collapse : starterpackScreenReaderText.expand );
            });
        }
    }

    initMainNavigation( $( '.main-navigation' ) );

    masthead       = $( '.main-navigation' );
    menuToggle     = masthead.find( '.menu-toggle' );
    siteNavContain = masthead;
    siteNavigation = masthead.find( '.menu-header-menu-container > ul' );

    // Enable menuToggle.
    (function() {

        // Return early if menuToggle is missing.
        if ( ! menuToggle.length ) {
            return;
        }

        // Add an initial value for the attribute.
        menuToggle.attr( 'aria-expanded', 'false' );

        menuToggle.on( 'click.starterpack', function() {
            siteNavContain.toggleClass( 'toggled-on' );

            $( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
        });
    })();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    (function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

                $( document.body ).on( 'touchstart.starterpack', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                });

                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
                    .on( 'touchstart.starterpack', function( e ) {
                        var el = $( this ).parent( 'li' );

                        if ( ! el.hasClass( 'focus' ) ) {
                            e.preventDefault();
                            el.toggleClass( 'focus' );
                            el.siblings( '.focus' ).removeClass( 'focus' );
                        }
                    });

            } else {
                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.starterpack' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize.starterpack', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus.starterpack blur.starterpack', function() {
            $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
        });
    })();
})( jQuery );
