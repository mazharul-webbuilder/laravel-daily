<h1>Google v3 reCaptcha Implementation for web and app via API or web request</h1>
<ul>
  <li>Create a google reCaptcha Admin Account. If you already have firebase console account we will automaticaly forced to create your first reCaptcha project</li>
  <li>From reCaptcha Admin Panel Create a project like if you are in local developement you can name it as reCaptcha Local testing</li>
  <li>You will asked to provide your reCaptcha users website, if you are in local development you can add only localhost in the site input box, you can input multiple sites. if you are in production 
  enter with http:example.com</li>
  <li>After that click on save button, google will provide you site key and secret key</li>
  <li>We simply give the site key to the frontend developer like the sites you entered. secret_key will placed in your backend application like laravel .env file</li>
  <li>Your all setup is done</li>
  <li>Sent recaptcha token from web/app an example of web is given below. with your request data. Like if you are submiting registation data, add with request as like hidden input filed.</li>
  <li>From your laravel controller make a guzzleHttp client request to google reCaptcha API server to check the token sent from frontend is valid or not. Example code given below.</li>
</ul>

<h3>Frontend Demo Code</h3>
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Form with reCAPTCHA v3</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=YOUR_SITE_KEY"></script> <!-- Replace with your actual site key -->
</head>
<body>

<div class="container mt-5">
    <h2>Request OTP</h2>
    <form id="otpForm">
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <input type="hidden" name="captcha_token" id="captcha_token">
        <input type="hidden" name="jatri_token" value="YOUR_SITE_KEY">
        <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>

<script>
    document.getElementById('otpForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Execute reCAPTCHA
        grecaptcha.ready(function() {
            grecaptcha.execute('YOUR_SITE_KEY', {action: 'send_otp'}).then(function(token) {
                // Set the captcha token to the hidden field
                document.getElementById('captcha_token').value = token;

                // Create FormData object to send data via AJAX
                const formData = new FormData(event.target);

                // Send the AJAX request
                fetch('http://userapiservice.test/v1/send-otp', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('responseMessage').innerText = data.success ? 'OTP Sent Successfully!' : 'Error: ' + data.error;
                    })
                    .catch(error => {
                        document.getElementById('responseMessage').innerText = 'An error occurred. Please try again later.';
                    });
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
```
<h3>Backend Demo Code</h3>
```
// reCaptcha token validation code must be places in a separate service or utility class
        if ($request->filled(key: 'captcha_token')){
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => 'YOUR_SECRET_KEY',
                    'response' => $request->input('captcha_token'),
                ],
            ]);
            $responseBody = json_decode((string) $response->getBody());
            if (!$responseBody->success){
                return response()->json(['status'=>'error', 'token'=>'', 'message'=>'Malicious activities detected'], 422);
            }
        }else{
            return response()->json(['status'=>'error', 'token'=>'', 'message'=>'Malicious activities detected'], 422);
        }
        //===========================Process with Valid Human Request===================================
```
