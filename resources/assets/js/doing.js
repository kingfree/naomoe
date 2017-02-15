if (window.location.href.includes('/voting')) {

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
        $('.voting .item[data-id="' + id + '"]').toggleClass('hidden', show);
        $('.group[data-id=' + groupId + '] .sub.header').text((len + (show ? -1 : +1)) + ' / ' + allow);

        $('.footer').height($('.voting').height());
    });

    $('.voting .submit').on('click', function (event) {
        event.preventDefault();
        var compId = $('.competition').data('id');
        var votes = [];
        $('.option.selected').each(function (i, e) {
            votes.push($(e).data('id'));
        });
        axios.post('/vote', {
            competition_id: compId,
            votes: votes
        }).then(function (response) {
            console.log(response);
        }).catch(function (error) {
            console.log(error);
        });
    });

}