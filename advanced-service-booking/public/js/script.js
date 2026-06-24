jQuery(document).ready(function($) {
    let selections = {}; // tab_id -> { pkg: null, services: {} }
    let total = 0;

    $('.asb-tab-trigger').on('click', function() {
        let tabId = $(this).data('id');
        $('.asb-tab-trigger').removeClass('active');
        $(this).addClass('active');

        $.post(asb_vars.ajax_url, {
            action: 'asb_get_services',
            nonce: asb_vars.nonce,
            tab_id: tabId
        }, function(res) {
            if (res.success) {
                $('#asb-services-load').html(res.data.html);
                restoreSelections(tabId);
            }
        });
    });

    $(document).on('click', '.asb-package-item', function() {
        let tabId = $('.asb-tab-trigger.active').data('id');
        let pkgId = $(this).data('id');
        let price = parseFloat($(this).data('price'));
        let title = $(this).find('h4').text();

        if (!selections[tabId]) selections[tabId] = { pkg: null, services: {} };

        $('.asb-package-item').removeClass('selected');
        $(this).addClass('selected');

        selections[tabId].pkg = { id: pkgId, title: title, price: price };
        updateSummary();
    });

    $(document).on('change', '.asb-service-check', function() {
        let tabId = $('.asb-tab-trigger.active').data('id');
        let item = $(this).closest('.asb-sub-item');
        let id = item.data('id');
        let price = parseFloat(item.data('price'));
        let title = item.data('title');

        if (!selections[tabId]) selections[tabId] = { pkg: null, services: {} };

        if ($(this).is(':checked')) {
            selections[tabId].services[id] = { title: title, price: price, qty: 1 };
        } else {
            delete selections[tabId].services[id];
        }
        updateSummary();
    });

    $(document).on('input', '.asb-service-qty', function() {
        let tabId = $('.asb-tab-trigger.active').data('id');
        let item = $(this).closest('.asb-sub-item');
        let id = item.data('id');
        let price = parseFloat(item.data('price'));
        let title = item.data('title');
        let qty = parseInt($(this).val());

        if (!selections[tabId]) selections[tabId] = { pkg: null, services: {} };

        if (qty > 0) {
            selections[tabId].services[id] = { title: title, price: price, qty: qty };
        } else {
            delete selections[tabId].services[id];
        }
        updateSummary();
    });

    function restoreSelections(tabId) {
        if (!selections[tabId]) return;

        if (selections[tabId].pkg) {
            $('.asb-package-item[data-id="' + selections[tabId].pkg.id + '"]').addClass('selected');
        }

        for (let id in selections[tabId].services) {
            let s = selections[tabId].services[id];
            let item = $('.asb-sub-item[data-id="' + id + '"]');
            item.find('.asb-service-check').prop('checked', true);
            item.find('.asb-service-qty').val(s.qty);
        }
    }

    function updateSummary() {
        let summaryHtml = '';
        total = 0;
        for (let tid in selections) {
            let s = selections[tid];
            if (s.pkg) {
                summaryHtml += '<div class="summary-item"><strong>' + s.pkg.title + '</strong>: $' + s.pkg.price.toFixed(2) + '</div>';
                total += s.pkg.price;
            }
            for (let id in s.services) {
                let serv = s.services[id];
                let itemTotal = serv.price * serv.qty;
                summaryHtml += '<div class="summary-item">' + serv.title + ' (x' + serv.qty + '): $' + itemTotal.toFixed(2) + '</div>';
                total += itemTotal;
            }
        }
        $('#asb-summary').html(summaryHtml + '<hr><strong>Total: $' + total.toFixed(2) + '</strong>');
    }

    $('#asb-main-form').on('submit', function(e) {
        e.preventDefault();
        let items = [];
        for (let tid in selections) {
            let s = selections[tid];
            if (s.pkg) items.push({ title: s.pkg.title, price: s.pkg.price, qty: 1 });
            for (let id in s.services) {
                items.push({ title: s.services[id].title, price: s.services[id].price, qty: s.services[id].qty });
            }
        }

        let formData = {
            action: 'asb_submit_request',
            nonce: asb_vars.nonce,
            full_name: $('input[name="full_name"]').val(),
            email: $('input[name="email"]').val(),
            notes: '',
            total_price: total,
            button_type: 'quote',
            items: items
        };

        $.post(asb_vars.ajax_url, formData, function(res) {
            if (res.success) {
                alert(res.data.message);
                location.reload();
            } else {
                alert('Error: ' + res.data.message);
            }
        });
    });
});
