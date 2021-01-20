/*  woocommerce AJAX cart
--------------------------*/
    
    (function() {

        tinymce.PluginManager.add('et_cart', function( editor) {
            editor.addButton( 'et_cart', {
                title : 'Add woocommerce AJAX cart',
                icon: 'icon icon-cart',
                onclick: function() {
                	editor.selection.setContent('[et_cart/]');  
				}
            });
        });

    })();

/*  gap
--------------------------*/

    (function() {

        tinymce.PluginManager.add('et_gap', function( editor) {
            editor.addButton( 'et_gap', {
                title : 'Add gap',
                icon: 'icon icon-gap',
                onclick: function() {
                    editor.selection.setContent('[et_gap height="32" /]');
                }
            });
        });

    })();

    (function() {

        tinymce.PluginManager.add('et_gap_inline', function( editor) {
            editor.addButton( 'et_gap_inline', {
                title : 'Add inline gap',
                icon: 'icon icon-gap-inline',
                onclick: function() {
                    editor.selection.setContent('[et_gap_inline width="32" /]');
                }
            });
        });

    })();

/*  column
--------------------------*/

    (function() {

        tinymce.PluginManager.add('et_column', function( editor) {
            editor.addButton( 'et_column', {
                title : 'Add column',
                icon: 'icon icon-column',
                onclick: function() {
                    editor.selection.setContent('[et_column width="100% 50% 33% 25%" padding="0px 0px 0px 0px"]' + editor.selection.getContent() + '[/et_column]');
                }
            });
        });

    })();

    (function() {

        tinymce.PluginManager.add('et_row', function( editor) {
            editor.addButton( 'et_row', {
                title : 'Add row',
                icon: 'icon icon-row',
                onclick: function() {
                    editor.selection.setContent('[et_row margin="0px 0px 0px 0px"]' + editor.selection.getContent() + '[/et_row]');
                }
            });
        });

    })();


/*  separator
--------------------------*/

    (function() {

        tinymce.PluginManager.add('et_separator', function( editor) {
            editor.addButton( 'et_separator', {
                title : 'Add separator',
                icon: 'icon icon-separator',
                onclick: function() {
                    editor.selection.setContent('[et_separator top="24" bottom="24" type="solid" color="" align="left" width="" height="" /]');
                }
            });
        });

    })();

/*  separator dottes
--------------------------*/

    (function() {

        tinymce.PluginManager.add('et_separator_dottes', function( editor) {
            editor.addButton( 'et_separator_dottes', {
                title : 'Add dottes separator',
                icon: 'icon icon-separator-dottes',
                onclick: function() {
                    editor.selection.setContent('[et_separator_dottes top="24" bottom="24" color="" align="left" /]');
                }
            });
        });

    })();

/*  highlight
--------------------------*/

    (function() {
        tinymce.PluginManager.add('et_highlight', function( editor) {
            editor.addButton( 'et_highlight', {
                title : 'Add highlight',
                icon: 'icon icon-highlight',
                onclick: function() {
                    editor.selection.setContent('[et_highlight color="" back_color="" border_color=""]' + editor.selection.getContent() + '[/et_highlight]');  
                }
            });
        });
    })();

/*  popup_inline
--------------------------*/

    (function() {
        tinymce.PluginManager.add('et_popup_inline', function( editor) {
            editor.addButton( 'et_popup_inline', {
                title : 'Add inline popup',
                icon: 'icon icon-popup',
                onclick: function() {
                    editor.selection.setContent('[et_popup_inline text_color="#fd8c40" popup_color="#212121" direction="left right top bottom" message_width="320" message="Your popup message goes here"]' + editor.selection.getContent() + '[/et_popup_inline]');  
                }
            });
        });
    })();

/*  dropcap
--------------------------*/

    (function() {
        tinymce.PluginManager.add('et_dropcap', function( editor) {
            editor.addButton( 'et_dropcap', {
                title : 'Add dropcap',
                icon: 'icon icon-dropcap',
                onclick: function() {
                    editor.selection.setContent('[et_dropcap type="empty full" color=""]' + editor.selection.getContent() + '[/et_dropcap]');  
                }
            });
        });
    })();


/*  icon
--------------------------*/

    (function() {

        tinymce.PluginManager.add('et_icon', function( editor) {
            editor.addButton( 'et_icon', {
                title : 'Add icon',
                icon: 'icon icon-icon',
                onclick: function() {
                    editor.selection.setContent('[et_icon icon_size="extra-small" icon_prefix="" icon_name="" icon_color="" icon_back_color="" icon_border_radius="" icon_border_width="" animate="false" /]');
                }
            });
        });

    })();