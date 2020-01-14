function saveData1(){
      $.ajax({
        type: "POST",
        url: "updatecoil1.php",
        data: { name: $("select[name='coils']").val()},
        success:function( msg ) {
         //alert( "Data Saved: " + msg );
        }
       });
    }

     function saveData2(){
      $.ajax({
        type: "POST",
        url: "updatecoil2.php",
        data: { name: $("select[name='coils']").val()},
        success:function( msg ) {
         //alert( "Data Saved: " + msg );
        }
       });
    }

       function saveData3(){
      $.ajax({
        type: "POST",
        url: "updatecoil3.php",
        data: { name: $("select[name='coils']").val()},
        success:function( msg ) {
         //alert( "Data Saved: " + msg );
        }
       });
  }

  function saveData4(){
      $.ajax({
        type: "POST",
        url: "updatecoil4.php",
        data: { name: $("select[name='coils']").val()},
        success:function( msg ) {
         //alert( "Data Saved: " + msg );
        }
       });
  }

  function saveData5(){
      $.ajax({
        type: "POST",
        url: "updatecoil5.php",
        data: { name: $("select[name='coils']").val()},
        success:function( msg ) {
         //alert( "Data Saved: " + msg );
        }
       });
  }