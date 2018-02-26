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

    stats = {
        initChartist: function(){    

            var responsiveSales = [
            ['screen and (max-width: 640px)', {
                axisX: {
                  labelInterpolationFnc: function (value) {
                    return value[0];
                }
            }
        }]
        ];


        /**************************STATS turnover********************************/
        url = "getEarnings.html";
        var form = {};
        var data = send_post(form, url);  
        var aOfDatasOrders= [];
        var iMainIndice= 0;
        var iIndice= 0;

        for(var iYear in data) { 
          iIndice= 0;
          aOfDatasOrders[iMainIndice]= [];
          for(var iRow in data[iYear])    {
            aOfDatasOrders[iMainIndice][iIndice]= data[iYear][iRow]["total_order"];
            iIndice++;
        }
        iMainIndice++;
    }

    if(iMainIndice == 1) {
        aOfDatasOrders[1]= [];
        aOfDatasOrders[1]= [0,0,0,0,0,0,0,0,0,0,0,0];
    } 


    var data = {
      labels: ['Jan', 'Fevr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juill', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
      series: [
      /*THIS YEARS*/  
      [aOfDatasOrders[0][0],aOfDatasOrders[0][1],aOfDatasOrders[0][2],aOfDatasOrders[0][3],aOfDatasOrders[0][4],aOfDatasOrders[0][5],aOfDatasOrders[0][6],aOfDatasOrders[0][7],aOfDatasOrders[0][8],aOfDatasOrders[0][9],aOfDatasOrders[0][10],aOfDatasOrders[0][11]],
      /*NEXTYEARS*/
      [aOfDatasOrders[1][0],aOfDatasOrders[1][1],aOfDatasOrders[1][2],aOfDatasOrders[1][3],aOfDatasOrders[1][4],aOfDatasOrders[1][5],aOfDatasOrders[1][6],aOfDatasOrders[1][7],aOfDatasOrders[1][8],aOfDatasOrders[1][9],aOfDatasOrders[1][10],aOfDatasOrders[1][11]]
      ]
  };

  var options = {
    seriesBarDistance: 10,
    axisX: {
        showGrid: false
    },
    height: "245px"
};

var responsiveOptions = [
['screen and (max-width: 640px)', {
    seriesBarDistance: 5,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value[0];
    }
}
}]
];

Chartist.Bar('#chartActivity', data, options, responsiveOptions);



/**************************STATUS ORDERS********************************/
url = "getStatusOrders.html";
var form = {};
var statsReturned = send_post(form, url);
if(statsReturned.length < 7)
{

  for (var i = 0; i <= 6; i++) 
  {
    if(typeof statsReturned[i] === 'undefined') 
    {
      statsReturned[i] = { how_much : 0 , name_state : 0 };
  }
}
}


var dataPreferences = {series: [[25, 30, 20, 25]]};
var optionsPreferences = {
    donut: true,
    donutWidth: 40,
    startAngle: 0,
    total: 100,
    showLabel: true,
    axisX: {
        showGrid: false
    }
};

Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

Chartist.Pie('#chartPreferences', {

    labels: [ statsReturned[0]["how_much"],statsReturned[1]["how_much"],statsReturned[2]["how_much"] ,statsReturned[3]["how_much"] ,statsReturned[4]["how_much"] , statsReturned[5]["how_much"] , statsReturned[6]["how_much"]],

    series: [ statsReturned[0]["how_much"],statsReturned[1]["how_much"],statsReturned[2]["how_much"] ,statsReturned[3]["how_much"] ,statsReturned[4]["how_much"] , statsReturned[5]["how_much"] , statsReturned[6]["how_much"]]
});   


/***********************************************************************/


},

};

});


function getMessages(){
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET" , "getMessages.html");

    requeteAjax.onload = function(){
        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message){
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
    requeteAjax.send();
}









