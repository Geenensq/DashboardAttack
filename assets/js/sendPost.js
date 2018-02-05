function send_post(v, url) {
        var resultat = null;
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: v,
            dataType: "json",
            cache: false,
            success: function(data) {
                resultat = data;
                return resultat;
            },
            error: function(error) {
                resultat = error;
                return resultat;
            }
        });
        return resultat;
    }