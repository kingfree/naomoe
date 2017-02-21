$('.ui.checkbox').checkbox();

$('.date').each(function (i, e) {
    $(e).text(moment($(e).data('data')).fromNow());
});

function doVote(compId, votes) {
    var vote = function () {
        var comment = $('#comment').text();
        axios.post('/vote', {
            competition_id: compId,
            votes: votes,
            comment: comment
        }).then(function (response) {
            if (response.data.code === 0) {
                swal({
                    title: response.data.info || messages.failed,
                    timer: 1000,
                    type: "success"
                }, function () {
                    window.location.href = '/vote';
                });
            } else {
                swal({
                    title: response.data.info || messages.failed,
                    timer: 1000,
                    type: "error"
                });
            }
        }).catch(function (error) {
            swal({
                title: messages.failed,
                timer: 1000,
                type: "error"
            });
        })
    };
    var showAlert = function (cb) {
        var text = '';
        if (!votes.length) {
            swal({
                title: messages.select_one,
                timer: 1000,
                type: "warning"
            });
            return false;
        }
        $('.voting .item').not('.hidden').each(function (i, e) {
            text += $(e).html();
        });
        swal({
            title: messages.title,
            text: '<div class="ui mini horizontal list">' + text + '</div>',
            html: true,
            type: "input",
            inputPlaceholder: messages.inputPlaceholder,
            inputValue: $('#comment').text(),
            showCancelButton: true,
            confirmButtonColor: "#c71f7e",
            confirmButtonText: messages.confirmButtonText,
            cancelButtonText: messages.cancelButtonText,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function (inputValue) {
            if (inputValue === false) return false;
            $('#comment').text(inputValue);
            cb();
            return true;
        });
    };

    axios.post('/amiok', {}).then(function (response) {
        showAlert(vote);
    }).catch(function (error) {
        axios.post('/create', {}).then(function (response) {
            showAlert(vote);
        }).catch(function (error) {
            swal({
                title: messages.failed,
                timer: 1000,
                type: "error"
            }, function () {
                window.location.href = '/login';
            });
        });
    });
}

var voteSimple = function () {
    var compId = $('.competition').data('id');
    var votes = [];
    $('.checkbox.checked > input').each(function (i, e) {
        votes.push($(e).val());
    });
    doVote(compId, votes);
};

$('#voting').on('submit', function (e) {
    e.preventDefault();
    voteSimple();
    return false;
});

$('.doing .option').on('touch click', function () {
    $(this).html('<iframe frameborder="no" border="0" marginwidth="0"'
        + ' marginheight="0" width=280 height=110 '
        + 'src="//music.163.com/outchain/player?type=2&id='
        + $(this).data('music')
        + '&auto=0&height=90"> </iframe>');
});

if (window.location.href.includes('/voting')) {
    if (!$('.submit').hasClass('disabled')) {

        $('.doing .option').on('touch click', function () {
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

        $('.voting .submit').on('touch click', function (event) {
            event.preventDefault();
            var compId = $('.competition').data('id');
            var votes = [];
            $('.option.selected').each(function (i, e) {
                votes.push($(e).data('id'));
            });
            doVote(compId, votes);
        });
    }
}
