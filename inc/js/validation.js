/* 
 * Copyright (C) Karsten Kluge 
 * This file is part of {project}  * 
 */
$(function(){
    $("form").validate({
        rules: {
            k_kdnr: {
                required: true,
                number: true
            },
            k_plz_id: {
                required: true,
                number: true,
                minlength: '5',
                maxlength: '5'
                }
        },
            
        messages: {
            k_kdnr:{
                required: 'Bitte Kundennummer eingeben.',
                number: 'Es sind nur Zahlen erlaubt.'
            },
            k_plz_id: {
                required: 'Postleitzahl eingeben',
                number: '</div><br>Nur Zahlen',
                minlength: 'Mindestens 5',
                maxlength: 'Maximal 5'
                }
        }
    });
});

