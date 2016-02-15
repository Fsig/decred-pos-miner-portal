/*
 *      WindowWidth
 *      WindowHeight
 *      ArticleWidth
 *      ContentMargin
 *      MaintainVideoAspectRatios
 *      ReturnYoutubeVideoID
 *      ReplaceSvgWithPng
 *      EqualHeightGroup
 *      SlideUp
 *      SlideDown
*/

var Utils = (function() {

    return {

        WindowWidth: function() {
            var windowWidth = $(window).innerWidth();
            return windowWidth;
        },

        WindowHeight: function() {
            var windowHeight = $(window).innerWidth();
            return windowHeight;
        },

        // Maintains the aspect ratio of elements on the page
        //  - Element MUST HAVE width/height attributes to begin with.
        //  - Likely works best if element has a wrapping element.
        //  - Does not work within Fancybox.
        //    - Want it to? Do this:
        //      $(".fancybox").fancybox({
        //          helpers : { media: true },
        //          width       : 800,
        //          height      : 450,
        //          aspectRatio : true,
        //          scrolling   : 'no'
        //      });
        //
        MaintainAspectRatio: function(element) {
            var allElements = $(element),
                fluidEl = allElements.parent(); // The element that is fluid width

            // Figure out and save aspect ratio for each element
            allElements.each(function() {
              $(this)
                .data("aspectRatio", this.height / this.width)
                // and remove the hard coded width/height
                .removeAttr("height")
                .removeAttr("width");
            });

            // When the window is resized
            $(window).resize(function() {
              var newWidth = fluidEl.width();

              // Resize all elements according to their own aspect ratio
              allElements.each(function() {
                var el = $(this);
                el
                  .width(newWidth)
                  .height(newWidth * el.data("aspectRatio"));
              });

            // Kick off one resize to fix all elements on page load
            }).resize();
        },

        // Returns a YouTube video's ID - video element (selector string) can be a link or an iframe
        ReturnYoutubeVideoID: function(video) {

            var url = $(video).is("iframe") ? $(video).attr("src") : $(video).is("a") ? $(video).attr("href") : "",
                regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
                match = url.match(regExp);

            if (match && match[2].length == 11) {
              return match[2];
            }

            else { return "ReturnYoutubeVideoID failed."; }

        },

        // Check folder paths are correct
        ReplaceSvgWithPng: function() {
            if (!Modernizr.svg || MediaQueries.IsAndroidNativeBrowser()) {
                $("img[src$='.svg']").each( function() {
                    $(this).attr("src", $(this).attr("src").replace(".svg",".png").replace("/svg/","/png/"));
                });
            } 
        },

        // Placeholders in IE8 - Removed (for the meantime) because there are more sophisticated polyfills online
        // github.com/Modernizr/Modernizr/wiki/HTML5-Cross-Browser-Polyfills#web-forms--input-placeholder

        // Sets a group of elements to the same height
        // e.g. There are several <div class="panel"> elements,
        //      Utils.EqualiseHeights(".panel") will make each
        //      the same height.
        EqualiseHeights : function (element)
        {
            tallest = 0;
            element.each(function() {
                thisHeight = $(this).height();
                if(thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            element.height(tallest);
        },

        // This replaces jQuery's slideUp method.
        // Uses ".visually-hidden" class to hide
        // elements instead of display:none; so
        // they're stil visible to screen readers.
        SlideUp: function(selector) {
            selector.slideUp("fast",function() {
                selector.addClass("visually-hidden")
                    .slideDown(0);
            });
        },

        // This replaces jQuery's slideDown method.
        // Uses ".visually-hidden" class to hide
        // elements instead of display:none; so
        // they're stil visible to screen readers.
        SlideDown: function(selector) {
            selector.slideUp(0,function() {
                selector.removeClass("visually-hidden")
                    .slideDown("fast");
            });
        }

    }
})();