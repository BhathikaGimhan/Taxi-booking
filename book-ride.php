<?php
// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $fullname = strip_tags(trim($_POST["full-name"]));
    $fullname = str_replace(array("\r","\n"),array(" "," "),$fullname);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $packageType = trim($_POST["package-type"]);
    $passengers = trim($_POST["passengers"]);
    $startDest = trim($_POST["start-dest"]);
    $endDest = trim($_POST["end-dest"]);
    $rideDate = trim($_POST["ride-date"]);
    $rideTime = trim($_POST["ride-time"]);

    // Check that data was sent to the mailer.
    if ( empty($fullname) OR empty( $packageType ) OR empty($passengers) OR empty($startDest) OR empty($endDest) OR empty($rideDate) OR empty($rideTime) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Update this to your desired email address.
    $recipient = "contact@yourdomain.com";
    $subject = "Taxi booking from $fullname";

    // Email content.
    $email_content = "Name: $fullname \n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Package Type: $packageType\n";
    $email_content .= "Passengers: $passengers\n";
    $email_content .= "Start Destination: $startDest\n";
    $email_content .= "End Destination: $endDest\n";
    $email_content .= "Date: $rideDate\n";
    $email_content .= "Time: $rideTime\n";

    // Email headers.
    $email_headers = "From: $fullname <$email>\r\nReply-to: <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your ride has been booked.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't book your ride.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}