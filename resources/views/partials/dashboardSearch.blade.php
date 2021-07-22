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
                        data: {query: query, _token: _token},
                        success: function (data) {
                            data = JSON.parse(data);
                            var element = '';
                            $.each(data, function (index, value) {
                            if (value.wallet_activated==true){
                                value.walletActivated = "Activated";
                                value.url = '<a href="customers/'+value.id+'/\" class="btn btn-primary">Wallet</a>';
                            }else if(value.wallet_activated==false) {
                                value.walletActivated = "Not Initiated";
                                value.url = '<a href="customers/'+value.id+'/wallet_activation/\" class="btn btn-primary">Activate</a>';
                            }
                                element += '<tr><td>' + value.name + '</td>' +
                                    '<td>' + value.phone + '</td>' +
                                '<td>' + value.walletActivated + '</td>' +
                                '<td>'+value.url+'</td></tr>';
                            });
                            $('#dynamic_content').html(element);
                        }
                });
            }
        });
    });
</script>
