"use strict";
// Class definition

var KTSummernoteDemo = function () {
    // Private functions
    var demos = function () {
        $('.summernote').summernote({
            height: 400,
            tabsize: 2
        });
    }
    var demos1 = function () {
        $('.about').summernote({
            height: 300,
            tabsize: 2
        });
        $('.ourstory').summernote({
            height: 300,
            tabsize: 2
        });
        $('.description').summernote({
            height: 300,
            tabsize: 2
        });
        $('.privacy').summernote({
            height: 300,
            tabsize: 2
        });
        $('.terms').summernote({
            height: 300,
            tabsize: 2
        });
        $('.return').summernote({
            height: 300,
            tabsize: 2
        });
         $('.shipping').summernote({
            height: 300,
            tabsize: 2
        });

    }

    return {
        // public functions
        init: function() {
            demos();
            demos1();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSummernoteDemo.init();
});
