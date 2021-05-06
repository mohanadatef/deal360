<footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0-rc
    </div>
    <div class="pull-right" style="margin-right: 24px">

        <form method="post" action="{{route('setLang')}}">
            @csrf
            <div class="form-group">
                <select name='lang' onchange="this.form.submit();">
                    @foreach($languageActive as $lang)
                        <option value='{{$lang->code}}'
                                @if( languageLocale() == $lang->code )selected @endif >{{$lang->title}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</footer>
@yield('footer')
