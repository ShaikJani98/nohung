if (typeof jQuery === 'undefined') {
    throw new Error('bootstrap-imageupload\'s JavaScript requires jQuery.');
}

(function($) {
    'use strict';

    var options = {};

    var methods = {
        init: init,
        disable: disable,
        enable: enable,
        reset: reset
    };

    // -----------------------------------------------------------------------------
    // Plugin Definition
    // -----------------------------------------------------------------------------

    $.fn.imageupload = function(methodOrOptions) {
        var givenArguments = arguments;

        return this.filter('div').each(function() {
            if (methods[methodOrOptions]) {
                methods[methodOrOptions].apply($(this), Array.prototype.slice.call(givenArguments, 1));
            }
            else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
                methods.init.apply($(this), givenArguments);
            }
            else {
                throw new Error('Method "' + methodOrOptions + '" is not defined for imageupload.');
            }
        });
    };

    $.fn.imageupload.defaultOptions = {
        allowedFormats: [ 'jpg', 'jpeg', 'png'],
        maxWidth: 150,
        maxHeight: 150,
        /*maxFileSizeKb: 2048*/
    };

    // -----------------------------------------------------------------------------
    // Public Methods
    // -----------------------------------------------------------------------------

    function init(givenOptions) {
        options = $.extend({}, $.fn.imageupload.defaultOptions, givenOptions);

        var $imageupload = this;
        var $fileTab = $imageupload.find('.file-tab');
        var $fileTabButton = $imageupload.find('.panel-heading .btn:eq(0)');
        var $browseFileButton = $fileTab.find('input[type="file"]');
        var $removeFileButton = $fileTab.find('.btn:eq(1)');
        var $urlTab = $imageupload.find('.url-tab');
        var $urlTabButton = $imageupload.find('.panel-heading .btn:eq(1)');
        var $submitUrlButton = $urlTab.find('.btn:eq(0)');
        var $removeUrlButton = $urlTab.find('.btn:eq(1)');

        // Do a complete reset.
        resetFileTab($fileTab,givenOptions['url'],givenOptions['type']);
        resetUrlTab($urlTab);
        showFileTab($fileTab);
        enable.call($imageupload);
        
        // Unbind all previous bound event handlers.
        $fileTabButton.off();
        $browseFileButton.off();
        $removeFileButton.off();
        $urlTabButton.off();
        $submitUrlButton.off();
        $removeUrlButton.off();

        $fileTabButton.on('click', function() {
            $(this).blur();
            showFileTab($fileTab);
        });

        $browseFileButton.on('change', function() {
            $(this).blur();
           
            submitImageFile($fileTab);
        });

        $removeFileButton.on('click', function() {
            $(this).blur();
            resetFileTab($fileTab,givenOptions['url']);
        });

        $urlTabButton.on('click', function() {
            $(this).blur();
            showUrlTab($urlTab);
        });

        $submitUrlButton.on('click', function() {
            $(this).blur();
            submitImageUrl($urlTab);
        });

        $removeUrlButton.on('click', function() {
            $(this).blur();
            resetUrlTab($urlTab);
        });
    }

    function disable() {
        var $imageupload = this;
        $imageupload.addClass('imageupload-disabled');
    }

    function enable() {
        var $imageupload = this;
        $imageupload.removeClass('imageupload-disabled');
    }

    function reset() {
        var $imageupload = this;
        init.call($imageupload, options);
    }

    // -----------------------------------------------------------------------------
    // Private Methods
    // -----------------------------------------------------------------------------

    function getAlertHtml(message) {
        var html = [];
        html.push('<div class="alert alert-danger alert-dismissible">');
        html.push('<button type="button" class="close" data-dismiss="alert">');
        html.push('<span>&times;</span>');
        html.push('</button>' + message);
        html.push('</div>');
        return html.join('');
    }

    function getImageThumbnailHtml(src) {
        return '<img src="' + src + '" alt="Image preview" class="thumbnail" style="max-width: ' + options.maxWidth + 'px; max-height: ' + options.maxHeight + 'px">';
    }

    function getFileExtension(path) {
        return path.substr(path.lastIndexOf('.') + 1).toLowerCase();
    }
    function formatBytes(bytes) {
        if(bytes < 1024) return bytes + "Bytes";
        else if(bytes < 1048576) return parseInt(bytes / 1024) + "KB";
        else if(bytes < 1073741824) return parseInt(bytes / 1048576) + "MB";
        else return parseInt(bytes / 1073741824) + "GB";
    }
    function isValidImageFile(file, callback) {
        // Check file size.
        if (file.size > options.maxFileSizeKb)
        {
            callback(false, 'File is too large (max size ' + formatBytes(options.maxFileSizeKb)+').');
            return;
        }
        // Check image format by file extension.
        var fileExtension = getFileExtension(file.name);
        if ($.inArray(fileExtension, options.allowedFormats) > -1) {
            callback(true, 'Image file is valid.');
        }
        else {
            callback(false, 'File type is not allowed.');
        }
    }

    function isValidImageUrl(url, callback) {
        var timer = null;
        var timeoutMs = 3000;
        var timeout = false;
        var image = new Image();

        image.onload = function() {
            if (!timeout) {
                window.clearTimeout(timer);

                // Strip querystring (and fragment) from URL.
                var tempUrl = url;
                if (tempUrl.indexOf('?') !== -1) {
                    tempUrl = tempUrl.split('?')[0].split('#')[0];
                }

                // Check image format by file extension.
                var fileExtension = getFileExtension(tempUrl);
                if ($.inArray(fileExtension, options.allowedFormats) > -1) {
                    callback(true, 'Image URL is valid.');
                }
                else {
                    callback(false, 'File type is not allowed.');
                }
            }
        };

        image.onerror = function() {
            if (!timeout) {
                window.clearTimeout(timer);
                callback(false, 'Image could not be found.');
            }
        };

        image.src = url;

        // Abort if image takes longer than 3000ms to load.
        timer = window.setTimeout(function() {
            timeout = true;
            image.src = '???'; // Trigger error to stop loading.
            callback(false, 'Loading image timed out.');
        }, timeoutMs);
    }

    function showFileTab($fileTab) {
        var $imageupload = $fileTab.closest('.imageupload');
        var $fileTabButton = $imageupload.find('.panel-heading .btn:eq(0)');

        if (!$fileTabButton.hasClass('active')) {
            var $urlTab = $imageupload.find('.url-tab');

            // Change active tab buttton.
            $imageupload.find('.panel-heading .btn:eq(1)').removeClass('active');
            $fileTabButton.addClass('active');

            // Hide URL tab and show file tab.
            $urlTab.hide();
            $fileTab.show();
            resetUrlTab($urlTab);
        }
    }

    function resetFileTab($fileTab,url,type) {

        if(type=='1'){
            $fileTab.find('.alert').remove();
            $fileTab.find('.btn span').text('Change');
            $fileTab.find('.btn:eq(1)').show();
        }else if(type=='2'){
            $fileTab.find('.alert').remove();
            $fileTab.find('.btn:eq(0)').hide();
        }else if(type=='3'){ // set default male image
            $fileTab.find('.alert').remove();
            $fileTab.find('.btn:eq(0)').hide();
            $fileTab.find('img').attr('src',url+'../assets/image/userprofile/Male-Avatar.png');
        }else if(type=='4'){ // set default female image
            $fileTab.find('.alert').remove();
            $fileTab.find('.btn:eq(0)').hide();
            $fileTab.find('img').attr('src',url+'../assets/image/userprofile/Female-Avatar.png');
        }else{
            $fileTab.find('.alert').remove();
            $fileTab.find('img').attr('src',url+'../assets/image/noimage.jpg');
            $fileTab.find('.btn:eq(0)').show();
            $fileTab.find('.btn span').text('Select Image');
            $fileTab.find('.btn:eq(1)').hide();
            $fileTab.find('input').val('');
        }
        
    }

    function submitImageFile($fileTab) {
        var $browseFileButton = $fileTab.find('.btn:eq(0)');
        var $removeFileButton = $fileTab.find('.btn:eq(1)');
        var $fileInput = $browseFileButton.find('input');
        //$browseFileButton.css({"background-color":"#FFF","border":"1px solid #D2D2D2"});
        //$browseFileButton.css({"font-size":"15px"});
       

        // Check if file was uploaded.
        if (!($fileInput[0].files && $fileInput[0].files[0])) {
            return;
        }

        $fileTab.find('.alert').remove();
        $fileTab.find('img').remove();
        $browseFileButton.find('span').text('Select Image');
        $removeFileButton.hide();

        $browseFileButton.prop('disabled', true);
        
        var file = $fileInput[0].files[0];

        isValidImageFile(file, function(isValid, message) {
            if (isValid) {
                var fileReader = new FileReader();

                fileReader.onload = function(e) {
                    // Show thumbnail and remove button.
                    $fileTab.prepend(getImageThumbnailHtml(e.target.result));
                    $browseFileButton.find('span').text('Change');
                    $removeFileButton.css('display', 'inline-block');
                };

                fileReader.onerror = function() {
                    $fileTab.prepend(getAlertHtml('Error loading image file.'));
                    $fileInput.val('');
                };

                fileReader.readAsDataURL(file);
            }
            else {
                $fileTab.prepend(getAlertHtml(message));
                $browseFileButton.find('span').text('Select Image');
                $fileInput.val('');
            }

            $browseFileButton.prop('disabled', false);
        });
    }

    function showUrlTab($urlTab) {
        var $imageupload = $urlTab.closest('.imageupload');
        var $urlTabButton = $imageupload.find('.panel-heading .btn:eq(1)');

        if (!$urlTabButton.hasClass('active')) {
            var $fileTab = $imageupload.find('.file-tab');

            // Change active tab button.
            $imageupload.find('.panel-heading .btn:eq(0)').removeClass('active');
            $urlTabButton.addClass('active');

            // Hide file tab and show URL tab.
            $fileTab.hide();
            $urlTab.show();
            resetFileTab($fileTab);
        }
    }

    function resetUrlTab($urlTab) {
        $urlTab.find('.alert').remove();
        //$urlTab.find('img').remove();
        $urlTab.find('.btn:eq(1)').hide();
        $urlTab.find('input').val('');
    }

    function submitImageUrl($urlTab) {
        var $urlInput = $urlTab.find('input[type="text"]');
        var $submitUrlButton = $urlTab.find('.btn:eq(0)');
        var $removeUrlButton = $urlTab.find('.btn:eq(1)');

        $urlTab.find('.alert').remove();
        //$urlTab.find('img').remove();
        $removeUrlButton.hide();

        var url = $urlInput.val();
        if (!url) {
            $urlTab.prepend(getAlertHtml('Please enter an image URL.'));
            return;
        }

        $urlInput.prop('disabled', true);
        $submitUrlButton.prop('disabled', true);
        
        isValidImageUrl(url, function(isValid, message) {
            if (isValid) {
                // Submit URL value.
                $urlTab.find('input[type="hidden"]').val(url);

                // Show thumbnail and remove button.
                $(getImageThumbnailHtml(url)).insertAfter($submitUrlButton.closest('.input-group'));
                $removeUrlButton.css('display', 'inline-block');
            }
            else {
                $urlTab.prepend(getAlertHtml(message));
            }

            $urlInput.prop('disabled', false);
            $submitUrlButton.prop('disabled', false);
        });
    }
}(jQuery));
