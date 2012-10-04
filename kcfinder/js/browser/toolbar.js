/** This file is part of KCFinder project
  *
  *      @desc Toolbar functionality
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

browser.initToolbar = function() {
    $j('#toolbar a').click(function() {
        browser.hideDialog();
    });

    if (!_.kuki.isSet('displaySettings'))
        _.kuki.set('displaySettings', 'off');

    if (_.kuki.get('displaySettings') == 'on') {
        $j('#toolbar a[href="kcact:settings"]').addClass('selected');
        $j('#settings').css('display', 'block');
        browser.resize();
    };

    $j('#toolbar a[href="kcact:settings"]').click(function () {
        if ($j('#settings').css('display') == 'none') {
            $j(this).addClass('selected');
            _.kuki.set('displaySettings', 'on');
            $j('#settings').css('display', 'block');
            browser.fixFilesHeight();
        } else {
            $j(this).removeClass('selected');
            _.kuki.set('displaySettings', 'off');
            $j('#settings').css('display', 'none');
            browser.fixFilesHeight();
        }
        return false;
    });

    $j('#toolbar a[href="kcact:refresh"]').click(function() {
        browser.refresh();
        return false;
    });

    if (window.opener || this.opener.TinyMCE || $j('iframe', window.parent.document).get(0))
        $j('#toolbar a[href="kcact:maximize"]').click(function() {
            browser.maximize(this);
            return false;
        });
    else
        $j('#toolbar a[href="kcact:maximize"]').css('display', 'none');

    $j('#toolbar a[href="kcact:about"]').click(function() {
        var html = '<div class="box about">' +
            '<div class="head"><a href="http://kcfinder.sunhater.com" target="_blank">KCFinder</a> ' + browser.version + '</div>';
        if (browser.support.check4Update)
            html += '<div id="checkver"><span class="loading"><span>' + browser.label("Checking for new version...") + '</span></span></div>';
        html +=
            '<div>' + browser.label("Licenses:") + ' GPLv2 & LGPLv2</div>' +
            '<div>Copyright &copy;2010, 2011 Pavel Tzonkov</div>' +
            '<button>' + browser.label("OK") + '</button>' +
        '</div>';
        $j('#dialog').html(html);
        $j('#dialog').data('title', browser.label("About"));
        browser.showDialog();
        var close = function() {
            browser.hideDialog();
            browser.unshadow();
        };
        $j('#dialog button').click(close);
        var span = $j('#checkver > span');
        setTimeout(function() {
            $j.ajax({
                dataType: 'json',
                url: browser.baseGetData('check4Update'),
                async: true,
                success: function(data) {
                    if (!$j('#dialog').html().length)
                        return;
                    span.removeClass('loading');
                    if (!data.version) {
                        span.html(browser.label("Unable to connect!"));
                        browser.showDialog();
                        return;
                    }
                    if (browser.version < data.version)
                        span.html('<a href="http://kcfinder.sunhater.com/download" target="_blank">' + browser.label("Download version {version} now!", {version: data.version}) + '</a>');
                    else
                        span.html(browser.label("KCFinder is up to date!"));
                    browser.showDialog();
                },
                error: function() {
                    if (!$j('#dialog').html().length)
                        return;
                    span.removeClass('loading');
                    span.html(browser.label("Unable to connect!"));
                    browser.showDialog();
                }
            });
        }, 1000);
        $j('#dialog').unbind();

        return false;
    });

    this.initUploadButton();
};

browser.initUploadButton = function() {
    var btn = $j('#toolbar a[href="kcact:upload"]');
    if (!this.access.files.upload) {
        btn.css('display', 'none');
        return;
    }
    var top = btn.get(0).offsetTop;
    var width = btn.outerWidth();
    var height = btn.outerHeight();
    $j('#toolbar').prepend('<div id="upload" style="top:' + top + 'px;width:' + width + 'px;height:' + height + 'px">' +
        '<form enctype="multipart/form-data" method="post" target="uploadResponse" action="' + browser.baseGetData('upload') + '">' +
            '<input type="file" name="upload[]" onchange="browser.uploadFile(this.form)" style="height:' + height + 'px" multiple="multiple" />' +
            '<input type="hidden" name="dir" value="" />' +
        '</form>' +
    '</div>');
    $j('#upload input').css('margin-left', "-" + ($j('#upload input').outerWidth() - width) + 'px');
    $j('#upload').mouseover(function() {
        $j('#toolbar a[href="kcact:upload"]').addClass('hover');
    });
    $j('#upload').mouseout(function() {
        $j('#toolbar a[href="kcact:upload"]').removeClass('hover');
    });
};

browser.uploadFile = function(form) {
    if (!this.dirWritable) {
        browser.alert(this.label("Cannot write to upload folder."));
        $j('#upload').detach();
        browser.initUploadButton();
        return;
    };
    form.elements[1].value = browser.dir;
    $j('<iframe id="uploadResponse" name="uploadResponse" src="javascript:;"></iframe>').prependTo(document.body);
    $j('#loading').html(this.label("Uploading file..."));
    $j('#loading').css('display', 'inline');
    form.submit();
    $j('#uploadResponse').load(function() {
        var response = $j(this).contents().find('body').html();
        $j('#loading').css('display', 'none');
        response = response.split("\n");
        var selected = [], errors = [];
        $j.each(response, function(i, row) {
            if (row.substr(0, 1) == '/')
                selected[selected.length] = row.substr(1, row.length - 1);
            else
                errors[errors.length] = row;
        });
        if (errors.length)
            browser.alert(errors.join("\n"));
        if (!selected.length)
            selected = null;
        browser.refresh(selected);
        $j('#upload').detach();
        setTimeout(function() {
            $j('#uploadResponse').detach();
        }, 1);
        browser.initUploadButton();
    });
};

browser.maximize = function(button) {
    if (window.opener) {
        window.moveTo(0, 0);
        width = screen.availWidth;
        height = screen.availHeight;
        if ($j.browser.opera)
            height -= 50;
        window.resizeTo(width, height);

    } else if (browser.opener.TinyMCE) {
        var win, ifr, id;

        $j('iframe', window.parent.document).each(function() {
            if (/^mce_\d+_ifr$j/.test($j(this).attr('id'))) {
                id = parseInt($j(this).attr('id').replace(/^mce_(\d+)_ifr$j/, "$j1"));
                win = $j('#mce_' + id, window.parent.document);
                ifr = $j('#mce_' + id + '_ifr', window.parent.document);
            }
        });

        if ($j(button).hasClass('selected')) {
            $j(button).removeClass('selected');
            win.css({
                left: browser.maximizeMCE.left + 'px',
                top: browser.maximizeMCE.top + 'px',
                width: browser.maximizeMCE.width + 'px',
                height: browser.maximizeMCE.height + 'px'
            });
            ifr.css({
                width: browser.maximizeMCE.width - browser.maximizeMCE.Hspace + 'px',
                height: browser.maximizeMCE.height - browser.maximizeMCE.Vspace + 'px'
            });

        } else {
            $j(button).addClass('selected');
            browser.maximizeMCE = {
                width: _.nopx(win.css('width')),
                height: _.nopx(win.css('height')),
                left: win.position().left,
                top: win.position().top,
                Hspace: _.nopx(win.css('width')) - _.nopx(ifr.css('width')),
                Vspace: _.nopx(win.css('height')) - _.nopx(ifr.css('height'))
            };
            var width = $j(window.parent).width();
            var height = $j(window.parent).height();
            win.css({
                left: $j(window.parent).scrollLeft() + 'px',
                top: $j(window.parent).scrollTop() + 'px',
                width: width + 'px',
                height: height + 'px'
            });
            ifr.css({
                width: width - browser.maximizeMCE.Hspace + 'px',
                height: height - browser.maximizeMCE.Vspace + 'px'
            });
        }

    } else if ($j('iframe', window.parent.document).get(0)) {
        var ifrm = $j('iframe[name="' + window.name + '"]', window.parent.document);
        var parent = ifrm.parent();
        var width, height;
        if ($j(button).hasClass('selected')) {
            $j(button).removeClass('selected');
            if (browser.maximizeThread) {
                clearInterval(browser.maximizeThread);
                browser.maximizeThread = null;
            }
            if (browser.maximizeW) browser.maximizeW = null;
            if (browser.maximizeH) browser.maximizeH = null;
            $j.each($j('*', window.parent.document).get(), function(i, e) {
                e.style.display = browser.maximizeDisplay[i];
            });
            ifrm.css({
                display: browser.maximizeCSS.display,
                position: browser.maximizeCSS.position,
                left: browser.maximizeCSS.left,
                top: browser.maximizeCSS.top,
                width: browser.maximizeCSS.width,
                height: browser.maximizeCSS.height
            });
            $j(window.parent).scrollLeft(browser.maximizeLest);
            $j(window.parent).scrollTop(browser.maximizeTop);

        } else {
            $j(button).addClass('selected');
            browser.maximizeCSS = {
                display: ifrm.css('display'),
                position: ifrm.css('position'),
                left: ifrm.css('left'),
                top: ifrm.css('top'),
                width: ifrm.outerWidth() + 'px',
                height: ifrm.outerHeight() + 'px'
            };
            browser.maximizeTop = $j(window.parent).scrollTop();
            browser.maximizeLeft = $j(window.parent).scrollLeft();
            browser.maximizeDisplay = [];
            $j.each($j('*', window.parent.document).get(), function(i, e) {
                browser.maximizeDisplay[i] = $j(e).css('display');
                $j(e).css('display', 'none');
            });

            ifrm.css('display', 'block');
            ifrm.parents().css('display', 'block');
            var resize = function() {
                width = $j(window.parent).width();
                height = $j(window.parent).height();
                if (!browser.maximizeW || (browser.maximizeW != width) || !browser.maximizeH || (browser.maximizeH != height)) {
                    browser.maximizeW = width;
                    browser.maximizeH = height;
                    ifrm.css({
                        width: width + 'px',
                        height: height + 'px'
                    });
                    browser.resize();
                }
            };
            ifrm.css('position', 'absolute');
            if ((ifrm.offset().left == ifrm.position().left) && (ifrm.offset().top == ifrm.position().top))
                ifrm.css({left: '0', top: '0'});
            else
                ifrm.css({
                    left: - ifrm.offset().left + 'px',
                    top: - ifrm.offset().top + 'px'
                });

            resize();
            browser.maximizeThread = setInterval(resize, 250);
        }
    }
};

browser.refresh = function(selected) {
    this.fadeFiles();
    $j.ajax({
        type: 'POST',
        dataType: 'json',
        url: browser.baseGetData('chDir'),
        data: {dir:browser.dir},
        async: false,
        success: function(data) {
            if (browser.check4errors(data))
                return;
            browser.dirWritable = data.dirWritable;
            browser.files = data.files ? data.files : [];
            browser.orderFiles(null, selected);
            browser.statusDir();
        },
        error: function() {
            $j('#files > div').css({opacity:'', filter:''});
            $j('#files').html(browser.label("Unknown error."));
        }
    });
};
