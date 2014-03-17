/*
when the submit button is clicked we will hide the message div. get the input provided by user and start processing.
*/
$(document).ready(function(){

    $("#submit-button").click(function(){
    
    /*hide the message div box. since we don't have anything to show at this time.*/
     $('#message').hide();
    /*grab the input by user and save in variable userinput*/
      userinput = $("#num").val();
    /*prepare a query string. We need to pass the userinput to the script. we grabbed the input from user, now we need to pass it to the */
      var dataString = "num=" + $("input#num").val();

      /*
         using ajax we will call the server.php script. dataString is the parameter we got from user.datatype is the data type we expect as return. when complete, set the progress bar to 100% and display the message 'complete'.
      */
      $.ajax(
        {

          url : "./server.php",
          type: "GET",
          data: dataString,
          datatype:"json",
          complete:function(){
               $("#progressbar").progressbar({
              value:100});
              $('#message').html('Complete');
              $('#message').show();
              }
        } );

    /*
    call the updateStatus() function every 3 second to update progress bar value.
    */
      t = setTimeout("updateStatus()", 3000);
    });

});


/*
.getJSON will get the json string being updated by the server.php in server. every 3 second, the 'total' and 'current' count will be parsed and updated to the progress bar.
*/
function updateStatus(){

          $.getJSON('serverscript/status.json', function(data){

                               var items = [];

                               pbvalue = 0;

                               if(data){

                                    var total = data['total'];

                                    var current = data['current'];

                                    var pbvalue = Math.floor((current / total) * 100);

                                    if(pbvalue>0){

                                        $("#progressbar").progressbar({

                                            value:pbvalue
                                        });

                                    }

                                }
                                if(pbvalue < 100){

                                   t = setTimeout("updateStatus()", 3000);

                                }
          });


}

