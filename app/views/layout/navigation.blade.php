<ul>
	<li><a href="{{ URL::route('home')  }}">Home</a></li>
	<li><a href="{{ URL::route('about') }}">About</a></li>
	<li><a href="{{ URL::route('investment') }}">Investment</a></li>
	<li><a href="{{ URL::route('faq') }}">FAQ</a></li>
	<li><a href="{{ URL::route('trading-report') }}">Trading Report</a></li>
	<li><a href="{{ URL::route('contact') }}">Contact</a></li>
	@if(Auth::check())
	{{ Auth::user() }}
		<li><a href=" {{ URL::route('account-sign-out') }} ">Log Out</a></li>
		<li><a href=" {{ URL::route('account-change-password') }} ">Change Password</a></li>
        <li><a href=" {{ URL::route('profile-user', array(Auth::user()->username)) }} ">View Profile</a></li>
	@else
		<li><a href=" {{ URL::route('account-sign-in') }} ">Sign In</a></li>
		<li><a href=" {{ URL::route('account-create') }} ">Create an account</a></li>
		<li><a href=" {{ URL::route('account-forgot-password')}}  ">Forgot Password</a></li>
	@endif
</ul>