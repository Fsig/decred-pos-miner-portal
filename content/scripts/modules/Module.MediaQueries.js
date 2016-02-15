/*
 *  IsAndroidMobile
 *  IsAndroidNativeBrowser
 *  MinWidth
 *  MaxWidth
 *  DeviceOrientation
 *  DetectFirefox
*/

// Maybe base64 icons? PNG fallbacks?

var MediaQueries = (function() {

    // User Agent
    var navU = navigator.userAgent;

    return {

        // Checks if were were at a breakpoint before resize, then checks what breakpoint we're at after resize
        // See scripts.js for initialisation.
        WasIs: function(options){

            var settings = $.extend({
                    wasMinWidth: null,
                    isMinWidth: null,
                    wasMaxWidth: null,
                    isMaxWidth: null,
                    ifTrueDo: null,
                    ifFalseDo: null
                }, options );

            var previousWidth = undefined,
                currentWidth = Utils.WindowWidth(),

                // was/isMin/MaxWidth get set to true or false
                wasMinWidth = null,
                isMinWidth = null,
                wasMaxWidth = null,
                isMaxWidth = null,

                // propertiesToCheck gets given defined was/isMin/MaxWidth properties and their true/false values
                propertiesToCheck = {};

            $(window).smartresize(function() {

                // Check if the wasMin/MaxWidth properties are true

                // was: MinWidth
                if (settings.wasMinWidth !== null && settings.wasMinWidth !== undefined) {
                    wasMinWidth = previousWidth > parseInt(settings.wasMinWidth);
                    propertiesToCheck.wasMinWidth = wasMinWidth;
                }

                // was: MaxWidth
                if (settings.wasMaxWidth !== null && settings.wasMaxWidth !== undefined) {
                    wasMaxWidth = previousWidth < parseInt(settings.wasMaxWidth);
                    propertiesToCheck.wasMaxWidth = wasMaxWidth;
                }

                // Set the current width before we detect if the isMin/MaxWidth properties are true
                currentWidth = Utils.WindowWidth();

                // is: MinWidth
                if (settings.isMinWidth !== null && settings.isMinWidth !== undefined) {
                    isMinWidth = currentWidth > parseInt(settings.isMinWidth);
                    propertiesToCheck.isMinWidth = isMinWidth;
                }

                // is: MaxWidth
                if (settings.isMaxWidth !== null && settings.isMaxWidth !== undefined) {
                    isMaxWidth = currentWidth < parseInt(settings.isMaxWidth);
                    propertiesToCheck.isMaxWidth = isMaxWidth;
                }

                // Number of properties & number of true values get counted
                var propertiesToCheckCount = 0,
                    propertiesToCheckTrueCount = 0

                for (property in propertiesToCheck) {
                    propertiesToCheckCount++;
                    if (propertiesToCheck[property] === true) propertiesToCheckTrueCount++;
                }

                // If there are as many true values as there are properties, we run the ifTrueDo function
                if (propertiesToCheckCount === propertiesToCheckTrueCount) {
                    if (settings.ifTrueDo !== null
                        && settings.ifTrueDo !== undefined
                        && typeof(settings.ifTrueDo) === "function") {
                        settings.ifTrueDo.call(this);
                    }
                }
                // Otherwise we run the ifFalseDo function
                else {
                    if (settings.ifFalseDo !== null
                        && settings.ifFalseDo !== undefined
                        && typeof(settings.ifFalseDo) === "function") {
                        settings.ifFalseDo.call(this);
                    }
                }

                // Set the previousWidth property when we're done resizing
                previousWidth = Utils.WindowWidth();

            }).resize();

        },


        IsAndroidMobile: function() {
            return navU.indexOf('Android') > -1 && navU.indexOf('Mozilla/5.0') > -1 && navU.indexOf('AppleWebKit') > -1;
        },

        IsAndroidNativeBrowser: function() {
            var regExAppleWebKit = new RegExp(/AppleWebKit\/([\d.]+)/),
                resultAppleWebKitRegEx = regExAppleWebKit.exec(navU),
                appleWebKitVersion = (resultAppleWebKitRegEx === null ? null : parseFloat(regExAppleWebKit.exec(navU)[1]));

            return this.IsAndroidMobile() && appleWebKitVersion !== null && appleWebKitVersion < 537;
        },

        MinWidth: function(minWidthValue) {
            if (Modernizr.mq != undefined) {
                if (Modernizr.mq('only screen and (min-width: ' + minWidthValue + ')')){
                    return true;
                }  
                else {
                    return false;
                }
            }
            else { return "\"Media Queries\" is not an included detect in your Modernizr build."; }
        },

        MaxWidth: function(maxWidthValue) {
            if (Modernizr.mq != undefined) {
                if (Modernizr.mq('only screen and (max-width: ' + maxWidthValue + ')')){
                    return true;
                }  
                else {
                    return false;
                }
            }
            else { return "\"Media Queries\" is not an included detect in your Modernizr build."; }
        },

        DeviceOrientation: function() {
            if (Modernizr.mq != undefined) {
                if (Modernizr.mq('only screen and (orientation:portrait)')) {
                    return "portrait";
                }
                else if (Modernizr.mq('only screen and (orientation:landscape)')) {
                    return "landscape";
                }
                else { return null; }
            }
            else { return "\"Media Queries\" is not an included detect in your Modernizr build."; }
        },

        DetectFirefox: function() {
            Modernizr.addTest('firefox', function () {
                return !!navigator.userAgent.match(/firefox/i);
            });
        },

        // Adds user agent (lets us detect IE10 and style through CSS)
        AddUserAgentAsClass: function() {
            var doc = document.documentElement;
            doc.setAttribute('data-useragent', navigator.userAgent);  
        },

        // Loads fastclick.js if we're on a touch device
        FastClickInit: function() {
            Modernizr.load({
                test: Modernizr.touch,
                yep : 'Scripts/vendor/fastclick.js',
                nope: null,
                complete: function() {
                    if (Modernizr.touch) {
                        $(function() {
                            FastClick.attach(document.body);
                        });
                    }
                }
            });
        }

    }

})();
