    setTimeout(function(){
        document.getElementById('bad_message').classList.add('hide');
    }, 5000);
    setTimeout(function(){
        document.getElementById('good_message').classList.add('hide');
    }, 5000);




var id= document.getElementById("house_id").value;
var i = 0;
$('#add').click(function() {

    ++i;
    $('#table').append(`
<tr>
<td colspan="2"><input type="text" name="inputs[` + i + `][flat_nr]" id="" placeholder='Buto numeris'></td>
<td colspan="2"><input type="text" name="inputs[` + i + `][flat_size]" id="" placeholder='Buto kvadratūra'></td>
<td colspan="2"><input type="text" name="inputs[` + i + `][gyv_mok_suma]" id="" placeholder='Gyvatuko mokamas procentas'>
<input type="number" name="inputs[` + i + `][invitation]" value=`+id+` id="" hidden>
<input type="number" name="inputs[` + i + `][house_id]" value=`+id+` id="" hidden></td>
<td colspan="1">
  <div class="flex-container">
    <button class="btn_medium btn_edit remove-table-row" type="button" name="add" id="add">Pašalinti</button>
  </div>
</td>
</tr>
`);
});

$(document).on('click','.remove-table-row',function(){
    $(this).parents('tr').remove();
}
)

