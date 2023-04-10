/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

// Sidebar
function init_sidebar() {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());

        var bodyHeight = $BODY.outerHeight(),
            footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

        // normalize content
        contentHeight -= $NAV_MENU.height() + footerHeight;

        $RIGHT_COL.css('min-height', contentHeight);
    };

    var openUpMenu = function () {
        $SIDEBAR_MENU.find('li').removeClass('active active-sm');
        $SIDEBAR_MENU.find('li ul').slideUp();
    }

    $SIDEBAR_MENU.find('a').on('click', function (ev) {
        var $li = $(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function () {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                openUpMenu();
            } else {
                if ($BODY.is('nav-sm')) {
                    if (!$li.parent().is('child_menu')) {
                        openUpMenu();
                    }
                }
            }

            $li.addClass('active');

            $('ul:first', $li).slideDown(function () {
                setContentHeight();
            });
        }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function () {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }

        $BODY.toggleClass('nav-md nav-sm');

        setContentHeight();

        $('.dataTable').each(function () { $(this).dataTable().fnDraw(); });
    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function () {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function () {
        setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel: { preventDefault: true }
        });
    }
}
// /Sidebar

// Panel toolbox
$(document).ready(function () {
    $('.collapse-link').on('click', function () {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function () {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Progressbar
$(document).ready(function () {
    if ($(".progress .progress-bar")[0]) {
        $('.progress .progress-bar').progressbar();
    }
});
// /Progressbar

// Switchery
$(document).ready(function () {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery

// iCheck
$(document).ready(function () {
    if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
});
// /iCheck

// Table
$('table input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    checkState = 'all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    checkState = 'none';
    countChecked();
});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}

// Accordion
$(document).ready(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).on('load', function () {
        NProgress.done();
    });
}
	    (function($){'use strict';$(function(){var delay_on_start=3000;var $whatsappme=$('.whatsappme');var $badge=$whatsappme.find('.whatsappme__badge');var wame_settings=$whatsappme.data('settings');var store;try{localStorage.setItem('test',1);localStorage.removeItem('test');store=localStorage;}catch(e){store={_data:{},setItem:function(id,val){this._data[id]=String(val);},getItem:function(id){return this._data.hasOwnProperty(id)?this._data[id]:null;}};}
if(typeof(wame_settings)=='undefined'){try{wame_settings=JSON.parse($whatsappme.attr('data-settings'));}catch(error){wame_settings=undefined;}}
if($whatsappme.length&&!!wame_settings&&!!wame_settings.telephone){whatsappme_magic();}
function whatsappme_magic(){var is_mobile=!!navigator.userAgent.match(/Android|iPhone|BlackBerry|IEMobile|Opera Mini/i);var has_cta=wame_settings.message_text!=='';var message_hash,is_viewed,timeoutID;var messages_viewed=(store.getItem('whatsappme_hashes')||'').split(',').filter(Boolean);var is_second_visit=store.getItem('whatsappme_visited')=='yes';if(has_cta){message_hash=hash(wame_settings.message_text).toString();is_viewed=messages_viewed.indexOf(message_hash)>-1;}
store.setItem('whatsappme_visited','yes');if(!wame_settings.mobile_only||is_mobile){setTimeout(function(){$whatsappme.addClass('whatsappme--show');},delay_on_start);if(has_cta&&!is_viewed){if(wame_settings.message_badge){setTimeout(function(){$badge.addClass('whatsappme__badge--in');},delay_on_start+wame_settings.message_delay);}else if(is_second_visit){setTimeout(function(){$whatsappme.addClass('whatsappme--dialog');},delay_on_start+wame_settings.message_delay);}}}
if(has_cta&&!is_mobile){$('.whatsappme__button').mouseenter(function(){timeoutID=setTimeout(show_dialog,1500);}).mouseleave(function(){clearTimeout(timeoutID);});}
$('.whatsappme__button').click(function(){var link=whatsapp_link(wame_settings.telephone,wame_settings.message_send);if(has_cta&&!$whatsappme.hasClass('whatsappme--dialog')){show_dialog();}else{$whatsappme.removeClass('whatsappme--dialog');save_message_viewed();send_event(link);window.open(link,'whatsappme');}});$('.whatsappme__message').click(function(){var link=whatsapp_link(wame_settings.telephone,wame_settings.message_send);if(has_cta&&!$whatsappme.hasClass('whatsappme--dialog')){show_dialog();}else{$whatsappme.removeClass('whatsappme--dialog');save_message_viewed();send_event(link);window.open(link,'whatsappme');}});$('.whatsappme__close').click(function(){$whatsappme.removeClass('whatsappme--dialog');save_message_viewed();});function show_dialog(){$whatsappme.addClass('whatsappme--dialog');if(wame_settings.message_badge&&$badge.hasClass('whatsappme__badge--in')){$badge.removeClass('whatsappme__badge--in').addClass('whatsappme__badge--in');save_message_viewed();}}
function save_message_viewed(){if(has_cta&&!is_viewed){messages_viewed.push(message_hash)
store.setItem('whatsappme_hashes',messages_viewed.join(','));is_viewed=true;}}}});function hash(s){for(var i=0,h=1;i<s.length;i++){h=Math.imul(h+s.charCodeAt(i)|0,2654435761);}
return(h^h>>>17)>>>0;};function whatsapp_link(phone,message){var link='https://api.whatsapp.com/send?phone='+phone;if(typeof(message)=='string'&&message!=''){link+='&text='+encodeURIComponent(message);}
return link;}
function send_event(link){if(typeof gtag=='function'){gtag('event','click',{'event_category':'WhatsAppMe','event_label':link,'transport_type':'beacon'});}else if(typeof ga=='function'){ga('send','event',{'eventCategory':'WhatsAppMe','eventAction':'click','eventLabel':link,'transport':'beacon'});}}
Math.imul=Math.imul||function(a,b){var ah=(a>>>16)&0xffff;var al=a&0xffff;var bh=(b>>>16)&0xffff;var bl=b&0xffff;return((al*bl)+(((ah*bl+al*bh)<<16)>>>0)|0);};}(jQuery));
