if (window.location.href.includes('/voting')) {
    var voted = $('.voting .submit').hasClass('disabled');
    if (voted) {

    } else {

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
            var vote = function () {
                var compId = $('.competition').data('id');
                var votes = [];
                $('.option.selected').each(function (i, e) {
                    votes.push($(e).data('id'));
                });
                axios.post('/vote', {
                    competition_id: compId,
                    votes: votes
                }).then(function (response) {
                    if (response.data.code === 0) {
                        swal({
                            title: response.data.info,
                            timer: 1000,
                            type: "success"
                        }, function () {
                            window.location.href = '/vote';
                        });
                    } else {
                        swal({
                            title: response.data.info,
                            timer: 1000,
                            type: "error"
                        });
                    }
                })
            };
            var showAlert = function (cb) {
                var text = '';
                var selected = $('.option.selected');
                if (!selected.length) {
                    swal({
                        title: messages.select_one,
                        timer: 1000,
                        type: "warning"
                    });
                    return false;
                }
                var votes = $('.voting .item').not('.hidden');
                votes.each(function (i, e) {
                    text += $(e).html();
                });
                swal({
                    title: messages.title,
                    text: '<div class="ui mini horizontal list">' + text + '</div>',
                    html: true,
                    type: null,
                    showCancelButton: true,
                    confirmButtonColor: "#c71f7e",
                    confirmButtonText: messages.confirmButtonText,
                    cancelButtonText: messages.cancelButtonText,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function (isConfirm) {
                    if (isConfirm) cb();
                    return true;
                });
            };

            axios.post('/amiok', {}).then(function (response) {
                showAlert(vote);
            }).catch(function (error) {
                axios.post('/create', {}).then(function (response) {
                    showAlert(vote);
                });
            });
            return false;
        });
    }
}