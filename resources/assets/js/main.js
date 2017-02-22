swal.setDefaults({ confirmButtonColor: '#e03997' });

$('.ui.checkbox').checkbox();

$('.date').each(function (i, e) {
    var date = $(e).data('data');
    if (date) {
        $(e).text(moment(date).fromNow());
    }
});

$('.dates').each(function (i, e) {
    var date = $(e).text();
    if (date) {
        $(e).text(moment(date).calendar());
    }
});
