<div class='mensajes'>
  @if(Session::has('message_success'))
  <div class='alert alert-dismissable alert-success'><button aria-hidden='true' class='close' data-dismiss='alert' type='button'>×</button>{!! Session::get('message_success') !!}
  </div>
  @endif
  @if(Session::has('message_info'))
  <div class='alert alert-dismissable alert-info'><button aria-hidden='true' class='close' data-dismiss='alert' type='button'>×</button>{!! Session::get('message_info') !!}
  </div>
  @endif
  @if(Session::has('message_warning'))
  <div class='alert alert-dismissable alert-warning'><button aria-hidden='true' class='close' data-dismiss='alert' type='button'>×</button>{!! Session::get('message_warning') !!}
  </div>
  @endif
  @if(Session::has('message_danger'))
  <div class='alert alert-dismissable alert-danger'><button aria-hidden='true' class='close' data-dismiss='alert' type='button'>×</button>{!! Session::get('message_danger') !!}
  </div>
  @endif

  @if($errors->any())
    <div class='alert alert-dismissable alert-danger'>
      <button aria-hidden='true' class='close' data-dismiss='alert' type='button'>×</button>
      <ul>
        @foreach($errors->all() as $error)
          <li>
            {{$error}}
          </li>
        @endforeach
      </ul>
    </div>
  @endif

</div>