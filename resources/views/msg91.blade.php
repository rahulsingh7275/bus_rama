<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
var configuration = {   
  widgetId: "{{ config('services.msg91.widget_id') }}",
  tokenAuth: "{{ config('services.msg91.token_auth') }}",
  identifier: "91{{ Request()->mobile }}",
  exposeMethods: "<true | false> (optional)",  // When true will expose the methods for OTP verification. Refer 'How it works?' for more details
  success: (data) => {
        console.log('MSG91 success:', data);

        if (data.type !== 'success' || !data.message) {
            alert('OTP verification failed.');
            return;
        }

        // data.message contains JWT access token
        $.ajax({
            url: "{{ route('otp.verify') }}",
            type: "POST",
            data: {
                access_token: data.message
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                if (response.status) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },

            error: function(xhr) {
                console.log(xhr.responseJSON);
                alert(xhr.responseJSON?.message || 'Login failed.');
            }
        });
    },

    failure: (error) => {
        console.log('MSG91 failure:', error);
        alert('OTP verification failed.');
    }
};
</script>
<script type="text/javascript">
(function loadOtpScript(urls) {
    let i = 0;
    function attempt() {
        const s = document.createElement('script');
        s.src = urls[i];
        s.async = true;
        s.onload = () => {
            if (typeof window.initSendOTP === 'function') {
                window.initSendOTP(configuration);
            }
        };
        s.onerror = () => {
            i++;
            if (i < urls.length) {
                attempt();
            }
        };
        document.head.appendChild(s);
    }
    attempt();
})([
    'https://verify.msg91.com/otp-provider.js',
    'https://verify.phone91.com/otp-provider.js'
]);
</script>
