// Database connection settings using Render's connection string
$dsn = 'pgsql:host=dpg-ctuimai3esus739crmv0-a.frankfurt-postgres.render.com;dbname=thebplace_8pv8;port=5432';
$user = 'fatlums';   // Username
$pass = 'RGiTja1ED5rQIrAg9rArqpxoAUqlQdPU';  // Password

// Connect to the database
try {
    $pdo = new PDO($dsn, $user, $pass);
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
