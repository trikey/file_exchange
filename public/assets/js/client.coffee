$ ->
    $(document).on 'click', '.download_file', ->
        window.location = $(this).attr('data-download-href')
        false

    $("#folders").on 'click', '.folder_link',  ->
        window.location = $(this).attr('data-url')
        false


    $('body').on 'click', '.add-to-file-box, .remove-from-file-box',  ->
        $this = $(this)
        $.ajax
            url: $this.attr('href'),
            type: 'post',
        .done( (data) ->
            $('.menu').replaceWith(data);
            window.location.reload() if $this.hasClass('remove-from-file-box')
        )
        false
