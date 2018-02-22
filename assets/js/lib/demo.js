


stats = {
    initChartist: function(){    
        
        var dataSales = {
          labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
          series: [
             [287, 385, 490, 492, 554, 586, 698, 695, 752, 788, 846, 944],
            [67, 152, 143, 240, 287, 335, 435, 437, 539, 542, 544, 647],
            [23, 113, 67, 108, 190, 239, 307, 308, 439, 410, 410, 509]
          ]
        };
        
        var optionsSales = {
          lineSmooth: false,
          low: 0,
          high: 800,
          showArea: true,
          height: "245px",
          axisX: {
            showGrid: false,
          },
          lineSmooth: Chartist.Interpolation.simple({
            divisor: 3
          }),
          showLine: false,
          showPoint: false,
        };
        
        var responsiveSales = [
          ['screen and (max-width: 640px)', {
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];
    
        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);
        


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

