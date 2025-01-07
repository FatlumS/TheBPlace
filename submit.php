<?php
// Database connection settings
$dsn = 'pgsql:host=dpg-ctuimai3esus739crmv0-a.frankfurt-postgres.render.com;dbname=thebplace_8pv8;port=5432';
$user = 'fatlums';   // Username
$pass = 'RGiTja1ED5rQIrAg9rArqpxoAUqlQdPU';  // Password

// Connect to the database
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data and sanitize
        $full_name = htmlspecialchars(trim($_POST['full_name'])); // Sanitize full_name
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL); // Validate email

        if ($email) { // Proceed only if email is valid
            // Prepare SQL statement
            $stmt = $pdo->prepare("INSERT INTO public.\"Waitlist\" (full_name, email) VALUES (:full_name, :email)");
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email', $email);

            // Execute the query
            $stmt->execute();

            // Success message
            echo "Successfully joined the waitlist!";
        } else {
            echo "Invalid email address.";
        }
    }
} catch (PDOException $e) {
    // Log the error and show a generic error message
    error_log($e->getMessage(), 3, '/path/to/your/logfile.log'); // Make sure this path is correct and writable
    echo "There was an error processing your request. Please try again later.";
}
?>

