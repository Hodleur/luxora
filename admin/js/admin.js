(function($) {
    'use strict';

    $(document).ready(function() {
        // Gérer la fermeture des notices
        $('.notice-dismiss').on('click', function() {
            var notice = $(this).closest('.notice');
            var noticeId = notice.attr('id');

            if (noticeId) {
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'luxora_dismiss_notice',
                        notice_id: noticeId,
                        nonce: luxoraAdmin.nonce
                    }
                });
            }
        });

        // Animation des éléments de la page À propos
        $('.feature-item').each(function(index) {
            $(this).delay(index * 100).fadeIn(500);
        });
    });
})(jQuery); 