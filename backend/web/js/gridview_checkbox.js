
$("td > input").click(function () {
    let selectAll = false

    if ($(this).is(':checked')) {
        selectAll = true
        $("td > input").each(function() {
            if (! $(this).is(':checked')) {
                selectAll = false
            }
        })
    }

    if (selectAll === true) {
        $('.checked-all-alert').show()
        $('.clear-checkbox-selection-alert').show()
    }
});

$('.checked-all').click(function () {
    console.log('checked-all')
    $("td > input, th > input").each(function() {
        if (! $(this).is(':checked')) {
            $(this).prop("checked", true)
        }
    })
})

$('.clear-checkbox-selection').click(function () {
    console.log('clear-checkbox-selection')
    $("td > input, th > input").each(function() {
        if ($(this).is(':checked')) {
            $(this).prop("checked", false)
        }
    })
})