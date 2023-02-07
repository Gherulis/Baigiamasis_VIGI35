var id= document.getElementById("house_id").value;
var i = 0;
var n = 1;
$('#add').click(function() {
    ++i;
    ++n;
    let invitation = Math.floor(Math.random() * (9999 - 1000) + 1000);
    $('#table').append(`
<tr ${(n % 2 == 1) ? 'class="tablerow_bg"' : ''}>
<td colspan="1">`+n+`</td>
<td colspan="2">Nr. <input type="number" name="inputs[` + i + `][flat_nr]" id="" placeholder='Buto numeris' class="textCenter" value=` + n + `></td>
<td colspan="2"><input type="number" name="inputs[` + i + `][flat_size]" id="" placeholder='Buto kvadratūra' class="textCenter"> m<sup>2</sup></td>
<td colspan="2"><input type="number" name="inputs[` + i + `][gyv_mok_suma]" id="" placeholder='Gyvatuko mok %' class="textCenter" value="100"> %
<input type="number" name="inputs[` + i + `][invitation]" value=`+invitation+` id="" hidden>
<input type="number" name="inputs[` + i + `][house_id]" value=`+id+` id="" hidden></td>
<td colspan="1">
  <div class="flex-container">
    <button class="btn_medium btn_delete remove-table-row" type="button" name="add" id="add"><i class="fa-solid fa-minus"></i> Pašalinti</button>
  </div>
</td>
</tr>
`);
});

$(document).on('click','.remove-table-row',function(){
    $(this).parents('tr').remove();
}
)
