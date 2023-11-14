<?php
//The following code creates a form that requests the user's Access Key for the Commodities-API.com API, and then makes an API call


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the access_key from the form
    $access_key = $_POST["access_key"];

    // Define parameters for the API call
    $base_currency = 'usd';
    $symbols = 'RMF22';

    // Build the API URL with the access_key and other parameters
    $api_url = "https://commodities-api.com/api/latest?access_key=$access_key&base=$base_currency&symbols=$symbols";

    // Initialize the cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        // Other cURL options as needed
    ));

    // Make the API request
    $response = curl_exec($curl);

    // Close the cURL session
    curl_close($curl);

    // Process and display the API response
    echo "API Response: " . $response;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Access Key Demo</title>
</head>
<body>
    <h1>Enter your access_key</h1>

    <!-- Form to enter the access_key -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="access_key">Access Key:</label>
        <input type="text" id="access_key" name="access_key" required>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
