$(document).ready(function(){
  //SEEN MOVIE
  $(document).on('click', '#seenCheckBox', function(){

    console.log($(this).attr("name"));
    var id = ($(this).attr("name"));
    var status;
    if($(this). prop("checked") == true){
      status = true;
    }
    else if($(this). prop("checked") == false){
      status = false;
      ($(".sad").attr("checked" , false));
      ($(".neutral").attr("checked" , false));
      ($(".happy").attr("checked" , false));
    }
    $.ajax({
      url: '/ajax/toggleSeen',
      type: 'POST', 
      data: {
        'id': id,
        'status': status,
      },
      success: function(response){
      }
    });
  });

  //RATEMOVIE
  $(document).on('click', '#radioSmileys', function(){

    var id = ($(this).attr("name"));
    var rating = $(this).attr("value");
    var seen = ($("#seenCheckBox"). prop("checked") == true);
    ($("#seenCheckBox")).attr("checked", true);
  
    $.ajax({
      url: '/ajax/giveRating',
      type: 'POST', 
      data: {
        'id': id,
        'rating': rating,
      },
      success: function(response){
        console.log(id + "er gitt rating" + rating);

      }
    });
  });

  //DELETE COMMENT
  $(document).on('click', '.deleteButton', function(){

    var id = ($(this).attr("name"));
  
    $.ajax({
      url: '/ajax/deleteComment',
      type: 'POST', 
      data: {
        'id': id,
      },
      success: function(response){
        console.log(id + "er fjernet");
        $("#post-"+id).remove();

      }
    });
  });

  //SUBMIT COMMENT
  $("#submitButton").click(function(){
    var content = $.trim($("#comment").val());
    var movieId = $("#comment").attr("name");
    $("#comment").val('');
  
    $.ajax({
      url: '/ajax/submitComment',
      type: 'POST', 
      data: {
        'id': movieId,
        'content': content,
      },
      success: function(response){
        $("#posts").append(response);

      }
    });
  });

  //FILTER!!
  $('#filterDiv').on("change keyup", function() {
    chkBox2 = { datatest: null };
    chkBox3 = { datatest: null };
    chkBox4 = { datatest: null };
    chkBox5 = { datatest: null };
    chkBox6 = { datatest: null };
    chkBox7 = { datatest: null };
    chkBox8 = { datatest: null };
    chkBox9 = { datatest: null };
    chkBox10 = { datatest: null };
    chkBox11 = { datatest: null };
    var count = 0;
    if ($('#year2').is(':checked')) { chkBox2.datatest = "1"; count++; } else { chkBox2.datatest = "0"; }
    if ($('#year3').is(':checked')) { chkBox3.datatest = "1"; count++;} else { chkBox3.datatest = "0"; }
    if ($('#year4').is(':checked')) { chkBox4.datatest = "1"; count++;} else { chkBox4.datatest = "0"; }
    if ($('#year5').is(':checked')) { chkBox5.datatest = "1"; count++;} else { chkBox5.datatest = "0"; }
    if ($('#year6').is(':checked')) { chkBox6.datatest = "1"; count++;} else { chkBox6.datatest = "0"; }
    if ($('#year7').is(':checked')) { chkBox7.datatest = "1"; count++;} else { chkBox7.datatest = "0"; }
    if ($('#year8').is(':checked')) { chkBox8.datatest = "1"; count++;} else { chkBox8.datatest = "0"; }
    if ($('#year9').is(':checked')) { chkBox9.datatest = "1"; count++;} else { chkBox9.datatest = "0"; }
    if ($('#year10').is(':checked')) { chkBox10.datatest = "1"; count++;} else { chkBox10.datatest = "0"; }
    if ($('#year11').is(':checked')) { chkBox11.datatest = "1"; count++;} else { chkBox11.datatest = "0"; }

    $(".movieCard").hide().filter(function() {
      var rtnData = "";

      regExName   = new RegExp($('#0').val().trim(), "ig");
      regExA      = new RegExp($('#1').val().trim(), "ig");
      regExTest2   = new RegExp(chkBox2.datatest, "ig");
      regExTest3   = new RegExp(chkBox3.datatest, "ig");
      regExTest4   = new RegExp(chkBox4.datatest, "ig");
      regExTest5   = new RegExp(chkBox5.datatest, "ig");
      regExTest6   = new RegExp(chkBox6.datatest, "ig");
      regExTest7   = new RegExp(chkBox7.datatest, "ig");
      regExTest8   = new RegExp(chkBox8.datatest, "ig");
      regExTest9   = new RegExp(chkBox9.datatest, "ig");
      regExTest10   = new RegExp(chkBox10.datatest, "ig");
      regExTest11   = new RegExp(chkBox11.datatest, "ig");
      
      rtnData = (
        $(this).attr("data-name").match(regExName) && 
        $(this).attr("data-seen").match(regExA)
        //$(this).attr("data-b").match(regExB) &&
      );

        boxData = "";

          boxData = boxData | ($(this).attr("data-year2").match(regExTest2));
          boxData = boxData | ($(this).attr("data-year3").match(regExTest3));
          boxData = boxData | ($(this).attr("data-year4").match(regExTest4));
          boxData = boxData | $(this).attr("data-year5").match(regExTest5);
          boxData = boxData | $(this).attr("data-year6").match(regExTest6);
          boxData = boxData | $(this).attr("data-year7").match(regExTest7);
          boxData = boxData | $(this).attr("data-year8").match(regExTest8);
          boxData = boxData | $(this).attr("data-year9").match(regExTest9);
          boxData = boxData | $(this).attr("data-year10").match(regExTest10);
          boxData = boxData | $(this).attr("data-year11").match(regExTest11);
        
        if(count != 0)
        {
          rtnData = rtnData && boxData;
        }
      return rtnData;
    }).show();
  });
});



