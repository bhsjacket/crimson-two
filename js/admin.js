var subtitleField = '#acf-field_5efe67523339d';
var subtitleGroup = '#acf-group_5efe5dd83e721';

wp.domReady(function(){
    wp.blocks.unregisterBlockStyle('core/quote', 'large'); // Remove Large Quote Style
    // Prevent Fullscreen Editor by Default
    const isFullscreenMode = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');
    if(isFullscreenMode) {
        wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
    }

    // Add WYSIWYG subtitle
    var subtitleText = jQuery(subtitleField).val();
    var subtitleHTML = '<h2 class="editor-subtitle">' + subtitleText + '</h2>';
    jQuery('.wp-block.editor-post-title__block').append(subtitleHTML);

    // Change WYSIWYG subtitle when field changes
    jQuery(subtitleField).keyup(function(){
        subtitleText = jQuery(subtitleField).val();
        jQuery('.editor-subtitle').text(subtitleText);
    });

    setTimeout(function(){
        jQuery('.editor-post-title__input').trigger('click'); // Fix title spacing (sometimes works)
    }, 200)

});

jQuery(document).on('click', '.editor-subtitle', function(){
    if( !jQuery('button[aria-label="Settings"]').hasClass('is-pressed') ) {
        jQuery('button[aria-label="Settings"]').click(); // Open sidebar
    }
    if( jQuery(subtitleGroup).hasClass('closed') ) {
        jQuery(subtitleGroup + ' > button').click(); // Open field group
    }
    jQuery(subtitleField).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100); // Flash field
    jQuery(subtitleField).focus(); // Focus field
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