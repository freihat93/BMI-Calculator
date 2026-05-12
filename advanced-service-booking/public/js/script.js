jQuery(document).ready(function($) {
    let selections = { tab_id: null, package: null, services: [] };

    $('.asb-tab').on('click', function() {
        $('.asb-tab').removeClass('active');
        $(this).addClass('active');
        let tabId = $(this).data('id');
        loadServices(tabId);
    });

    function loadServices(tabId) {
        $.post(asb_vars.ajax_url, {
            action: 'asb_get_services',
            nonce: asb_vars.nonce,
            tab_id: tabId
        }, function(res) {
            if (res.success) {
                $('#asb-services-container').html(res.data.html);
            }
        });
    }

    $(document).on('click', '.asb-package', function() {
        $('.asb-package').removeClass('selected');
        $(this).addClass('selected');
        selections.package = { id: $(this).data('id'), title: $(this).find('h3').text(), price: $(this).data('price') };
        updateSummary();
    });

    function updateSummary() {
        let html = '<h4>Summary</h4>';
        if (selections.package) {
            html += '<p>' + selections.package.title + ': $' + selections.package.price + '</p>';
        }
        $('#asb-summary-content').html(html);
    }

    $('#asb-form').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serialize() + '&action=asb_submit_request&nonce=' + asb_vars.nonce + '&total_price=' + (selections.package ? selections.package.price : 0);
        $.post(asb_vars.ajax_url, data, function(res) {
            alert(res.data.message);
        });
    });
});
