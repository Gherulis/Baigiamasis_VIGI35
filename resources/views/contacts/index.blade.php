
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">
    
        <table >
       
            <thead>
            
                <tr>
                    <th colspan='3'><p class="mssg">{{session('mssg')}}{{session('mssg_edit')}}</p></th>
                    
                    <th><a href="{{route('contacts.create')}}"><button class="btn_new"><i class="fa-regular fa-pen-to-square"></i>Pridėtti</button></a></th>
                
            
            
            </tr>
                <tr>
                <th><i class="fa-solid fa-person"></i>Vardas</th>
                <th><i class="fa-regular fa-envelope"></i>El.Pastas</th>
                <th><i class="fa-solid fa-mobile-screen-button"></i>Telefono Numeris</th>
                <th><i class="fa-solid fa-exclamation"></i>Veiksmai
                
                </th>                      
                </tr>
             
            
                
            </thead>
            <tbody>

            
                    @foreach ( $contacts as $contact )
                       <div>
                        <tr>
                            <td><a href="{{route('contact.edit',$contact)}}">{{$contact->vardas}}</a></td>
                            <td>{{$contact->pastas}}</td>
                            <td>{{$contact->tel}}</td>
                            <td>
                                <a href="{{route('contact.edit',$contact)}}"><button class="btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i>Redaguoti</button></a>
                                
                                <form action="{{route('contact.destroy',$contact)}}" method="POST">
                                @csrf
                                                    
                                <button class="btn_delete" value="submit"><i class="fa-solid fa-trash-can red"></i>Trinti</button></form>
                                
                            </td>
                        </tr>
                      
                       </div>
                    @endforeach
      

          

                
            </tbody>
        </table>
        
    </div>
    <div style="width: 200px; margin: auto; padding-top:16px ;">
    <div >{{$contacts->links()}}</div></div>
@endsection