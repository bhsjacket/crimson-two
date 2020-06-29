wp.domReady(function(){
    wp.blocks.unregisterBlockStyle('core/quote', 'large'); // Remove Large Quote Style
    // Prevent Fullscreen Viewwr
    const isFullscreenMode = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');
    if(isFullscreenMode) {
        wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
    }
});

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