if (window.location.href.includes('/vote')) {

    $('.doing .option').on('click', function () {
        $(this).transition('pulse');

        var id = $(this).data('id');
        var show = $(this).hasClass('selected');
        var groupId = $(this).data('group');
        var allow = $(this).data('allow');
        var selected = $('.group[data-id=' + groupId + '] .option.selected');
        var len = selected.length || 0;

        if (!show && len >= allow) {
            $('.voting .submit').transition('shake');
            return false;
        }

        $(this).toggleClass('selected');
        show = $(this).hasClass('selected');
        $('.voting .item[data-id="' + id + '"]').toggleClass('hidden', !show);
        $('.group[data-id=' + groupId + '] .sub.header').text((len + 1) + ' / ' + allow);
    });

}