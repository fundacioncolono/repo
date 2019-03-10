(function ( $ ) {
    $.fn.animatedModal = function(options) {

        var e = this,

        overlay = $('#' + e[0].id + '-overlay'),

        settings = $.extend(true,{
            overlay:{show:false,opacity:'.8',closeOnClick:false},
            animatedIn:'slideInUp',
            animatedOut:'slideOutDown',
            toCenter: null,
            style:{
                'position':'fixed',
                'width':'100%',
                'background-color':'white',
                'overflow-y':'auto',
                'z-index': '1000',
                'left': e.parent().css('left'),
                '-webkit-animation-duration':'.4s',
                '-moz-animation-duration':'.4s',
                '-ms-animation-duration':'.4s',
                'animation-duration':'.4s'
            },
            onBeforeShow: function(){},
            onAfterShow: function(){},
            onBeforeClose: function(){},
            onAfterClose: function(){},
		}, options),
		
		open = false,

		init = function(){

           for (var variable in overlay)
                if (overlay.hasOwnProperty(variable)) {
                    overlay.css({
                        'display': 'none',
                        'position': 'fixed',
                        'background-color': 'rgba(0,0,0,.4)',
                        'height': '100%',
                        'width': '100%',
                        'z-index': '999'
                    });
                    break;
                }

			e.show = show;
			e.close = close;
			e.applyStyle = applyStyle;
			e.applySettings = applySettings;
			e.getSettings = function () { return settings; };
			e.isOpen = function () { return open; };
			e.keypress(function(evt){ if (evt.keyCode === 27 && document.activeElement === e[0]) close(); });

            applySettings();
            applyStyle();

            e.find('.close-animatedModal').click(function(){close();});
        },

        show = function(){
			
			settings.onBeforeShow();
			
            overlay.css('display', 'block');
            overlay.removeClass('animated fadeOut')
            .addClass('animated fadeIn');
			
            e.css('display','block');
            e.removeClass(settings.animatedOut)
			.addClass(settings.animatedIn)
			.focus();
			
            settings.onAfterShow();
			
			open = true;
			
            if(typeof settings.toCenter === 'boolean')
                if (settings.toCenter) toCenter();
            else if (typeof settings.toCenter === 'object')
                    if (settings.toCenter.apply) toCenter(settings.toCenter.relativeTo);
        },

		close = function (forceCallbacks = false, before = function () { }, after = function () { }) {

			if (forceCallbacks) before();
			else settings.onBeforeClose();

			overlay.css('display', 'none');
			e.removeClass(settings.animatedIn)
			.addClass(settings.animatedOut);

			if (forceCallbacks) after();
			else settings.onAfterClose();

			open = false;
		}

        applySettings = function(conf, merge = true){
            settings = (merge)? $.extend(true, settings, conf) : settings = conf;
        }

        toCenter = function(relativeTo = 'body'){
            if (!e.centered){
                e.centered = true;
                e.css('left', ((1 / 2) * (document.getElementsByTagName('body')[0].clientWidth - e[0].clientWidth)) + 'px');
            }
        }

        applyStyle = function(style){
            e.css(style || settings.style);
        }

        init();

        return this;
    };
}( jQuery ));
