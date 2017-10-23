    function ajaxEdit($idNews){
        var url = "testJson?id=" + $idNews ;
        var news = getJson(url);
        completeModal(news);

    }



    function completeModal($news){
        $('#autorNews').val($news.Autor);
        $('#titleNews').val($news.Title);
        $('#contentNews').val($news.Content);
        $('#myModal').modal('show');
      
    }



    function getJson(url){
      $.get({
        url:url,
        async: false
        })
        .done(function(retourData, status)
            {
            resultat = retourData;
            })
        .fail(function(err)
            {
            resultat = err.status;
            });
      return JSON.parse(resultat);
}