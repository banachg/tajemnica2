$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $( "#qtyPiki" ).focusout(function() {
        if ($.isNumeric($( "#qtyPiki" ).val())  && $( "#qtyPiki" ).val() > 10 && $.isNumeric($( "#opcjaZbieraka" ).val())) {
            calculate($( "#qtyPiki" ).val(), $( "#opcjaZbieraka" ).val());
        }
    });

    $( "#opcjaZbieraka" ).change(function() {
        if ($.isNumeric($( "#qtyPiki" ).val())  && $( "#qtyPiki" ).val() > 10 && $.isNumeric($( "#opcjaZbieraka" ).val())) {
            calculate($( "#qtyPiki" ).val(), $( "#opcjaZbieraka" ).val());
        }
    });




});

function calculate (piki, opcja){
    $.post( "calculate", { piki: piki, opcja: opcja })
        .done(function( data ) {
            console.log(data);
            $( "#zebraneSurowce" ).text(data.lacznie)
            $( "#suraNaGodzine" ).text(data.naGodzine)
            $( "#czasZbierania" ).text(data.czas)
        });
}
