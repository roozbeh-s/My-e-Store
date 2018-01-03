    <!-- Update Modal -->

    <div class="modal fade" id="editcartmodal{{$cartItem->rowId}}" role="dialog">
    <div class="modal-dialog" id="{{$cartItem->rowId}}">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add/Edit Options</h4>
          
        </div>
        <div class="modal-body">
          <p>You are able to add/edit items by selecting options from below.</p>


          @if (!empty ($cartItem))



              {!! Form::open(['method' => 'POST', 'route' => ['updateoption',$cartItem->rowId]]) !!}
              
              <div class="sizefield{{$cartItem->rowId}}">
              {{ Form::label('size', "Size") }}
              {{ Form::select('size', [], null, ['class' => 'size']) }}
              </div>
        
              <div class="colorfield{{$cartItem->rowId}}">
              {{ Form::label('color', "Color") }}
              {{ Form::select('color', [], null, ['class' => 'color']) }}
              </div>


              {{ Form::submit('Edit', ['class' => 'button-save get']) }}
              {!! Form::close() !!}


          @endif

 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <!-- End of update Modal-->