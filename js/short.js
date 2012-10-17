function getShortUrl() 
{   
    var url = $("#url").val();

    if (url.length < 1) {
        $("#result").html('You must provide a Url to shorten!');
    } else {
        $.ajax({
            url:'../shorten.php',
            type: 'POST',
            data: {'url' : url},
            success: function(data) {
                $("#result").html(data);
            }
        });
    }
}
