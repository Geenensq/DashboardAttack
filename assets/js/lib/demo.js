/*CALL AJAX EACH 5 MINUTES*/
const status_number = 7;
/********************************************************************/


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
        var EarningsReturned = send_post(form, url);

        var EarningsThisYear = [];
        var EarningsLastYear = [];


        for (var i = 0; i < 24; i++) {
            
            if(typeof EarningsReturned[i]  === 'undefined' ){
              console.log("alert");
            } else if (EarningsReturned[i]["years"] == 2018){
              alert("2018");
            }

          
        }

        var data = {
          labels: ['Jan', 'Fevr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juill', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
            [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
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
   
    statsStatus = [];

    /************************************************************************************************************/
    /************************************Creation of the object**************************************************/
    /************************************************************************************************************/
    for (var i = 0; i < statsReturned.length; i++) 
    {
         statsStatus[i] = { how_much : statsReturned[i]["how_much"] , name_state : statsReturned[i]["name_state"]}; 
    }



    /******************************************/
    /*filling the object if it is not complete*/
    /******************************************/

    if(statsStatus.length < 7){

      for (var i = 0; i < 7; i++) {

        if(typeof statsStatus[i] === 'undefined') {
          statsStatus[i] = { how_much : 0 , name_state : 0 };

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
          
        labels: [ statsStatus[0]["how_much"],statsStatus[1]["how_much"],statsStatus[2]["how_much"] ,statsStatus[3]["how_much"] ,statsStatus[4]["how_much"] , statsStatus[5]["how_much"] , statsStatus[6]["how_much"]],
        series: [ statsStatus[0]["how_much"],statsStatus[1]["how_much"],statsStatus[2]["how_much"] ,statsStatus[3]["how_much"] ,statsStatus[4]["how_much"] , statsStatus[5]["how_much"] , statsStatus[6]["how_much"]]
        });   

       
/***********************************************************************/
    







    },
  
};

