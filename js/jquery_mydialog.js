$(function(){

  $('#dialog').dialog({
    autoOpen: false,
    width: 320,
    height: 480,
    title: '',
    modal:true,
    resizable:false,

    open:function(event, ui){ 
      $(".ui-dialog-titlebar-close").hide();
      $(".ui-dialog-buttonpane").hide();
      $(".ui-dialog-titlebar").hide();
    },

    buttons: {
      "O": function() {
        $(this).dialog("close");
      }
    }

  });

  $('.dialog_link').click(function(){
    $('#dialog').load("php/jquery_load.php?replyid="+$(this).attr("replyid")+"&orgid="+$(this).attr("orgid"));
    $('#dialog').dialog('open');
    return false;
  });

  $('.ui-widget-overlay').live('click', function() {
    $('#dialog').dialog( "close" );
  });
});

