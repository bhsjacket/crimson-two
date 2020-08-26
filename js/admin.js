/*
AFTER TRANSFER:
- update variables below
*/

var subtitleField = '#acf-field_5efe67523339d';
var metadataGroup = '#acf-group_5efe5dd83e721';

var imageField = '.acf-field-5efb8a04328ea';
var imageCaptionField = '#acf-field_5efb8a30328eb';
var imageCreditField = '#acf-field_5efb8aa4328ec';
var imageGroup = '#acf-group_5eed449ab6a52';

var inputMax;
var inputLength;
var limitText;

wp.domReady(function(){
    wp.blocks.unregisterBlockStyle('core/quote', 'large'); // Remove Large Quote Style
    // Prevent Fullscreen Editor by Default
    const isFullscreenMode = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');
    if(isFullscreenMode) {
        wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
    }

    // Change 'Add title' to 'Add headline'
    jQuery('.editor-post-title__input').attr('placeholder', 'Add headline');

    // Add WYSIWYG subtitle
    var subtitleText = jQuery(subtitleField).val();
    var subtitleHTML = '<h2 class="editor-subtitle" contenteditable="plaintext-only">' + subtitleText + '</h2>';
    jQuery('.wp-block.editor-post-title__block').append(subtitleHTML);
    
    // Change WYSIWYG subtitle when field changes
    jQuery(subtitleField).keyup(function(){
        subtitleText = jQuery(subtitleField).val();
        jQuery('.editor-subtitle').text(subtitleText);
    });

    // Change field when WYSIWYG contenteditable changes
    jQuery('.editor-subtitle').keyup(function(){
        subtitleText = jQuery(this).text();
        jQuery(subtitleField).val(subtitleText);
    });

    // Prevent new lines in WYSIWYG subheadline
    jQuery('.editor-subtitle').keypress(function(event){
        return event.key != 'Enter'; // Any key that is not the enter key
    })

    // Open subtitle field on shift click
    jQuery(document).on('click', '.editor-subtitle', function(event){
        if(event.shiftKey) {
            if( !jQuery('button[aria-label="Settings"]').hasClass('is-pressed') ) {
                jQuery('button[aria-label="Settings"]').click(); // Open sidebar
            }
            if( jQuery(metadataGroup).hasClass('closed') ) {
                jQuery(metadataGroup + ' > button').click(); // Open field group
            }
            jQuery(subtitleField).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100); // Flash field
            jQuery(subtitleField).focus(); // Focus field
        }
    });

    // Add WYSIWYG featured image
    var imageUrl = jQuery(imageField + ' img[data-name="image"]').attr('src');
    var imageCaption = jQuery(imageCaptionField).val();
    var imageCredit = jQuery(imageCreditField).val();
    var imageHTML = '<div class="editor-image"><img class="featured-image" src="' + imageUrl + '"><div class="caption-group"><p class="caption-content">' + imageCaption + '</p><p class="caption-credit">' + imageCredit + '</p></div></div>';
    jQuery('.wp-block.editor-post-title__block').append(imageHTML);
    if( !jQuery(imageField + ' .acf-image-uploader').hasClass('has-value') ) {
        jQuery('.caption-group').hide();
    }

    // Change WYSIWYG caption when field changes
    jQuery(imageCaptionField).keyup(function(){
        imageCaption = jQuery(imageCaptionField).val();
        jQuery('.caption-content').text(imageCaption);
    });
    // Change WYSIWYG credit when field changes
    jQuery(imageCreditField).keyup(function(){
        imageCredit = jQuery(imageCreditField).val();
        jQuery('.caption-credit').text(imageCredit);
    });
    // Change WYSIWYG image when image field changes
    jQuery(imageField + ' img[data-name="image"]').on('load', function(){
        imageUrl = jQuery(imageField + ' img[data-name="image"]').attr('src');
        jQuery('.featured-image').attr('src', imageUrl);
        jQuery('.caption-group').show();
    });
    // Remove WYSIWYG image when image is removed
    jQuery(document).on('click', imageField + ' [data-name="remove"]', function(){
        jQuery('.featured-image').attr('src', '');
        jQuery('.caption-group').hide();
    });

    // Update excerpt character limit
    function excerptCharacterLimit() {
        inputMax = jQuery('[data-name="homepage_excerpt"] textarea').attr('maxlength');
        inputLength = jQuery('[data-name="homepage_excerpt"] textarea').val().length;
        limitText = inputLength + '/' + inputMax;
        jQuery('[data-name="homepage_excerpt"] label').text('Excerpt (' + inputLength + '/' + inputMax + ')');
        if( inputMax == inputLength ) {
            jQuery('[data-name="homepage_excerpt"] label').css('color', '#800000');
        } else {
            jQuery('[data-name="homepage_excerpt"] label').removeAttr('style');
        }
    }
    excerptCharacterLimit();
    jQuery('[data-name="homepage_excerpt"] textarea').keyup(function(){ excerptCharacterLimit(); });

    // Update social copy character limit
    function socialCopyCharacterLimit() {
        inputMax = jQuery('[data-name="social_copy"] textarea').attr('maxlength');
        inputLength = jQuery('[data-name="social_copy"] textarea').val().length;
        limitText = inputLength + '/' + inputMax;
        jQuery('[data-name="social_copy"] label').text('Social Copy (' + inputLength + '/' + inputMax + ')');
        if( inputMax == inputLength ) {
            jQuery('[data-name="social_copy"] label').css('color', '#800000');
        } else {
            jQuery('[data-name="social_copy"] label').removeAttr('style');
        }
    }
    socialCopyCharacterLimit();
    jQuery('[data-name="social_copy"] textarea').keyup(function(){ socialCopyCharacterLimit(); });

});

// Open image panel on click
jQuery(document).on('click', '.editor-image', function(){
    if( !jQuery('button[aria-label="Settings"]').hasClass('is-pressed') ) {
        jQuery('button[aria-label="Settings"]').click(); // Open sidebar
    }
    if( jQuery(imageGroup).hasClass('closed') ) {
        jQuery(imageGroup + ' > button').click(); // Open field group
    }
})

// Remove Editor Panels (https://developer.wordpress.org/block-editor/components/panel/)
wp.data.dispatch('core/edit-post').removeEditorPanel('post-status'); // Status and Visibility
wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-category'); // Categories
wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-issue'); // Issue Taxonomy
wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-post_tag'); // Tags
wp.data.dispatch('core/edit-post').removeEditorPanel('featured-image'); // Featured Image
wp.data.dispatch('core/edit-post').removeEditorPanel('post-excerpt'); // Excerpt
wp.data.dispatch('core/edit-post').removeEditorPanel('post-link'); // Permalink
wp.data.dispatch('core/edit-post').removeEditorPanel('page-attributes'); // Page Attributes
wp.data.dispatch('core/edit-post').removeEditorPanel('discussion-panel'); // Comments