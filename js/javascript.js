$(document).ready(function() {
    /* attach a submit handler to the form */
    $('form').submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault(); 
        
        /* get some values from the form */
        var form = $(this),
            term = form.serialize(),
            url  = form.attr('action'),
            id   = form.attr('id');
        
        /* show loading message while processing */
        switch (id) {
            case 'frmQuantidade':
                clearChildren('fdsCreditos', 'legend');
                showLoadingMessage('fdsCreditos');
            case 'frmResultado':
                clearChildren('fdsResultado', 'legend');
                showLoadingMessage('fdsResultado');
                break;
        }
        
        /* Send the data using post and put the results in a fieldset */
        $.post(
            url,
            term,
            function(data) {
                switch (id) {
                    case 'frmQuantidade':
                        showResult('fdsCreditos', data);
                    case 'frmResultado':
                        showResult('fdsResultado', data);
                        break;
                }
            }
        );
    });
    
    function clearChildren(id, except) {
        $('#' + id).children().not(except).remove();
    }
    
    function showLoadingMessage(id) {
        $('#' + id).append('<div>Processando...</div>');
    }
    
    function showResult(id, data) {
        $('#' + id).empty().append($(data).find('#' + id).html());
    }
});