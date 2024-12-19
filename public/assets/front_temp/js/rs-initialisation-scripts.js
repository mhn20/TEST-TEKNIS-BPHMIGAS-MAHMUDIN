var tpj = jQuery;

var revapi10;

if (window.RS_MODULES === undefined) 
    window.RS_MODULES = {};
if (RS_MODULES.modules === undefined) 
    RS_MODULES.modules = {};
RS_MODULES.modules["revslider101"] = {
    once: RS_MODULES.modules["revslider101"] !== undefined
        ? RS_MODULES
            .modules["revslider101"]
            .once
        : undefined,
    init: function () {
        window.revapi10 = window.revapi10 === undefined || window.revapi10 === null || window.revapi10.length === 0
            ? document.getElementById("rev_slider_10_1")
            : window.revapi10;
        if (window.revapi10 === null || window.revapi10 === undefined || window.revapi10.length == 0) {
            window.revapi10initTry = window.revapi10initTry === undefined
                ? 0
                : window.revapi10initTry + 1;
            if (window.revapi10initTry < 20) 
                requestAnimationFrame(function () {
                    RS_MODULES
                        .modules["revslider101"]
                        .init()
                });
            return;
        }
        window.revapi10 = jQuery(window.revapi10);
        if (window.revapi10.revolution == undefined) {
            revslider_showDoubleJqueryError("rev_slider_10_1");
            return;
        }
        revapi10.revolutionInit({
            revapi: "revapi10",
            DPR: "dpr",
            sliderLayout: "fullscreen",
            visibilityLevels: "1240,1460,785,500",
            gridwidth: "1920,1440,778,480",
            gridheight: "860,700,580,480",
            minHeight: "480px",
            hideLayerAtLimit: 1281,
            lazyType: "smart",
            perspective: 600,
            perspectiveType: "global",
            editorheight: "860,700,580,480",
            responsiveLevels: "1240,1460,785,500",
            progressBar: {
                disableProgressBar: true
            },
            navigation: {
                wheelCallDelay: 1000,
                onHoverStop: false,
                touch: {
                    touchenabled: true,
                    touchOnDesktop: true
                },
                arrows: {
                    enable: true,
                    style: "eagle_claws",
                    hide_onmobile: true,
                    hide_under: "1280px",
                    animSpeed: "500ms",
                    animDelay: "500ms",
                    left: {
                        anim: "left",
                        h_offset: 70
                    },
                    right: {
                        anim: "right",
                        h_offset: 70
                    }
                }
            },
            parallax: {
                levels: [
                    1,
                    2,
                    3,
                    4,
                    5,
                    6,
                    7,
                    8,
                    9,
                    10,
                    12,
                    15,
                    17,
                    20,
                    25,
                    30
                ],
                type: "mouse",
                origo: "slidercenter",
                speed: 0
            },
            viewPort: {
                global: true,
                globalDist: "-200px",
                enable: false
            },
            fallbacks: {
                allowHTML5AutoPlayOnAndroid: true
            }
        });

    }
} // End of RevInitScript

if (window.RS_MODULES.checkMinimal !== undefined) {
    window
        .RS_MODULES
        .checkMinimal();
};