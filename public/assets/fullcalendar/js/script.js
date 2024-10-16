
// testando o jquery
/*$(function(){
    alert('Ola mundo!');
})*/
function routeEvents(route){
    return document.getElementById('calendar').dataset[route];
}
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sendEvent(route, data_){
        $.ajax({
            url: route,
            data: data_,
            method: 'PUT',
            dataType: 'json',
            success: function(json){
                if(json){
                    location.reload();
                }
            }
        });
    }


})