$(function() {
    $(".register_activity").on("click", function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();

        var $this = $(this);
        
        //Si está chequeado el botón que se ve es el de deschequear, entonces se tiene que usar el check al revés
        var activityId = $this.data("id"),
            checked = $this.data("checked"),
            params = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: checked? "PUT":"DELETE",
                url: "/activities/" + (checked?'register':'unregister') +  "/" + activityId
            };

        

        $.ajax(params)
        .done(function( msg ) {
            $this.parent().find("button").toggleClass("d-none");
        });
            

        
    });
});