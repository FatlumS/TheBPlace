<?php
// Database connection settings
$host = 'localhost';   // Your host (e.g., 'localhost' or the host from Render)
$db = 'waitlist';    // Your database name
$user = 'postgres';     // Your PostgreSQL username
$pass = 'Glowproduction1$$'; // Your PostgreSQL password
$port = '5432';         // Default PostgreSQL port

// Connect to the database
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        
        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO public.\"Waitlist\" (full_name, email) VALUES (:full_name, :email)");
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        
        // Execute the query
        $stmt->execute();
        
        // Success message
        echo "Successfully joined the waitlist!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
