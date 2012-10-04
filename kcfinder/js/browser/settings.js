/** This file is part of KCFinder project
  *
  *      @desc Settings panel functionality
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

browser.initSettings = function() {

    if (!this.shows.length) {
        var showInputs = $j('#show input[type="checkbox"]').toArray();
        $j.each(showInputs, function (i, input) {
            browser.shows[i] = input.name;
        });
    }

    var shows = this.shows;

    if (!_.kuki.isSet('showname')) {
        _.kuki.set('showname', 'on');
        $j.each(shows, function (i, val) {
            if (val != "name") _.kuki.set('show' + val, 'off');
        });
    }

    $j('#show input[type="checkbox"]').click(function() {
        var kuki = $j(this).get(0).checked ? 'on' : 'off';
        _.kuki.set('show' + $j(this).get(0).name, kuki);
        if ($j(this).get(0).checked)
            $j('#files .file div.' + $j(this).get(0).name).css('display', 'block');
        else
            $j('#files .file div.' + $j(this).get(0).name).css('display', 'none');
    });

    $j.each(shows, function(i, val) {
        var checked = (_.kuki.get('show' + val) == 'on') ? 'checked' : '';
        $j('#show input[name="' + val + '"]').get(0).checked = checked;
    });

    if (!this.orders.length) {
        var orderInputs = $j('#order input[type="radio"]').toArray();
        $j.each(orderInputs, function (i, input) {
            browser.orders[i] = input.value;
        });
    }

    var orders = this.orders;

    if (!_.kuki.isSet('order'))
        _.kuki.set('order', 'name');

    if (!_.kuki.isSet('orderDesc'))
        _.kuki.set('orderDesc', 'off');

    $j('#order input[value="' + _.kuki.get('order') + '"]').get(0).checked = true;
    $j('#order input[name="desc"]').get(0).checked = (_.kuki.get('orderDesc') == 'on');

    $j('#order input[type="radio"]').click(function() {
        _.kuki.set('order', $j(this).get(0).value);
        browser.orderFiles();
    });

    $j('#order input[name="desc"]').click(function() {
        _.kuki.set('orderDesc', $j(this).get(0).checked ? 'on' : 'off');
        browser.orderFiles();
    });

    if (!_.kuki.isSet('view'))
        _.kuki.set('view', 'thumbs');

    if (_.kuki.get('view') == 'list') {
        $j('#show input').each(function() { this.checked = true; });
        $j('#show input').each(function() { this.disabled = true; });
    }

    $j('#view input[value="' + _.kuki.get('view') + '"]').get(0).checked = true;

    $j('#view input').click(function() {
        var view = $j(this).attr('value');
        if (_.kuki.get('view') != view) {
            _.kuki.set('view', view);
            if (view == 'list') {
                $j('#show input').each(function() { this.checked = true; });
                $j('#show input').each(function() { this.disabled = true; });
            } else {
                $j.each(browser.shows, function(i, val) {
                    $j('#show input[name="' + val + '"]').get(0).checked =
                        (_.kuki.get('show' + val) == "on");
                });
                $j('#show input').each(function() { this.disabled = false; });
            }
        }
        browser.refresh();
    });
};
