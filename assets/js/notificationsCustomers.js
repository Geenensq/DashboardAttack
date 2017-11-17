
        function customersAddSuccess(){

            $.notify({
                icon: 'pe-7s-refresh-2',
                message: "<b>Informations : </b> Votre groupe à été ajouter avec succès !"

            },{
                type: 'info',
                timer: 4000
            });

        };


        function customersAddError(){

            $.notify({
                icon: 'pe-7s-refresh-2',
                message: "<b>Erreur : </b> Le nom du groupe doit contenir au moins 3 caracteres"

            },{
                type: 'danger',
                timer: 4000
            });

        };




