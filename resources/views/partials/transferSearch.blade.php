<script>
    $(document).ready(function () {
        $('#search_recipient').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var _token = $('input[name="_token').val();
                $.ajax({
                    url: "{{route('search_recipient')}}",
                    method: "POST",
                    data: {query: query,_token: _token},
                    success: function (data) {
                        data = JSON.parse(data);
                        var element = '<div class="dropdown">';
                        $.each(data, function (index, value) {
                            element += '<a href="#" class="dropdown-item text-secondary" value="'+value.id+'">' + value.name + "-" + value.phone + '</a>'
                        });
                        element += '</div>';
                        console.log(element);
                        $('#recipientList').fadeIn().html(element);
                        $(document).ready(function () {
                            $(".dropdown-item").click(function () {
                                $("#recipient_details").val($(this).text());
                                $("#recipient_id").val($(this).attr('value'));
                                $(".dropdown").hide();
                            });
                        });
                    }
                });
            }
        });
    });
</script>
