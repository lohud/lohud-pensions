// $(document).foundation();
// alert("This is for TESTING purposes only");
lohudmetrics({
    'pagename': 'The Journal News/lohud.com Pension Database',
    'author': 'Kai Teoh'
});

function TdMouseOver() {
  this.className += ' mouseover';
}
var elements = document.getElementsByTagName('td');
for (var i = 0; i < elements.length; i++) {
  elements[i].onmouseover = TdMouseOver;
}

$(function() {
  $("#id_frm_name").change(function() {
    $("#id_frm_100k").removeAttr('checked');
    $("#id_frm_local").removeAttr('checked');
  })
  $("#id_frmcounty").change(function() {
    $("#id_frm_100k").removeAttr('checked');
    $("#id_frm_local").removeAttr('checked');
    $.getJSON("emp_select_2015.php", {
      id: $(this).val(),
      var_changed: 'county',
      var_target: 'muni'
    }, function(j) {
      var options = '';
      for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].optionValue + '">' + j[
          i].optionDisplay + '</option>';
      }
      $("select#id_frm_muni").html(options);
    })
  })
})
$("#id_frm_name").autocomplete("retire_ac_2015.php", {
  extraParams: {
    fd: "street_name",
    county: function() {
      return $("#id_frmcounty").val();
    },
    muni: function() {
      return $("#id_frm_muni").val();
    }
  }
});
