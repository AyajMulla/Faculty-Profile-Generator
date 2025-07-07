<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Database connection
$conn = new mysqli('localhost', 'root', '', 'faculty');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get profile data by ID
$id = $_GET['id'];
$sql = "SELECT id, name, designation, department, bio, expertise, email, phone, faculty_id, experience, image FROM profiles WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Profile not found.");
}

// Get research publications for the profile
$facultyId = $row['faculty_id'];
$publicationsSql = "SELECT publication_name, project_name, description FROM research_publications WHERE faculty_id = $facultyId";
$publicationsResult = $conn->query($publicationsSql);

// Correct image path
$imagePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $row['image'];

// Check if the image file exists and embed as Base64
if (file_exists($imagePath)) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    $imageSrc = ''; // No image available
}

// Create HTML content for the PDF
$html = "
    <h1>{$row['name']}</h1>
    <h2>{$row['designation']}, {$row['department']}</h2>
    <p><strong>Faculty ID:</strong> {$row['faculty_id']}</p>
    <p><strong>Experience:</strong> {$row['experience']} years</p>
    <hr>
    <h3>About:</h3>
    <p>{$row['bio']}</p>
    <h3>Areas of Expertise:</h3>
    <ul>";

$expertise = explode(',', $row['expertise']);
foreach ($expertise as $area) {
    $html .= "<li>" . htmlspecialchars(trim($area)) . "</li>";
}

$html .= "</ul>
    <h3>Research Publications:</h3>";

if ($publicationsResult->num_rows > 0) {
    $html .= "<ul>";
    while ($pub = $publicationsResult->fetch_assoc()) {
        $html .= "
            <li>
                <strong>Publication Name:</strong> {$pub['publication_name']}<br>
                <strong>Project Name:</strong> {$pub['project_name']}<br>
                <strong>Description:</strong> {$pub['description']}
            </li>
            <hr>";
    }
    $html .= "</ul>";
} else {
    $html .= "<p>No research publications found.</p>";
}

// Add image to the PDF (if available)
if ($imageSrc) {
    $html .= "
        <h3>Faculty Image:</h3>
        <img src='{$imageSrc}' alt='Faculty Image' width='300' height='300' />";
} else {
    $html .= "<p>No faculty image available.</p>";
}

// Add Contact Information
$html .= "
    <hr>
    <h3>Contact Information:</h3>
    <p>Email: {$row['email']}</p>
    <p>Phone: {$row['phone']}</p>";

// Configure Dompdf options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the PDF for download
$filename = "{$row['name']}_profile.pdf";
header('Content-Type: application/pdf');
header("Content-Disposition: attachment; filename=\"$filename\"");
echo $dompdf->output();

$conn->close();
?>
