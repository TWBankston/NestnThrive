/**
 * NNT Core Admin Metabox Scripts
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        initSortable();
        initPostSelectors();
        initTermSelectors();
        initRemoveButtons();
    });

    /**
     * Initialize sortable for selected items.
     */
    function initSortable() {
        $('.nnt-selected-posts, .nnt-selected-terms').sortable({
            handle: '.nnt-drag-handle',
            placeholder: 'nnt-selected-item ui-sortable-placeholder',
            opacity: 0.8,
            cursor: 'grabbing'
        });
    }

    /**
     * Initialize post selector dropdowns.
     */
    function initPostSelectors() {
        $(document).on('change', '.nnt-post-dropdown', function() {
            var $select = $(this);
            var postId = $select.val();
            
            if (!postId) {
                return;
            }

            var postTitle = $select.find('option:selected').data('title');
            var targetField = $select.data('target');
            var $container = $('#' + targetField + '-selected');

            // Check if already added.
            if ($container.find('[data-id="' + postId + '"]').length > 0) {
                $select.val('');
                return;
            }

            // Add the item.
            var $item = createSelectedItem(postId, postTitle, targetField);
            $container.append($item);

            // Reset dropdown.
            $select.val('');
        });
    }

    /**
     * Initialize term selector dropdowns.
     */
    function initTermSelectors() {
        $(document).on('change', '.nnt-term-dropdown', function() {
            var $select = $(this);
            var termId = $select.val();
            
            if (!termId) {
                return;
            }

            var termName = $select.find('option:selected').data('title');
            var targetField = $select.data('target');
            var $container = $('#' + targetField + '-selected');

            // Check if already added.
            if ($container.find('[data-id="' + termId + '"]').length > 0) {
                $select.val('');
                return;
            }

            // Add the item.
            var $item = createSelectedItem(termId, termName, targetField);
            $container.append($item);

            // Reset dropdown.
            $select.val('');
        });
    }

    /**
     * Initialize remove buttons.
     */
    function initRemoveButtons() {
        $(document).on('click', '.nnt-remove-item', function(e) {
            e.preventDefault();
            $(this).closest('.nnt-selected-item').fadeOut(200, function() {
                $(this).remove();
            });
        });
    }

    /**
     * Create a selected item element.
     *
     * @param {string} id       Item ID.
     * @param {string} title    Item title.
     * @param {string} field    Field name.
     * @return {jQuery}
     */
    function createSelectedItem(id, title, field) {
        var html = '<div class="nnt-selected-item" data-id="' + id + '">' +
            '<span class="nnt-drag-handle">☰</span>' +
            '<span class="nnt-item-title">' + escapeHtml(title) + '</span>' +
            '<button type="button" class="nnt-remove-item button-link">&times;</button>' +
            '<input type="hidden" name="' + field + '[]" value="' + id + '" />' +
            '</div>';
        
        return $(html);
    }

    /**
     * Escape HTML entities.
     *
     * @param {string} text Text to escape.
     * @return {string}
     */
    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

})(jQuery);

