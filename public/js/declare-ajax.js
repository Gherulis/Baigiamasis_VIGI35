$(document).ready(function() {
    $('input[name="new_kitchen_cold"]').on('input', function() {
        var new_kitchen_cold = $(this).val();
        var flat_id = $('input[name="flat_id"]').val();
        var declaredBy = $('input[name="declaredBy"]').val();
        var old_value = $('td[name="old_value"]').text();
        $.ajax({
            url: '/declare/create',
            type: 'POST',
            data: {
                new_kitchen_cold: new_kitchen_cold,
                flat_id: flat_id,
                declaredBy: declaredBy,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                $('td[name="result"]').text(result);
            }
        });
    });
});
