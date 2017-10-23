 $(document).ready(function() {
        $("#add_news").hide();
        $("#event_add_news").click(function() {
            $("#add_news").show("slow", function() {});
            $("#event_add_news").css("background-color" , "#d9534f");
            $('#event_add_news').text('Edition en cours...');
            $('#event_add_news').text('Edition en cours...');
            $("#event_add_news").attr("id", "btn_opened");
        });
    });
