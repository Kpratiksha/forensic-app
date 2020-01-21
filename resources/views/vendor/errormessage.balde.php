      @if ( $errors->any() )
       <ul class="alert alert-danger">
          @foreach( $errors->all() as $message )
            <li>{{ $message }}</li>
          @endforeach
        </ul>
      @endif

      @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
      @endif