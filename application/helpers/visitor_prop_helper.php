<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* This data user in this file is part of BBClone (A PHP based Web Counter on Steroids)
 * CVS FILE $Id: os.php,v 1.112 2011/12/30 23:03:47 joku Exp $
 * Copyright (C) 2001-2012, the BBClone Team (see doc/authors.txt for details) *
 */

/////////////////////////////////////
// OS (Operation System) Detection //
/////////////////////////////////////

if(!function_exists('allOS')){
    function allOS(){
        $os = array(
          "aix"=> array(
            "icon"=> "aix",
            "title" => "AIX",
            "rule" => array(
              "-aix([0-9.]{1,10})" => "\\1",
              "[ ;\(]aix" => ""
            ),
            "uri" => ""
          ),
          "amiga" => array(
            "icon" => "amiga",
            "title" => "Amiga OS",
            "rule" => array(
              "Amiga[ ]?OS[ /]([0-9.V]{1,10})" => "\\1",
              "amiga" => ""
            ),
            "uri" => ""
          ),
          "android" => array(
            "icon" => "android",
            "title" => "Android",
            "rule" => array(
              "Android ([0-9.]{1,10})" => "\\1",
              "Android" => ""
            ),
            "uri" => "http://www.android.com/"
          ),
          "blackberry" => array(
            "icon" => "blackberry",
            "title" => "BlackBerry OS",
            "rule" => array(
              "BlackBerry" => ""
            ),
            "uri" => "http://www.blackberry.com/"
          ),
          "centos" => array(
            "icon" => "centos",
            "title" => "CentOS",
            "rule" => array(
              "centos([0-9]{1})" => "\\1",
              "el([0-9.]{1}).*centos" => "\\1",
              "CentOS" => ""
            ),
            "uri" => "http://www.centos.org/"
          ),
          "digital" => array(
            "icon" => "digital",
            "title" => "Digital",
            "rule" => array(
              "OSF[0-9][ ]?V(4[0-9.]{1,10})" => "\\1"
            ),
            "uri" => ""
          ),
          "embedix" => array(
            "icon" => "question",
            "title" => "Embedix",
            "rule" => array(
             "Embedix" => ""
            ),
            "uri" => ""
          ),
          "Fedora Linux" => array(
            "icon" => "fedora",
            "title" => "Fedora Linux",
            "rule" => array(
             "Fedora/[0-9.-]+fc([0-9]+)" => "\\1",
             "fedora" => ""
            ),
            "uri" => "http://fedoraproject.org/"
          ),
          "fenix" => array(
            "icon" => "question",
            "title" => "Fenix",
            "rule" => array(
             "Fenix" => ""
            ),
            "uri" => ""
          ),
          "freebsd" => array(
            "icon" => "freebsd",
            "title" => "FreeBSD",
            "rule" => array(
             "free[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
             "free[ \-]?bsd" => ""
            ),
            "uri" => "http://www.freebsd.org/"
          ),
          "ios" => array(
            "icon" => "ios",
            "title" => "iOS",
            "rule" => array(
              "i(Phone|Pod|Pad).*OS[ /]([0-9]{1,10})_([0-9]{1,10})" => "\\2.\\3",
              "i(Phone|Pod|Pad)" => ""
            ),
            "uri" => "http://www.apple.com/ios/"
          ),
          "irix" => array(
            "icon" => "irix",
            "title" => "IRIX",
            "rule" => array(
              "irix[0-9]*[ /]([0-9.]{1,10})" => "\\1",
              "irix" => ""
            ),
            "uri" => ""
          ),
          "macosx" => array(
            "icon" => "macosx",
            "title" => "MacOS X",
            "rule" => array(
              "Mac[ _]OS[ _]X[ /_]([0-9]{1,10})[._]([0-9]{1,10})[._]([0-9]{1,10})" => "\\1.\\2.\\3",
              "Mac[ _]OS[ _]X[ /_]([0-9]{1,10})[._]([0-9]{1,10})" => "\\1.\\2",
              "Mac[ _]OS[ _]X" => "",
              "Mac 10.([0-9.]{1,10})" => "\\1"
            ),
            "uri" => "http://www.apple.com/macosx/"
          ),
          "macppc" => array(
            "icon" => "macppc",
            "title" => "MacOS PPC",
            "rule" => array(
              "Mac(_Power|intosh.+P)PC" => ""
            ),
            "uri" => ""
          ),
          "mandriva" => array(
            "icon" => "mandriva",
            "title" => "Mandriva",
            "rule" => array(
              "Mandriva[ /]([0-9.]{1,10})" => "\\1",
              "Linux[ /\-]([0-9.-]{1,10}).mdk" => "",
              "Linux[ /\-]([0-9.-]{1,10}).mdv" => "\\1"
            ),
            "uri" => "http://www.mandriva.com/"
          ),
          "netbsd" => array(
            "icon" => "netbsd",
            "title" => "NetBSD",
            "rule" => array(
              "net[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
              "net[ \-]?bsd" => ""
            ),
            "uri" => ""
          ),
          "openbsd" => array(
            "icon" => "openbsd",
            "title" => "OpenBSD",
            "rule" => array(
              "open[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
              "open[ \-]?bsd" => ""
            ),
            "uri" => ""
          ),
          "palm" => array(
            "icon" => "palm",
            "title" => "PalmOS",
            "rule" => array(
              "Palm[ \-]?(Source|OS)[ /]?([0-9.]{1,10})" => "\\2",
              "Palm[ \-]?(Source|OS)" => ""
            ),
            "uri" => ""
          ),
          "pclinux" => array(
            "icon" => "pclinux",
            "title" => "PCLinuxOS",
            "rule" => array(
              "PCLinuxOS[ /]?([0-9.]{1,10})" => "\\1"
            ),
            "uri" => "http://www.pclinuxos.com/"
          ),
          "photon" => array(
            "icon" => "qnx",
            "title" => "QNX Photon",
            "rule" => array(
              "photon" => "",
              "QNX" => ""
            ),
            "uri" => "http://www.qnx.com/"
          ),
          "redhat" => array(
            "icon" => "redhat",
            "title" => "RedHat",
            "rule" => array(
              "Red Hat[ /]?([0-9.]{1,10})" => "\\1",
              "RedHat" => ""
            ),
            "uri" => "http://www.redhat.com/"
          ),
          "suse" => array(
            "icon" => "suse",
            "title" => "SuSE Linux",
            "rule" => array(
              "suse" => ""
            ),
            "uri" => "http://www.novell.com/linux/"
          ),
          "sun" => array(
            "icon" => "sun",
            "title" => "SunOS",
            "rule" => array(
              "sun[ \-]?os[ /]?([0-9.]{1,10})" => "\\1",
              "sun[ \-]?os" => "",
              "^SUNPlex[ /]?([0-9.]{1,10})" => "\\1"
            ),
            "uri" => ""
          ),
          "symbian" => array(
            "icon"  => "symbian",
            "title" => "Symbian OS",
            "rule"  => array(
              "symbian[ \-]?os[ /]?([0-9.]{1,10})" => "\\1",
              "symbOS" => "",
              "symbian" => ""
            ),
            "uri" => ""
          ),
          "ubuntu" => array(
            "icon" => "ubuntu",
            "title" => "Ubuntu Linux",
            "rule" => array(
              "ubuntu/([0-9.]+)" => "\\1",
              "ubuntu" => ""
            ),
            "uri" => "http://www.ubuntu.com/"
          ),
          "unixware" => array(
            "icon" => "sco",
            "title" => "UnixWare",
            "rule" => array(
              "unixware[ /]?([0-9.]{1,10})" => "\\1",
              "unixware" => ""
            ),
            "uri" => ""
          ),
          "webos" => array(
            "icon" => "palm",
            "title" => "Web OS",
            "rule" => array(
              "webOS[ /]?([0-9.]{1,10})" => "\\1"
            ),
            "uri" => "http://www.palm.com/"
          ),
          "windowsxp64" => array(
            "icon" => "windowsxp",
            "title" => "Windows XP (64-bit)",
            "rule" => array(
              "wi(n|ndows)[ \-]?(2003|nt[ /]?5\.2).*(WOW64|Win64)" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsxp/64bit/"
          ),
          "windows2003" => array(
            "icon" => "windowsxp",
            "title" => "Windows 2003",
            "rule" => array(
              "wi(n|ndows)[ \-]?(2003|nt[ /]?5\.2)" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsserver2003/"
          ),
          "windows2k" => array(
            "icon" => "windows",
            "title" => "Windows 2000",
            "rule" => array(
              "wi(n|ndows)[ \-]?(2000|nt[ /]?5\.0)" => ""
            ),
            "uri" => "http://www.microsoft.com/windows2000/"
          ),
          "windows31" => array(
            "icon" => "windows31",
            "title" => "Windows 3.1",
            "rule" => array(
              "wi(n|ndows)[ \-]?3\.[1]+" => "",
              "Win16" => ""
            ),
            "uri" => ""
          ),
          "windows95" => array(
            "icon" => "windows",
            "title" => "Windows 95",
            "rule" => array(
              "wi(n|ndows)[ \-]?95" => ""
            ),
            "uri" => "http://www.microsoft.com/windows95/"
          ),
          "windowsce" => array(
            "icon" => "windowsce",
            "title" => "Windows CE",
            "rule" => array(
              "wi(n|ndows)[ \-]?ce" => "",
              "wi(n|ndows)[ /.;]*mobile" => "",
              "(Microsoft|Windows) Pocket" => ""
            ),
            "uri" => "http://www.microsoft.com/windows/embedded/"
          ),
          "windowsme" => array(
            "icon" => "windowsme",
            "title" => "Windows ME",
            "rule" => array(
              "win 9x 4\.90" => "",
              "wi(n|ndows)[ \-]?me" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsme/"
          ),
          "windowsvista" => array(
            "icon" => "windowsvista",
            "title" => "Windows Vista",
            "rule" => array(
              "Windows Vista" => "",
              "wi(n|ndows)[ \-]?nt[ /]?6\.0" => "",
              "wi(n|ndows)[ \-]?6\.0" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsvista/"
          ),
          "windows7" => array(
            "icon" => "windows7",
            "title" => "Windows 7",
            "rule" => array(
              "wi(n|ndows)[ \-]?nt[ /]?6\.1" => ""
            ),
            "uri" => "http://www.microsoft.com/windows/windows-7/"
          ),
          "windows8" => array(
            "icon" => "windows8",
            "title" => "Windows 8",
            "rule" => array(
              "wi(n|ndows)[ \-]?nt[ /]?6\.2" => ""
            ),
            "uri" => "http://www.microsoft.com/windows/windows-8/"
          ),
          "windowsmc" => array(
            "icon" => "windowsxp",
            "title" => "Windows Media Center",
            "rule" => array(
              "Media Center PC[ /]([0-9.]{1,10})" => "\\1"
            ),
            "uri" => "http://www.microsoft.com/windowsxp/mediacenter/"
          ),
          "windowsxp" => array(
            "icon" => "windowsxp",
            "title" => "Windows XP",
            "rule" => array(
              "Windows XP" => "",
              "wi(n|ndows)[ \-]?nt[ /]?5\.1" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsxp/"
          ),
          // Catch up for the originals, they got to stay in that order.
          "debian" => array(
            "icon" => "debian",
            "title" => "Debian Linux",
            "rule" => array(
              "debian" => ""
            ),
            "uri" => "http://www.debian.org/"
          ),
          "beos" => array(
            "icon" => "be",
            "title" => "BeOS",
            "rule" => array(
              "beos[ a-z]*([0-9.]{1,10})" => "\\1",
              "beos" => ""
            ),
            "uri" => ""
          ),
          "bsd" => array(
            "icon" => "bsd",
            "title" => "BSD",
            "rule" => array(
              "bsd" => ""
            ),
            "uri" => ""
          ),
          "linux" => array(
            "icon" => "linux",
            "title" => "Linux",
            "rule" => array(
              "linux[ /\-]([a-z0-9._]{1,10})" => "\\1",
              "linux" => ""
            ),
            "uri" => "http://www.kernel.org/"
          ),
          "os2" => array(
            "icon" => "os2",
            "title" => "OS/2 Warp",
            "rule" => array(
              "warp[ /]?([0-9.]{1,10})" => "\\1",
              "os[ /]?2" => ""
            ),
            "uri" => ""
          ),
          "mac" => array(
            "icon" => "mac",
            "title" => "MacOS",
            "rule" => array(
              "mac[^hk]" => ""
            ),
            "uri" => ""
          ),
          "windowsnt" => array(
            "icon" => "windows",
            "title" => "Windows NT",
            "rule" => array(
              "wi(n|ndows)[ \-]?nt[ /]?([0-4][0-9.]{1,10})" => "\\2",
              "wi(n|ndows)[ \-][ /]?([0-4][0-9.]{1,10})" => "\\2",
              "wi(n|ndows)[ \-]?nt" => ""
            ),
            "uri" => "http://www.microsoft.com/windowsnt/"
          ),
          "windows98" => array(
            "icon" => "windows",
            "title" => "Windows 98",
            "rule" => array(
              "wi(n|ndows)[ \-]?98" => ""
            ),
            "uri" => "http://www.microsoft.com/windows98/"
          ),
          "windows" => array(
            "icon" => "windows",
            "title" => "Windows (Any)",
            "rule" => array(
              "wi(n|n32|n64|ndows)" => ""
            ),
            "uri" => ""
          ),
          /*
          "mobile" => array(
              "icon" => "mobile",
              "title" => "Mobile",
              "rule" => array(
                "LG[ /]([0-9A-Z]{1,10})" => "",
                "MOT[ /\-]([0-9A-Z]{1,10})" => "",
                "SonyEricsson([0-9A-Z]{1,10})" => "",
                "SIE([0-9A-Z]{1,10})" => "",
                "Nokia([0-9A-Z]{1,10})" => "",
                "KDDI-([0-9A-Z]{1,10})" => "",
                "^[A-Z]([0-9]{1,3}) " => "",
                "Configuration[ /]CLDC([0-9.]{1,10})" => "\\1",
                "MIDP" => "",
                "UP\.(Browser|Link)" => "",
                "ibisBrowser" => ""
             ),
             "uri" => ""
            ),*/          
        );
        return $os;
        }
    }

    ///////////////////////
    // Browser Detection //
    ///////////////////////
            
    if(!function_exists('allBrowsers')){
        function allBrowsers(){           

            $browser = array(
              "amaya" => array(
                "icon" => "amaya",
                "title" => "Amaya",
                "rule" => array(
                  "amaya/([0-9.]{1,10})" => "\\1"
                ),
                "versions"=> array(0.9, 1.0, 1.1, 1.2, 1.3, 1.4, 2.0, 2.1, 2.3, 2.4, 3.0, 3.1, 3.2, 4.0, 4.2, 4.3, 5.0, 5.2, 5.3, 6.0, 6.2, 6.4, 7.0, 7.2, 8.0, 8.1, 8.2, 8.4, 8.5, 8.6, 8.7, 9.0, 9.1, 9.2, 9.3, 9.4, 9.5, 10.0, 11.0, 11.1, 11.2, 11.3),
                "uri" => "http://www.w3c.org/amaya/"
              ),
              "aol" => array(
                "icon" => "aol",
                "title" => "AOL",
                "versions"=> array(1, 1.5),
                "rule" => array(
                  "aol[ /\-]([0-9.]{1,10})" => "\\1",
                  "America Online Browser[ /]([0-9.]{1,10}).*rev([0-9.]{1,10})" => "\\1",
                  "aol[ /\-]?browser" => "",
                  "AOL-IWENG ([0-9.]{1,10})" => "\\1",
                  "ADM[ /]([0-9.]{1,10})" => "\\1"
                ),                
                "uri" => "http://www.aol.com"
              ),
              "avantgo" => array(
                "icon" => "avantgo",
                "title" => "AvantGo",
                "versions"=> array(),
                "rule" => array(
                  "AvantGo[ /]([0-9.]{1,10})" => "\\1"
                ),                
                "uri" => "http://www.avantgo.com/frontdoor/"
              ),
              "camino" => array(
                "icon" => "camino",
                "title" => "Camino",
                "versions"=> array('1.0.2', '1.0.3', '1.0.6', '1.5.1', '1.5.5', '1.6.1', '1.6.10', '1.6.11', '1.6.3', '1.6.4', '1.6.5', '1.6.7', '1.6.9', '2.0.1', '2.0.2', '2.0.3', '2.0.4', '2.0.5', '2.0.7', '2.0.8', '2.0.9', '2.1', '2.1.1', '2.1.2'),
                "rule" => array(
                  "camino/([0-9.+]{1,10})" => "\\1"
                ),
                "uri" => "http://www.mozilla.org/projects/camino/"
              ),              
              "chrome" => array(
                "icon" => "chrome",
                "title" => "Google Chrome",
                "versions"=>array(1, 2, 3, 4, 4.1)+range(5, 19, 1),
                "rule" => array(
                  "\) Chrome([ /])?([0-9.]{1,10})?" => "\\2" //keep this bracket cause Flock have chrome in his UA
                ),
                "uri" => "http://www.google.com/chrome/"
              ),
              "dillo" => array(
                "icon" => "dillo",
                "title" => "Dillo",
                "versions"=> array(),
                "rule" => array(
                  "dillo/([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.dillo.org/"
              ),
              "doczilla" => array(
                "icon" => "doczilla",
                "title" => "DocZilla",
                "versions"=> array(),
                "rule" => array(
                  "DocZilla/([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.doczilla.com/"
              ),
              "elinks" => array(
                "icon" => "links",
                "title" => "ELinks",
                "versions"=> array(),
                "rule" => array(
                  "ELinks[ /][\(]*([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://elinks.or.cz/"
              ),
              "epiphany"  => array(
                "icon"  => "epiphany",
                "title" => "Epiphany",
                "versions"=>array(1, 2, 2.5, 3, 4, 4.1, 4.2, 4.5, 4.6, 4.7, 4.8, 5),
                "rule"  => array(
                  "Epiphany/([0-9.]{1,10})" => "\\1",
                  "epiphany-webkit" => ""
                ),
                "uri" => "http://www.gnome.org/projects/epiphany/"
              ),
              "flock" => array(
                "icon" => "flock",
                "title" => "Flock",
                "versions"=> array(),
                "rule" => array(
                  "Flock/([0-9a-z.]{1,10})" => "\\1",
                  "Sulfur/([0-9a-z.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.flock.com/"
              ),
              "icab" => array(
                "icon" => "icab",
                "title" => "iCab",
                "versions"=>array(1, 2, 2.5, 3, 4, 4.1, 4.2, 4.5, 4.6, 4.7, 4.8, 5),
                "rule" => array(
                  "icab[/ ]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.icab.de/"
              ),
              "k-meleon" => array(
                "icon" => "k-meleon",
                "title" => "K-Meleon",
                "versions"=>array(0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0, 1.1, 1.5, 1.6, 1.7),
                "rule" => array(
                  "K-Meleon[ /]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://kmeleon.sourceforge.net/"
              ),
              "konqueror" => array(
                "icon" => "konqueror",
                "title" => "Konqueror",
                "versions"=>array(2, 3, 3.2, 3.3, 3.4, 3.5, 4, 4.1, 4.2, 4.3, 4.4, 4.5, 4.6, 4.7, 4.8),
                "rule" => array(
                  "konqueror/([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.konqueror.org/"
              ),
              "links" => array(
                "icon" => "links",
                "title" => "Links",
                "versions"=>array(0.8, 0.9, 2, 2.1, 2.2, 2.3, 2.4, 2.5, 2.6),
                "rule" => array(
                  "Links[ /]\(([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://artax.karlin.mff.cuni.cz/~mikulas/links"
              ),
              "lunascape" => array(
                "icon" => "lunascape",
                "title" => "Lunascape",
                "versions"=> array(),
                "rule" => array(
                  "Lunascape[ /]([0-9a-z.]{1,10})" => "\\1"
                ),
                "uri" => ""
              ),
              "lynx" => array(
                "icon" => "lynx",
                "title" => "Lynx",
                "versions"=> array(),
                "rule" => array(
                  "lynx/([0-9a-z.]{1,10})" => "\\1"
                ),
                "uri" => "http://lynx.browser.org/"
              ),
               "maxthon" => array(
                "icon" => "maxthon",
                "title" => "Maxthon",
                "versions"=>array(1.0, 1.5, 1.6, 2.0, 2.5, 3.0, 3.1, 3.2, 3.3),
                "rule" => array(
                  "Maxthon[ /]([0-9.]{1,10})" => "\\1",
                  "Maxthon[\);]" => ""
                ),
                "uri" => ""
              ),
              "midori" => array(
                "icon" => "midori",
                "title" => "Midori",
                "versions"=> array(),
                "rule" => array(
                  "midori[ /]([0-9.]{1,10})" => "\\1",
                  "midori" => ""
                ),
                "uri" => "http://software.twotoasts.de/"
              ),
              "mosaic" => array(
                "icon" => "mosaic",
                "title" => "Mosaic",
                "versions"=> array(),
                "rule" => array(
                  "mosaic[ /]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => ""
              ),
              "netsurf" => array(
                "icon" => "netsurf",
                "title" => "NetSurf",
                "versions"=> array(),
                "rule" => array(
                  "Netsurf[ /]?([0-9.]{1,10})?" => "\\1"
                ),
                "uri" => ""
              ),
              "omniweb" => array(
                "icon" => "omniweb",
                "title" => "OmniWeb",
                "versions"=> array(),
                "rule" => array(
                  "omniweb/[ a-z]?([0-9.]{1,10})$" => "\\1",
                  "OmniWeb/[ a-z]?([0-9.]{1,10})" => "\\1"
                ),
                "uri" => ""
              ),
              "opera" => array(
                "icon" => "opera",
                "title" => "Opera",
                "versions"=> array(),
                "rule" => array(
                  "opera.+Version[ /]([x0-9.]{1,10})" => "\\1",
                  "opera[ /]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.opera.com/"
              ),
              "seamonkey" => array(
                "icon" => "seamonkey",
                "title" => "Seamonkey",
                "versions"=> array(),
                "rule" => array(
                  "Seamonkey[ \-/]([0-9a-z.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.seamonkey-project.org/"
              ),
              "sleipnir" => array(
                "icon" => "sleipnir",
                "title" => "Sleipnir",
                "versions"=> array(),
                "rule" => array(
                  "Sleipnir( Version)?[ /]([0-9a-z.]{1,10})" => "\\2"
                ),
                "uri" => ""
              ),
              "stainless" => array(
                "icon" => "stainless",
                "title" => "Stainless",
                "versions"=> array(),
                "rule" => array(
                  "Stainless[ /]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.stainlessapp.com"
              ),
              "sylera" => array(
                "icon" => "question",
                "title" => "Sylera",
                "versions"=> array(),
                "rule" => array(
                  "Sylera[/ ]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.zawameki.net/izmi/prog/sylera_en.html"
              ),
              "syndirella" => array(
                "icon" => "question",
                "title" => "Syndirella",
                "versions"=> array(),
                "rule" => array(
                  "Syndirella[/ ]([0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://sourceforge.net/projects/syndirella/"
              ),
              // Catch up for the originals, they got to stay in that order.
              "explorer" => array(
                "icon" => "explorer",
                "title" => "Internet Explorer",
                "versions"=>array(1, 2, 3, 4, 5, 5.5, 6, 7, 8, 9, 10),
                "rule" => array(
                  ".*MSIE 7.0.*Trident.*" => "text:8.0 (MSIE 7.0)", //special feature, to detect IE8 Compatibility mode
                  "\(compatible; MSIE[ /]([0-9a-z.]{1,10})" => "\\1",
                  "MSIE[ /]([0-9a-z.]{1,3})" => "\\1",
                  "Internet Explorer[ /]([0-9.]{1,10})" => "\\1",
                  "^Auto-Proxy Downloader" => ""
                ),
                "uri" => "http://www.microsoft.com/windows/ie/"
              ),
              "safari" => array(
                "icon" => "safari",
                "title" => "Safari",
                "versions"=> array(),
                "rule" => array(
                  "version/([0-9.]{1,10})(.*)safari" => "\\1",
                  "Safari[ /]?([0-9.]{1,10})" => "\\1",
                  "AppleWebKit/([0-9.]{1,10}).*Gecko" => "\\1"
                ),
                "uri" => ""
              ),
              "netscape" => array(
                "icon" => "netscape",
                "title" => "Netscape",
                "versions"=> array(),
                "rule" => array(
                  "netscape[0-9]?/([0-9.]{1,10})" => "\\1",
                  "navigator[0-9]?/([0-9.]{1,10})" => "\\1",
                  "^mozilla/([0-4]\.[0-9.]{1,10})" => "\\1"
                ),
                "uri" => "http://www.netscape.com/"
              ),
              "firefox"  => array(
                "icon"  => "firefox",
                "title" => "Firefox",
                "versions"=> array(1, 1.5, 2, 3, 3.5, 3.6, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16),
                "rule"  => array(
                  "Firefox/([0-9.+]{1,10})" => "\\1",
                  "BonEcho/([0-9.+]{1,10})" => "\\1",       // Firefox 2.0 beta
                  "GranParadiso/([0-9.+]{1,10})" => "\\1",  // Firefox 3.0 alpha
                  "Minefield/([0-9.+]{1,10})" => "\\1",     // Firefox 3.0 beta
                  "Shiretoko/([0-9a-z.+]{1,10})" => "\\1",  // Firefox 3.1 alpha
                  "Namoroka/([0-9a-z.+]{1,10})" => "\\1",   // Firefox 3.6 beta,
                  "^mozilla/[5-9]\.[0-9.]{1,10}.+rv:([0-9a-z.+]{1,10})" => "\\1",
                  "^mozilla/([5-9]\.[0-9a-z.]{1,10})" => "\\1",
                  "GNUzilla/([0-9.+]{1,10})" => "\\1",
                  "Firefox" => ""
                ),
                "uri" => "http://www.mozilla.org/projects/firefox/"
              )
            );
            return $browser;
        }
    }

    /* PLATFORMS */
    if(!function_exists('allPlatforms')){
        function allPlatforms(){
            

                $platform = array(
                            "Android",
                            "Android x86",
                            "Apple TV",
                            "BREW",
                            "Bada",
                            "BlackBerry",
                            "Bruce Pad",
                            "CE.Net ARM",
                            "CE.Net x86",
                            "Cherida",
                            "Cobbenhagen",
                            "Duygu Onur",
                            "FOMA",
                            "FTW",
                            "Fam.Morlog",
                            "Fordy's",
                            "FreeBSD",
                            "FreeBSD amd64",
                            "FreeBSD amd64 X11",
                            "FreeBSD i386",
                            "FreeBSD i386 X11",
                            "FreeBSD/i686",
                            "Game Mode",
                            "Haiku BePC",
                            "Hannah",
                            "Isys/305 i686",
                            "JeffPod",
                            "Jortv",
                            "Jos",
                            "Joshwaaa!",
                            "June",
                            "Laras",
                            "Linux",
                            "Linux 35230",
                            "Linux 7631",
                            "Linux armv5",
                            "Linux armv5tejl",
                            "Linux armv5tel",
                            "Linux armv6l",
                            "Linux armv7l",
                            "Linux i586",
                            "Linux i686",
                            "Linux i686 (x86_64)",
                            "Linux i686 X11",
                            "Linux i686 on x86_64",
                            "Linux mips",
                            "Linux ppc",
                            "Linux ppc64",
                            "Linux sh4",
                            "Linux x86_64",
                            "Linux x86_64 X11",
                            "Linuxipadarmv6l",
                            "MOCOR x86",
                            "MTK",
                            "Mac OS X x86",
                            "MacIntel",
                            "MacPPC",
                            "Mocha",
                            "Moshe",
                            "NetBSD amd64",
                            "NetBSD i386",
                            "Nintendo 3DS",
                            "Nintendo DSi",
                            "Nintendo Wii",
                            "Nokia_Series_40",
                            "OS/2",
                            "OpenBSD amd64",
                            "OpenBSD i386",
                            "OpenBSD i386 X11",
                            "OpenVMS COMPAQ_Professional_Workstation",
                            "Our Andy ",
                            "PLAYSTATION 3",
                            "Pascalle",
                            "Pike v7.6 release 92",
                            "Pike v7.8 release 517",
                            "S60",
                            "SHP",
                            "Sandra",
                            "Series60",
                            "SunOS i86pc",
                            "SunOS sun4u",
                            "SunOS sun4v",
                            "Symbian",
                            "Symbian OS",
                            "Tamir Ben Hamo",
                            "TheFaction",
                            "Vodafone NL",
                            "Win32",
                            "Win32 ARM",
                            "Win32 Other",
                            "Win32 i686",
                            "Win32 x64",
                            "Win32 x86",
                            "Win36",
                            "Win64",
                            "Win64 x64",
                            "Win64 x86",
                            "WinCE ARM",
                            "WinCE x86",
                            "WinNT",
                            "Windows",
                            "Windows CE",
                            "Windows Mobile",
                            "X11",
                            "Device",
                            "iPad",
                            "iPad",
                            "iPedro",
                            "iPhone",
                            "iPhone OS 4_2_1 like Mac OS X x86",
                            "iPhone Simulator",
                            "iPod",
                            "ili@ss",
                            "ipaula",
                            "Mesym",
                            "Orange",
                            "Whited00r iPhone",
                            "Whited00r iPod",
                            "Widiyan",
                            "Yooooow",
                            "iVictor"  
                        );
              return $platform;
        }
    }
    
    
    if(!function_exists('allResolutions')){
        function allResolutions(){
            $resolution = array(
                '16x16' => array(
                        'x' => 16,
                        'y' => 16,
                        'ratio' => '1:1',
                        'pixels' => 256
                ),
                '32x32' => array(
                        'x' => 32,
                        'y' => 32,
                        'ratio' => '1:1',
                        'pixels' => 1024
                ),
                '40x30' => array(
                        'x' => 40,
                        'y' => 30,
                        'ratio' => '4:3',
                        'pixels' => 1200
                ),
                '42x11' => array(
                        'x' => 42,
                        'y' => 11,
                        'ratio' => '42:11',
                        'pixels' => 462
                ),
                '42x32' => array(
                        'x' => 42,
                        'y' => 32,
                        'ratio' => '21:16',
                        'pixels' => 1
                ),
                '48x32' => array(
                        'x' => 48,
                        'y' => 32,
                        'ratio' => '3:2',
                        'pixels' => 1536
                ),
                '64x64' => array(
                        'x' => 64,
                        'y' => 64,
                        'ratio' => '1:1',
                        'pixels' => 4096
                ),
                '72x64' => array(
                        'x' => 72,
                        'y' => 64,
                        'ratio' => '9:8',
                        'pixels' => 4608
                ),
                '75x64' => array(
                        'x' => 75,
                        'y' => 64,
                        'ratio' => '75:64',
                        'pixels' => 4
                ),
                '96x64' => array(
                        'x' => 96,
                        'y' => 64,
                        'ratio' => '3:2',
                        'pixels' => 6144
                ),
                '102x64' => array(
                        'x' => 102,
                        'y' => 64,
                        'ratio' => '51:32',
                        'pixels' => 6528
                ),
                '128x128' => array(
                        'x' => 128,
                        'y' => 128,
                        'ratio' => '1:1',
                        'pixels' => 16384
                ),
                '140x192' => array(
                        'x' => 140,
                        'y' => 192,
                        'ratio' => '35:48',
                        'pixels' => 26880
                ),
                '144x168' => array(
                        'x' => 144,
                        'y' => 168,
                        'ratio' => '6:7',
                        'pixels' => 24192
                ),
                '150x40' => array(
                        'x' => 150,
                        'y' => 40,
                        'ratio' => '15:4',
                        'pixels' => 6000
                ),
                '160x144' => array(
                        'x' => 160,
                        'y' => 144,
                        'ratio' => '10:9',
                        'pixels' => 23040
                ),
                '160x120' => array(
                        'x' => 160,
                        'y' => 120,
                        'ratio' => '4:3',
                        'pixels' => 19200
                ),
                '160x102' => array(
                        'x' => 160,
                        'y' => 102,
                        'ratio' => '80:51',
                        'pixels' => 16320
                ),
                '160x152' => array(
                        'x' => 160,
                        'y' => 152,
                        'ratio' => '20:19',
                        'pixels' => 24320
                ),
                '160x160' => array(
                        'x' => 160,
                        'y' => 160,
                        'ratio' => '1:1',
                        'pixels' => 25600
                ),
                '160x200' => array(
                        'x' => 160,
                        'y' => 200,
                        'ratio' => '4:5',
                        'pixels' => 32000
                ),
                '160x256' => array(
                        'x' => 160,
                        'y' => 256,
                        'ratio' => '5:8',
                        'pixels' => 40960
                ),
                '208x176' => array(
                        'x' => 208,
                        'y' => 176,
                        'ratio' => '13:11',
                        'pixels' => 36608
                ),
                '208x208' => array(
                        'x' => 208,
                        'y' => 208,
                        'ratio' => '1:1',
                        'pixels' => 43264
                ),
                '220x176' => array(
                        'x' => 220,
                        'y' => 176,
                        'ratio' => '5:4',
                        'pixels' => 38720
                ),
                '224x144' => array(
                        'x' => 224,
                        'y' => 144,
                        'ratio' => '14:9',
                        'pixels' => 32256
                ),
                '240x64' => array(
                        'x' => 240,
                        'y' => 64,
                        'ratio' => '15:4',
                        'pixels' => 15360
                ),
                '240x160' => array(
                        'x' => 240,
                        'y' => 160,
                        'ratio' => '3:2',
                        'pixels' => 38400
                ),
                '240x240' => array(
                        'x' => 240,
                        'y' => 240,
                        'ratio' => '1:1',
                        'pixels' => 57600
                ),
                '256x192' => array(
                        'x' => 256,
                        'y' => 192,
                        'ratio' => '4:3',
                        'pixels' => 49152
                ),
                '256x256' => array(
                        'x' => 256,
                        'y' => 256,
                        'ratio' => '1:1',
                        'pixels' => 65536
                ),
                '280x192' => array(
                        'x' => 280,
                        'y' => 192,
                        'ratio' => '35:24',
                        'pixels' => 53760
                ),
                '320x192' => array(
                        'x' => 320,
                        'y' => 192,
                        'ratio' => '5:3',
                        'pixels' => 61440
                ),
                '320x200' => array(
                        'x' => 320,
                        'y' => 200,
                        'ratio' => '8:5',
                        'pixels' => 64000
                ),
                '320x208' => array(
                        'x' => 320,
                        'y' => 208,
                        'ratio' => '20:13',
                        'pixels' => 66560
                ),
                '320x224' => array(
                        'x' => 320,
                        'y' => 224,
                        'ratio' => '10:7',
                        'pixels' => 71680
                ),
                '320x240' => array(
                        'x' => 320,
                        'y' => 240,
                        'ratio' => '4:3',
                        'pixels' => 76800
                ),
                '320x256' => array(
                        'x' => 320,
                        'y' => 256,
                        'ratio' => '5:4',
                        'pixels' => 81920
                ),
                '320x320' => array(
                        'x' => 320,
                        'y' => 320,
                        'ratio' => '1:1',
                        'pixels' => 102400
                ),
                '376x240' => array(
                        'x' => 376,
                        'y' => 240,
                        'ratio' => '47:30',
                        'pixels' => 90240
                ),
                '400x270' => array(
                        'x' => 400,
                        'y' => 270,
                        'ratio' => '40:27',
                        'pixels' => 108000
                ),
                '400x240' => array(
                        'x' => 400,
                        'y' => 240,
                        'ratio' => '5:3',
                        'pixels' => 96000
                ),
                '400x300' => array(
                        'x' => 400,
                        'y' => 300,
                        'ratio' => '4:3',
                        'pixels' => 120000
                ),
                '416x352' => array(
                        'x' => 416,
                        'y' => 352,
                        'ratio' => '13:11',
                        'pixels' => 146432
                ),
                '432x240' => array(
                        'x' => 432,
                        'y' => 240,
                        'ratio' => '9:5',
                        'pixels' => 103680
                ),
                '480x234' => array(
                        'x' => 480,
                        'y' => 234,
                        'ratio' => '80:39',
                        'pixels' => 112320
                ),
                '480x250' => array(
                        'x' => 480,
                        'y' => 250,
                        'ratio' => '48:25',
                        'pixels' => 120000
                ),
                '480x272' => array(
                        'x' => 480,
                        'y' => 272,
                        'ratio' => '30:17',
                        'pixels' => 130560
                ),
                '480x320' => array(
                        'x' => 480,
                        'y' => 320,
                        'ratio' => '3:2',
                        'pixels' => 153600
                ),
                '480x500' => array(
                        'x' => 480,
                        'y' => 500,
                        'ratio' => '24:25',
                        'pixels' => 240000
                ),
                '512x256' => array(
                        'x' => 512,
                        'y' => 256,
                        'ratio' => '2:1',
                        'pixels' => 131072
                ),
                '512x342' => array(
                        'x' => 512,
                        'y' => 342,
                        'ratio' => '256:171',
                        'pixels' => 175104
                ),
                '512x384' => array(
                        'x' => 512,
                        'y' => 384,
                        'ratio' => '4:3',
                        'pixels' => 196608
                ),
                '560x192' => array(
                        'x' => 560,
                        'y' => 192,
                        'ratio' => '35:12',
                        'pixels' => 107520
                ),
                '600x480' => array(
                        'x' => 600,
                        'y' => 480,
                        'ratio' => '5:4',
                        'pixels' => 288000
                ),
                '640x240' => array(
                        'x' => 640,
                        'y' => 240,
                        'ratio' => '8:3',
                        'pixels' => 153600
                ),
                '640x200' => array(
                        'x' => 640,
                        'y' => 200,
                        'ratio' => '16:5',
                        'pixels' => 128000
                ),
                '640x320' => array(
                        'x' => 640,
                        'y' => 320,
                        'ratio' => '2:1',
                        'pixels' => 204800
                ),
                '640x350' => array(
                        'x' => 640,
                        'y' => 350,
                        'ratio' => '64:35',
                        'pixels' => 224000
                ),
                '640x360' => array(
                        'x' => 640,
                        'y' => 360,
                        'ratio' => '16:9',
                        'pixels' => 230400
                ),
                '640x256' => array(
                        'x' => 640,
                        'y' => 256,
                        'ratio' => '5:2',
                        'pixels' => 163840
                ),
                '640x400' => array(
                        'x' => 640,
                        'y' => 400,
                        'ratio' => '8:5',
                        'pixels' => 256000
                ),
                '640x480' => array(
                        'x' => 640,
                        'y' => 480,
                        'ratio' => '4:3',
                        'pixels' => 307200
                ),
                '640x512' => array(
                        'x' => 640,
                        'y' => 512,
                        'ratio' => '5:4',
                        'pixels' => 327680
                ),
                '720x364' => array(
                        'x' => 720,
                        'y' => 364,
                        'ratio' => '180:91',
                        'pixels' => 262080
                ),
                '720x348' => array(
                        'x' => 720,
                        'y' => 348,
                        'ratio' => '60:29',
                        'pixels' => 250560
                ),
                '720x350' => array(
                        'x' => 720,
                        'y' => 350,
                        'ratio' => '72:35',
                        'pixels' => 252000
                ),
                '768x480' => array(
                        'x' => 768,
                        'y' => 480,
                        'ratio' => '8:5',
                        'pixels' => 368640
                ),
                '800x240' => array(
                        'x' => 800,
                        'y' => 240,
                        'ratio' => '10:3',
                        'pixels' => 192000
                ),
                '800x352' => array(
                        'x' => 800,
                        'y' => 352,
                        'ratio' => '25:11',
                        'pixels' => 281600
                ),
                '800x480' => array(
                        'x' => 800,
                        'y' => 480,
                        'ratio' => '5:3',
                        'pixels' => 384000
                ),
                '800x600' => array(
                        'x' => 800,
                        'y' => 600,
                        'ratio' => '4:3',
                        'pixels' => 480000
                ),
                '832x624' => array(
                        'x' => 832,
                        'y' => 624,
                        'ratio' => '4:3',
                        'pixels' => 519168
                ),
                '854x480' => array(
                        'x' => 854,
                        'y' => 480,
                        'ratio' => '427:240',
                        'pixels' => 409920
                ),
                '960x540' => array(
                        'x' => 960,
                        'y' => 540,
                        'ratio' => '16:9',
                        'pixels' => 518400
                ),
                '960x544' => array(
                        'x' => 960,
                        'y' => 544,
                        'ratio' => '30:17',
                        'pixels' => 522240
                ),
                '960x640' => array(
                        'x' => 960,
                        'y' => 640,
                        'ratio' => '3:2',
                        'pixels' => 614400
                ),
                '960x720' => array(
                        'x' => 960,
                        'y' => 720,
                        'ratio' => '4:3',
                        'pixels' => 691200
                ),
                '1024x600' => array(
                        'x' => 1024,
                        'y' => 600,
                        'ratio' => '128:75',
                        'pixels' => 614400
                ),
                '1024x576' => array(
                        'x' => 1024,
                        'y' => 576,
                        'ratio' => '16:9',
                        'pixels' => 589824
                ),
                '1024x640' => array(
                        'x' => 1024,
                        'y' => 640,
                        'ratio' => '8:5',
                        'pixels' => 655360
                ),
                '1024x768' => array(
                        'x' => 1024,
                        'y' => 768,
                        'ratio' => '4:3',
                        'pixels' => 786432
                ),
                '1024x800' => array(
                        'x' => 1024,
                        'y' => 800,
                        'ratio' => '32:25',
                        'pixels' => 819200
                ),
                '1024x1024' => array(
                        'x' => 1024,
                        'y' => 1024,
                        'ratio' => '1:1',
                        'pixels' => 1048576
                ),
                '1120x832' => array(
                        'x' => 1120,
                        'y' => 832,
                        'ratio' => '35:26',
                        'pixels' => 931840
                ),
                '1152x768' => array(
                        'x' => 1152,
                        'y' => 768,
                        'ratio' => '3:2',
                        'pixels' => 884736
                ),
                '1152x720' => array(
                        'x' => 1152,
                        'y' => 720,
                        'ratio' => '8:5',
                        'pixels' => 829440
                ),
                '1152x900' => array(
                        'x' => 1152,
                        'y' => 900,
                        'ratio' => '32:25',
                        'pixels' => 1036800
                ),
                '1152x864' => array(
                        'x' => 1152,
                        'y' => 864,
                        'ratio' => '4:3',
                        'pixels' => 995328
                ),
                '1280x720' => array(
                        'x' => 1280,
                        'y' => 720,
                        'ratio' => '16:9',
                        'pixels' => 921600
                ),
                '1280x800' => array(
                        'x' => 1280,
                        'y' => 800,
                        'ratio' => '8:5',
                        'pixels' => 1024000
                ),
                '1280x768' => array(
                        'x' => 1280,
                        'y' => 768,
                        'ratio' => '5:3',
                        'pixels' => 983040
                ),
                '1280x854' => array(
                        'x' => 1280,
                        'y' => 854,
                        'ratio' => '640:427',
                        'pixels' => 1093120
                ),
                '1280x960' => array(
                        'x' => 1280,
                        'y' => 960,
                        'ratio' => '4:3',
                        'pixels' => 1228800
                ),
                '1280x1024' => array(
                        'x' => 1280,
                        'y' => 1024,
                        'ratio' => '5:4',
                        'pixels' => 1310720
                ),
                '1366x768' => array(
                        'x' => 1366,
                        'y' => 768,
                        'ratio' => '683:384',
                        'pixels' => 1049088
                ),
                '1400x1050' => array(
                        'x' => 1400,
                        'y' => 1050,
                        'ratio' => '4:3',
                        'pixels' => 1470000
                ),
                '1440x960' => array(
                        'x' => 1440,
                        'y' => 960,
                        'ratio' => '3:2',
                        'pixels' => 1382400
                ),
                '1440x900' => array(
                        'x' => 1440,
                        'y' => 900,
                        'ratio' => '8:5',
                        'pixels' => 1296000
                ),
                '1440x1024' => array(
                        'x' => 1440,
                        'y' => 1024,
                        'ratio' => '45:32',
                        'pixels' => 1474560
                ),
                '1440x1080' => array(
                        'x' => 1440,
                        'y' => 1080,
                        'ratio' => '4:3',
                        'pixels' => 1555200
                ),
                '1600x768' => array(
                        'x' => 1600,
                        'y' => 768,
                        'ratio' => '25:12',
                        'pixels' => 1228800
                ),
                '1600x900' => array(
                        'x' => 1600,
                        'y' => 900,
                        'ratio' => '16:9',
                        'pixels' => 1440000
                ),
                '1600x1024' => array(
                        'x' => 1600,
                        'y' => 1024,
                        'ratio' => '25:16',
                        'pixels' => 1638400
                ),
                '1600x1200' => array(
                        'x' => 1600,
                        'y' => 1200,
                        'ratio' => '4:3',
                        'pixels' => 1920000
                ),
                '1680x1050' => array(
                        'x' => 1680,
                        'y' => 1050,
                        'ratio' => '8:5',
                        'pixels' => 1764000
                ),
                '1792x1344' => array(
                        'x' => 1792,
                        'y' => 1344,
                        'ratio' => '4:3',
                        'pixels' => 2408448
                ),
                '1800x1440' => array(
                        'x' => 1800,
                        'y' => 1440,
                        'ratio' => '5:4',
                        'pixels' => 2592000
                ),
                '1856x1392' => array(
                        'x' => 1856,
                        'y' => 1392,
                        'ratio' => '4:3',
                        'pixels' => 2583552
                ),
                '1920x1200' => array(
                        'x' => 1920,
                        'y' => 1200,
                        'ratio' => '8:5',
                        'pixels' => 2304000
                ),
                '1920x1080' => array(
                        'x' => 1920,
                        'y' => 1080,
                        'ratio' => '16:9',
                        'pixels' => 2073600
                ),
                '1920x1400' => array(
                        'x' => 1920,
                        'y' => 1400,
                        'ratio' => '48:35',
                        'pixels' => 2688000
                ),
                '1920x1440' => array(
                        'x' => 1920,
                        'y' => 1440,
                        'ratio' => '4:3',
                        'pixels' => 2764800
                ),
                '2048x1152' => array(
                        'x' => 2048,
                        'y' => 1152,
                        'ratio' => '16:9',
                        'pixels' => 2359296
                ),
                '2048x1280' => array(
                        'x' => 2048,
                        'y' => 1280,
                        'ratio' => '8:5',
                        'pixels' => 2621440
                ),
                '2048x1536' => array(
                        'x' => 2048,
                        'y' => 1536,
                        'ratio' => '4:3',
                        'pixels' => 3145728
                ),
                '2304x1440' => array(
                        'x' => 2304,
                        'y' => 1440,
                        'ratio' => '8:5',
                        'pixels' => 3317760
                ),
                '2304x1728' => array(
                        'x' => 2304,
                        'y' => 1728,
                        'ratio' => '4:3',
                        'pixels' => 3981312
                ),
                '2538x1080' => array(
                        'x' => 2538,
                        'y' => 1080,
                        'ratio' => '2.35:1',
                        'pixels' => 2741040
                ),
                '2560x1080' => array(
                        'x' => 2560,
                        'y' => 1080,
                        'ratio' => '21:9',
                        'pixels' => 2764800
                ),
                '2560x1440' => array(
                        'x' => 2560,
                        'y' => 1440,
                        'ratio' => '16:9',
                        'pixels' => 3686400
                ),
                '2560x1600' => array(
                        'x' => 2560,
                        'y' => 1600,
                        'ratio' => '8:5',
                        'pixels' => 4096000
                ),
                '2560x1920' => array(
                        'x' => 2560,
                        'y' => 1920,
                        'ratio' => '4:3',
                        'pixels' => 4915200
                ),
                '2560x2048' => array(
                        'x' => 2560,
                        'y' => 2048,
                        'ratio' => '5:4',
                        'pixels' => 5242880
                ),
                '2800x2100' => array(
                        'x' => 2800,
                        'y' => 2100,
                        'ratio' => '4:3',
                        'pixels' => 5880000
                ),
                '2880x900' => array(
                        'x' => 2880,
                        'y' => 900,
                        'ratio' => '16:5',
                        'pixels' => 2592000
                ),
                '2880x1800' => array(
                        'x' => 2880,
                        'y' => 1800,
                        'ratio' => '8:5',
                        'pixels' => 5184000
                ),
                '3200x2048' => array(
                        'x' => 3200,
                        'y' => 2048,
                        'ratio' => '25:16',
                        'pixels' => 6553600
                ),
                '3200x2400' => array(
                        'x' => 3200,
                        'y' => 2400,
                        'ratio' => '4:3',
                        'pixels' => 7680000
                ),
                '3840x2160' => array(
                        'x' => 3840,
                        'y' => 2160,
                        'ratio' => '16:9',
                        'pixels' => 8294400
                ),
                '3840x2400' => array(
                        'x' => 3840,
                        'y' => 2400,
                        'ratio' => '8:5',
                        'pixels' => 9216000
                ),
                '4096x2304' => array(
                        'x' => 4096,
                        'y' => 2304,
                        'ratio' => '16:9',
                        'pixels' => 9437184
                ),
                '4096x3072' => array(
                        'x' => 4096,
                        'y' => 3072,
                        'ratio' => '4:3',
                        'pixels' => 12582912
                ),
                '5120x3200' => array(
                        'x' => 5120,
                        'y' => 3200,
                        'ratio' => '8:5',
                        'pixels' => 16384000
                ),
                '5120x4096' => array(
                        'x' => 5120,
                        'y' => 4096,
                        'ratio' => '5:4',
                        'pixels' => 20971520
                ),
                '6400x4096' => array(
                        'x' => 6400,
                        'y' => 4096,
                        'ratio' => '25:16',
                        'pixels' => 26214400
                ),
                '6400x4800' => array(
                        'x' => 6400,
                        'y' => 4800,
                        'ratio' => '4:3',
                        'pixels' => 30720000
                ),
                '7680x4320' => array(
                        'x' => 7680,
                        'y' => 4320,
                        'ratio' => '16:9',
                        'pixels' => 33177600
                ),
                '7680x4800' => array(
                        'x' => 7680,
                        'y' => 4800,
                        'ratio' => '8:5',
                        'pixels' => 36864000
                ),
                '8192x4320' => array(
                        'x' => 8192,
                        'y' => 4320,
                        'ratio' => '256:135',
                        'pixels' => 35389440
                )
           );
           
           return $resolution;
        }
    }
        

    if(!function_exists('visitorOS')){
        function visitorOS(){
            $allos = allOS();
            $c = array();
            foreach($allos as $k=>$os){
                $c[$k] = $os['title'];
            }
            natsort($c);
            return $c;
        }
    }
    
    
    if(!function_exists('visitorBrowser')){
        function visitorBrowser(){
            $allbrw = allBrowsers();
            $c = array();
            foreach($allbrw as $k=>$br){
                $c[$k] = $br['title'];
            }
            natsort($c);
            return $c;
        }
    }
    if(!function_exists('visitorBrowserVersions')){
        function visitorBrowserVersions($browsers){
            $allbrw = allBrowsers();
            $c = array();
            foreach($allbrw as $k=>$br){
                if(in_array($k, $browsers)){
                    foreach($br['versions'] as $vr){
                        $c[$vr] = $br['title'].' '.$vr;
                    }
                    break;
                }
            }
            natsort($c);
            return $c;
        }
    }
    
    if(!function_exists('visitorPlatforms')){
        function visitorPlatforms(){
            $allplt = allPlatforms();
            $c = array();
            foreach($allplt as $plt){                    
                $c[$plt] = $plt;                    
            }
            return $c;
        }
    }
    
    if(!function_exists('visitorResolution')){
        function visitorResolution(){
            $allres = allResolutions();
            $c = array();
            foreach($allres as $k=>$v){                    
                $c[$k] = $k;
            }
            return $c;
        }
    }
?>