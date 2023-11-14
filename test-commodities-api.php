<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to testing Commodities-API.com</title>

    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* Add styling to the submit button */
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px; /* Adjust margin as needed */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
        }

        /* Cambia el cursor al pasar sobre el botón */
        input[type="submit"]:hover {
            cursor: pointer;
        }

        /* Container to display API response */
        #response-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #333; /* Black background */
            color: #ffffff; /* White text */
            display: none; /* Initially hidden */
            text-align: left;
            border-radius: 5px;
        }

        /* Style for code-like text */
        #response-container pre {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <img src="https://www.commodities-api.com/home_assets/com-logo.png" alt="Commodities-API Logo" width="200">

    <!-- Welcome message -->
    <h1>Welcome to Test Form for Commodities-API.com</h1>

    <!-- Form to enter the access_key -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="access_key">Access Key:</label>
        <input type="text" id="access_key" name="access_key" required>
        <br>
        <input type="submit" value="Submit">
    </form>

    <!-- Container to display API response -->
    <div id="response-container"></div>

    <?php
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
        echo '<script>';
        echo 'var jsonResponse = ' . $response . ';';
        echo 'var responseContainer = document.getElementById("response-container");';
        echo 'responseContainer.innerHTML = "<pre>" + JSON.stringify(jsonResponse, null, 2) + "</pre>";';
        echo 'responseContainer.style.display = "block";';
        echo '</script>';
    }
    ?>
</body>
</html>
