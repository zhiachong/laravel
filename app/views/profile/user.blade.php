@extends('layout.main')

@section('content')
<form action="{{ URL::route('user-change-profile-post') }}" method="POST">
	<i>
		Username:
	</i>
	<p>
		<input type="text" value="{{ $user->username }}" disabled/>
	</p>
	<i>
		Email:
	</i>
	<p>
		<input type="text" value="{{ $user->email }}" disabled/>
	</p>
<i>
    SolidTrustPay :
</i>
<p>
    <input type="text" value="{{ $user->solidtrustpay_acc }}" name="stp"/>
</p>
<i>
    PerfectMoney :
</i>
<p>
    {{ $user->perfectmoney_acc }}
</p>

<i>
    EgoPay :
</i>
<p>
    {{ $user->egopay_acc }}
</p>
<i>
    Payeer :
</i>
<p>
    {{ $user->payeer_acc }}
</p>
<i>
    BitCoin :
</i>
<p>
    {{ $user->bitcoin_acc }}
</p>
<input type="submit" value="Submit"/>
    {{ Form::token() }}
</form>
@stop