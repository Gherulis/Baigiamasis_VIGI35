


  {{-- Pirmas modalinis langas istrinimui  --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-trash-can" style="color: red"></i>Ar tikrai ? </h1>

        </div>
        <div class="modal-body">
          Trinant butą, bus ištrintos visos vandens deklaracijos negrįžtamai !!!<br>
          Visi buto vartotojai atjungti !!!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_edit" data-bs-dismiss="modal">Uždaryti</button>
          <form action="{{route('flat.destroy',$butas)}}" method="POST">
            @csrf
          <button type="submit" class="btn btn_delete">Trinti!!!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- Modalinis Langas buto pakvietimui paziureti --}}
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-envelope-open" style="color: rgb(47, 111, 196)"></i>Pakvietimo kodas: </h1>




        </div>
        <div class="modal-body">
         <h5 id='invitation'></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_edit" data-bs-dismiss="modal">Uždaryti</button>

          </form>
        </div>
      </div>
    </div>
  </div>
