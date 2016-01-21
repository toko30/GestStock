/* global $ */
$(function() {
    $('#formComposant_famille').on('change', function() {
        
        var path = $("#pathAjax").attr("data-path") + '-' + $('#formComposant_famille').val();
        $.ajax({
        type: 'GET',
        url: path,
        timeout: 30000,
        success: function(data) 
        {
            $('#formComposant_sousFamille').html();
            $('#formComposant_sousFamille').html(data);
        }
        })
    })
});