ICON_WORKING = $('<i></i>').addClass('fa fa-fw fa-spinner fa-spin');
ICON_DONE = $('<i></i>').addClass('fa fa-fw fa-undo');

$(function () {

    $('div[data-action="modal-include-components"]').on('shown.bs.modal', function (e) {
        $($(this).data('content-container')).html(ICON_WORKING.clone());

        $.pjax({
            url: $(this).data('content-url'),
            container: $(this).data('content-container'),
            push: false,
        });
    });

    $('div[data-action="modal-include-components"]').on('hide.bs.modal', function (e) {

        $($(this).data('refresh-container')).html(ICON_WORKING.clone());

        $.pjax({
            url: $(this).data('refresh-url'),
            container: $(this).data('refresh-container'),
            push: false,
        });

        $(this).find('.modal-body > [data-pjax-container]').html('');

        updateProjectBadges();

    });

    $(document).on('change', 'input[name="component-quantity"]', function () {
        let url = $(this).data('url').replace('dQuantity', $(this).val());
        $.post(url, null, function (response) {
            console.log(response);
        });
    });

    $(document).on('click', 'button[data-action="component-include"]', function (e) {
        e.preventDefault();
        handleClick($(this));

    });

    $(document).on('click', 'button[data-action="component-remove"]', function (e) {
        e.preventDefault();
        handleClick($(this));
    });

    $(document).on('click', 'i[data-action="favorite"]', function (e) {
        e.preventDefault();
        handelFavoriteClick($(this));
    });

    $(document).on('change', 'input[type=file]', function () {
        let $img = $(this).parents('form').find('img[data-role="img-preview"]');

        if (this.files[0] && isImage(this.files[0])){
            let reader = new FileReader();
            reader.onload = function(){
                $img.attr('src', reader.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });





});

// Include placeholders in grid filters (G: this is for you!!)
$(function () {
    addPlaceholders();
    $(document).on('pjax:success', function () {
        addPlaceholders();
    })
});

function addPlaceholders(){
    $('table > thead > tr.filters > td > input[type=text]').attr('placeholder', i18n['Search']);
    $('table > thead > tr.filters > td > select > option:first-child    ').html('-- '+i18n['Choose'] + ' --');
}

function handelFavoriteClick($btn){
    let url = $btn.attr('formaction');

    $btn.prop('disabled', true);

    let actualClass = $btn.attr('class');
    let undoClass = $btn.data('undo-class');

    $btn.removeClass();
    $btn.addClass('fas fa-spinner fa-pulse');
    $.post(url, null, function (response){{
        if (response.success){
            $btn.removeClass();
            $btn.addClass(undoClass);
            $btn.data('undo-class', actualClass);

            let formaction = $btn.attr('formaction');
            let formActionInverse = $btn.data('undo');
            $btn.data('undo', formaction);
            $btn.attr('formaction', formActionInverse);
        }
        else {
            alert(response.error);
        }
        $btn.prop('disabled', false);
    }});
}

function handleClick($btn){
    let url = $btn.attr('formaction');

    if(!confirm('Are you sure?')){
        return;
    }

    let quantityQuery = '';
    if ($btn.parent().prev().find('input')[0]) {
        let quantity = $btn.parent().prev().find('input')[0].value;
        quantityQuery = '&quantity=' + quantity;
    }

    $btn.html(ICON_WORKING.clone());
    $.post(url+quantityQuery, null, function (response) {
        if (response.success) {
            $btn.parents('tr').hide('slow', function () {
                updateProjectBadges();
                $(this).remove();
            });
        } else {
            alert(response.error);
        }
        $btn.removeAttr('disabled');
    });
    $btn.prop('disabled', true);
}

function isImage(file){
    let fileType = file["type"];
    let ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
    return $.inArray(fileType, ValidImageTypes) >= 0;
}

function updateProjectBadges() {
    $('span.badge.project-types').each(function (index) {
        let badge = $(this);
        let url = badge.data('update-url');
        $.getJSON(url)
            .done(function (data) {
                badge.html(data.count);
            });
    })
}
