setInterval(function(){ getMessages(); }, 3000);

$(document).ready(function() {
    getMessages();
    $('#tab_rapid_orders').DataTable({
        ajax: "encodeGridLastOrders.html",
        order: [[ 0, "asc" ]],
        "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: null},
        {"targets": 1, data: null},
        {"targets": 2, data: 1}
        ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[
    {"targets": 0,render: function(data,full) {return  "Commande n°" + " " + data[0]}},
    {"targets": 1,render: function(data,full) {return  data[3] + " " + data[2]}},
    ]

});


    $("#form_add_messages").submit(function() {
        id_member = $(this).find("input[name=id_member]").val();
        text_message = $(this).find("input[name=text_message]").val();
        url = "sendMessages.html"
        $.post(url, {
            id_member:id_member,
            text_message:text_message,

        }, function(data) {
            if (data.confirm == "success") {
                $("#text_message").val('');
                $("#text_message").focus();
                getMessages();


            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

            }
        }, "json");
        return false;
    });


    url = "getEarnings.html";
    var form = {};
    var earningsReturned = send_post(form, url); 

    url = "getStatusOrders.html";
    var form = {};
    var statsReturned = send_post(form, url);



    /**************************STATUS ORDERS********************************/
    new Chart(document.getElementById("pie-chart"), {
        type: 'doughnut',
        data: {
            labels: [statsReturned[0]["name_state"], statsReturned[1]["name_state"], statsReturned[2]["name_state"], statsReturned[3]["name_state"], statsReturned[4]["name_state"], statsReturned[5]["name_state"], statsReturned[6]["name_state"], statsReturned[7]["name_state"]],
            datasets: [{

                backgroundColor: ["#64cdff", "#14b694", "#337ab7", "#3E6977", "#FF4A55", "#EEA852", '#7C71C5'],
                data: [statsReturned[0]["how_much"],statsReturned[1]["how_much"],statsReturned[2]["how_much"],statsReturned[3]["how_much"],statsReturned[4]["how_much"],statsReturned[5]["how_much"],statsReturned[6]["how_much"],statsReturned[7]["how_much"]]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Statitiques des statuts des commandes'
            }
        }
    });


    new Chart(document.getElementById("pie-chart2"), {
        type: 'line',
        data: {
            labels: ["janvier", "Février" , "Mars" , "Avril" , "Mai" , "Juin" , "Juillet" ,"Août" , "Septembre" , "Octobre" , "Novembre" , "Décembre"],
            datasets: [{
                label: "2018",
                backgroundColor: ["#00000000"],
                borderColor: ["#FF4A55"],
                data:[earningsReturned[2018][0]["total_order"], earningsReturned[2018][1]["total_order"],earningsReturned[2018][2]["total_order"],earningsReturned[2018][3]["total_order"],
                earningsReturned[2018][4]["total_order"],earningsReturned[2018][5]["total_order"],earningsReturned[2018][6]["total_order"],earningsReturned[2018][7]["total_order"],earningsReturned[2018][8]["total_order"],
                earningsReturned[2018][9]["total_order"],earningsReturned[2018][10]["total_order"],earningsReturned[2018][11]["total_order"]]
            },

            ]
        },
        options: {
            title: {
                display: true,
                text: 'Chiffre mensuel HT'
            }
        }
    });


});


function getMessages(){
    const requestAjax = new XMLHttpRequest();
    requestAjax.open("GET" , "getMessages.html");

    requestAjax.onload = function(){
        const result = JSON.parse(requestAjax.responseText);
        const html = result.reverse().map(function(message){
            return `<div class="message">
            <span class="date">${message.date_message}</span> 
            <span class="author">${message.member}</span> :
            <span class="content-message">${message.text_message}</span>
            </div>
            `
        }).join('');

        const messages = document.querySelector('.messages');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    requestAjax.send();
}









