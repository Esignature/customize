<?php

/** This file is part of KCFinder project
  *
  *      @desc Object initializations
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */?>

browser.init = function() {
    if (!this.checkAgent()) return;

    $j('body').click(function() {
        browser.hideDialog();
    });
    $j('#shadow').click(function() {
        return false;
    });
    $j('#dialog').unbind();
    $j('#dialog').click(function() {
        return false;
    });
    $j('#alert').unbind();
    $j('#alert').click(function() {
        return false;
    });
    this.initOpeners();
    this.initSettings();
    this.initContent();
    this.initToolbar();
    this.initResizer();
    this.initDropUpload();
};

browser.checkAgent = function() {
    if (!$j.browser.version ||
        ($j.browser.msie && (parseInt($j.browser.version) < 7) && !this.support.chromeFrame) ||
        ($j.browser.opera && (parseInt($j.browser.version) < 10)) ||
        ($j.browser.mozilla && (parseFloat($j.browser.version.replace(/^(\d+(\.\d+)?)([^\d].*)?$j/, "$j1")) < 1.8))
    ) {
        var html = '<div style="padding:10px">Your browser is not capable to display KCFinder. Please update your browser or install another one: <a href="http://www.mozilla.com/firefox/" target="_blank">Mozilla Firefox</a>, <a href="http://www.apple.com/safari" target="_blank">Apple Safari</a>, <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>, <a href="http://www.opera.com/browser" target="_blank">Opera</a>.';
        if ($j.browser.msie)
            html += ' You may also install <a href="http://www.google.com/chromeframe" target="_blank">Google Chrome Frame ActiveX plugin</a> to get Internet Explorer 6 working.';
        html += '</div>';
        $j('body').html(html);
        return false;
    }
    return true;
};

browser.initOpeners = function() {
    if (this.opener.TinyMCE && (typeof(tinyMCEPopup) == 'undefined'))
        this.opener.TinyMCE = null;

    if (this.opener.TinyMCE)
        this.opener.callBack = true;

    if ((!this.opener.name || (this.opener.name == 'fckeditor')) &&
        window.opener && window.opener.SetUrl
    ) {
        this.opener.FCKeditor = true;
        this.opener.callBack = true;
    }

    if (this.opener.CKEditor) {
        if (window.parent && window.parent.CKEDITOR)
            this.opener.CKEditor.object = window.parent.CKEDITOR;
        else if (window.opener && window.opener.CKEDITOR) {
            this.opener.CKEditor.object = window.opener.CKEDITOR;
            this.opener.callBack = true;
        } else
            this.opener.CKEditor = null;
    }

    if (!this.opener.CKEditor && !this.opener.FCKEditor && !this.TinyMCE) {
        if ((window.opener && window.opener.KCFinder && window.opener.KCFinder.callBack) ||
            (window.parent && window.parent.KCFinder && window.parent.KCFinder.callBack)
        )
            this.opener.callBack = window.opener
                ? window.opener.KCFinder.callBack
                : window.parent.KCFinder.callBack;

        if ((
                window.opener &&
                window.opener.KCFinder &&
                window.opener.KCFinder.callBackMultiple
            ) || (
                window.parent &&
                window.parent.KCFinder &&
                window.parent.KCFinder.callBackMultiple
            )
        )
            this.opener.callBackMultiple = window.opener
                ? window.opener.KCFinder.callBackMultiple
                : window.parent.KCFinder.callBackMultiple;
    }
};

browser.initContent = function() {
    $j('div#folders').html(this.label("Loading folders..."));
    $j('div#files').html(this.label("Loading files..."));
    $j.ajax({
        type: 'GET',
        dataType: 'json',
        url: browser.baseGetData('init'),
        async: false,
        success: function(data) {
            if (browser.check4errors(data))
                return;
            browser.dirWritable = data.dirWritable;
            $j('#folders').html(browser.buildTree(data.tree));
            browser.setTreeData(data.tree);
            browser.initFolders();
            browser.files = data.files ? data.files : [];
            browser.orderFiles();
        },
        error: function() {
            $j('div#folders').html(browser.label("Unknown error."));
            $j('div#files').html(browser.label("Unknown error."));
        }
    });
};

browser.initResizer = function() {
    var cursor = ($j.browser.opera) ? 'move' : 'col-resize';
    $j('#resizer').css('cursor', cursor);
    $j('#resizer').drag('start', function() {
        $j(this).css({opacity:'0.4', filter:'alpha(opacity:40)'});
        $j('#all').css('cursor', cursor);
    });
    $j('#resizer').drag(function(e) {
        var left = e.pageX - parseInt(_.nopx($j(this).css('width')) / 2);
        left = (left >= 0) ? left : 0;
        left = (left + _.nopx($j(this).css('width')) < $j(window).width())
            ? left : $j(window).width() - _.nopx($j(this).css('width'));
		$j(this).css('left', left);
	});
	var end = function() {
        $j(this).css({opacity:'0', filter:'alpha(opacity:0)'});
        $j('#all').css('cursor', '');
        var left = _.nopx($j(this).css('left')) + _.nopx($j(this).css('width'));
        var right = $j(window).width() - left;
        $j('#left').css('width', left + 'px');
        $j('#right').css('width', right + 'px');
        _('files').style.width = $j('#right').innerWidth() - _.outerHSpace('#files') + 'px';
        _('resizer').style.left = $j('#left').outerWidth() - _.outerRightSpace('#folders', 'm') + 'px';
        _('resizer').style.width = _.outerRightSpace('#folders', 'm') + _.outerLeftSpace('#files', 'm') + 'px';
        browser.fixFilesHeight();
    };
    $j('#resizer').drag('end', end);
    $j('#resizer').mouseup(end);
};

browser.resize = function() {
    _('left').style.width = '25%';
    _('right').style.width = '75%';
    _('toolbar').style.height = $j('#toolbar a').outerHeight() + "px";
    _('shadow').style.width = $j(window).width() + 'px';
    _('shadow').style.height = _('resizer').style.height = $j(window).height() + 'px';
    _('left').style.height = _('right').style.height =
        $j(window).height() - $j('#status').outerHeight() + 'px';
    _('folders').style.height =
        $j('#left').outerHeight() - _.outerVSpace('#folders') + 'px';
    browser.fixFilesHeight();
    var width = $j('#left').outerWidth() + $j('#right').outerWidth();
    _('status').style.width = width + 'px';
    while ($j('#status').outerWidth() > width)
        _('status').style.width = _.nopx(_('status').style.width) - 1 + 'px';
    while ($j('#status').outerWidth() < width)
        _('status').style.width = _.nopx(_('status').style.width) + 1 + 'px';
    if ($j.browser.msie && ($j.browser.version.substr(0, 1) < 8))
        _('right').style.width = $j(window).width() - $j('#left').outerWidth() + 'px';
    _('files').style.width = $j('#right').innerWidth() - _.outerHSpace('#files') + 'px';
    _('resizer').style.left = $j('#left').outerWidth() - _.outerRightSpace('#folders', 'm') + 'px';
    _('resizer').style.width = _.outerRightSpace('#folders', 'm') + _.outerLeftSpace('#files', 'm') + 'px';
};

browser.fixFilesHeight = function() {
    _('files').style.height =
        $j('#left').outerHeight() - $j('#toolbar').outerHeight() - _.outerVSpace('#files') -
        (($j('#settings').css('display') != "none") ? $j('#settings').outerHeight() : 0) + 'px';
};
