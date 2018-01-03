<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.scrollUp.min.js') }}"></script>

<script src="{{ URL::asset('js/jquery.prettyPhoto.js') }}"></script>

<script src="{{ URL::asset('js/parsley.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>

  @if (in_array(\Request::route()->getName(), ['getproductbycategory','getproductbycategoryandPrice']))
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  @endif




