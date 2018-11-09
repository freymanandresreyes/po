$('.select_pagos').on('click',function(){
    var select_pagos = $(this).prop('name');
    if (select_pagos == 1) {
        // alert('h');
        $('#pagos_post').css({
            "display" : "block",
        });

        $('#pagos_otros').css({
            "display" : "none",
        });
    }else if (select_pagos == 2) {
        $('#pagos_otros').css({
            "display" : "block",
        });
        $('#pagos_post').css({
            "display" : "none",
        });
        
    } 
});