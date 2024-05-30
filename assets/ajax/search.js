document.addEventListener('DOMContentLoaded', function(){
    const form_search = document.getElementById('search-form');
    const search_result = document.getElementById('search-result');

    $(form_search).ready(function(){
        form_search.addEventListener('submit', function(e){
            e.preventDefault();

            const req = $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                encode: true
            });
            req.done(function(data){
                if(data.status == 'success'){
                    search_result.innerHTML = '';
                    $('#search-result').append(data.results);
                }
                if(data.status == 'error') {
                    search_result.innerHTML = data.message;
                }
            });
            req.fail(function(jqXhr, data){
                $('#search-result').html('Error: ' + data.message);
            });
        });
    });
});