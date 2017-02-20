@section('duoshuo')
<div class="form-group">
    <label class="col-md-4 control-label">其他登录方式</label>
    <div class="col-md-8">
        @if (session('user_id'))
            绑定已有账号，请登录。或者注册一个新账号与之绑定。
            <input type="hidden" name="user_id" value="{{session('user_id')}}">
            <input type="hidden" name="access_token" value="{{session('access_token')}}">
        @else
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="access_token" value="">
            <a href="http://naomoe.duoshuo.com/login/baidu/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
               class="ui facebook button">
                <i class="paw icon"></i>
                贴吧
            </a>
            <a href="http://naomoe.duoshuo.com/login/weibo/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
               class="ui red button">
                <i class="weibo icon"></i>
                微博
            </a>
            <a href="http://naomoe.duoshuo.com/login/qq/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
               class="ui black button">
                <i class="qq icon"></i>
                QQ
            </a>
            <a href="http://naomoe.duoshuo.com/login/weixin/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
               class="ui green button">
                <i class="weixin icon"></i>
                微信
            </a>
        @endif
    </div>
</div>
@endsection