<?php
// Database connection
$conn = new mysqli('127.0.0.1:3307', 'root', '', 'faculty');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data for profiles
$name = isset($_POST['name']) ? $_POST['name'] : '';
$designation = isset($_POST['designation']) ? $_POST['designation'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$bio = isset($_POST['bio']) ? $_POST['bio'] : '';
$expertise = isset($_POST['expertise']) ? $_POST['expertise'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$faculty_id = isset($_POST['faculty_id']) ? $_POST['faculty_id'] : ''; 
$experience = isset($_POST['experience']) ? $_POST['experience'] : ''; 

// Collect form data for research publications
$publication_id = isset($_POST['publication_id']) ? $_POST['publication_id'] : ''; 
$publication_name = isset($_POST['publication_name']) ? (is_array($_POST['publication_name']) ? implode(", ", $_POST['publication_name']) : $_POST['publication_name']) : ''; 
$project_name = isset($_POST['project_name']) ? (is_array($_POST['project_name']) ? implode(", ", $_POST['project_name']) : $_POST['project_name']) : ''; 
$description = isset($_POST['description']) ? (is_array($_POST['description']) ? implode(", ", $_POST['description']) : $_POST['description']) : ''; 

// Handle image upload
$image_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "uploads/";

    // Check if the directory exists, if not create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);  // Create folder with full permissions
    }

    $target_file = $target_dir . basename($_FILES['image']['name']);
    $image_path = $target_file;

    // Check if the file is an actual image
    if (getimagesize($_FILES['image']['tmp_name']) !== false) {
        // Move the uploaded file to the server
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "Sorry, there was an error uploading your image.";
            exit();
        }
    } else {
        echo "File is not an image.";
        exit();
    }
}

// Check if email already exists in the profiles table
$sql_check_email = "SELECT COUNT(*) FROM profiles WHERE email = '$email'";
$result = $conn->query($sql_check_email);
$row = $result->fetch_row();
if ($row[0] > 0) {
    echo "Error: The email address '$email' is already in use. Please use a different email address.";
    exit(); // Stop execution if email exists
}

// Insert data into the profiles table
$sql_profiles = "INSERT INTO profiles (name, designation, department, bio, expertise, email, phone, faculty_id, experience, image) 
        VALUES ('$name', '$designation', '$department', '$bio', '$expertise', '$email', '$phone', '$faculty_id', '$experience', '$image_path')";

// Insert data into the research_publications table
$sql_publications = "INSERT INTO research_publications (publication_id, faculty_id , publication_name, project_name, description) 
        VALUES ('$publication_id', '$faculty_id' ,'$publication_name', '$project_name', '$description')";

// Execute the insertion into both tables
if ($conn->query($sql_profiles) === TRUE && $conn->query($sql_publications) === TRUE) {
    echo "<html><head>
            <style>
                /* Modern AI-Inspired Design */
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #00c6ff, #0072ff);
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    overflow: hidden;
                }
                .container {
                    max-width: 800px;
                    width: 100%;
                    background: #fff;
                    border-radius: 15px;
                    padding: 40px 50px;
                    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
                    animation: slideIn 1s ease-out;
                }
                h1 {
                    text-align: center;
                    color: #0072ff;
                    font-size: 36px;
                    margin-bottom: 30px;
                    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
                    animation: fadeIn 2s ease-in-out;
                }
                .success-message {
                    color: #28a745;
                    text-align: center;
                    font-size: 20px;
                    margin-top: 20px;
                    opacity: 0;
                    animation: fadeInUp 1.5s forwards;
                }
                .success-message a {
                    color: #0072ff;
                    text-decoration: none;
                    font-weight: bold;
                    padding: 10px 20px;
                    background-color: #f0f8ff;
                    border-radius: 5px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease;
                }
                .success-message a:hover {
                    background-color: #0072ff;
                    color: white;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
                }
                
                /* Keyframe Animations */
                @keyframes slideIn {
                    0% { opacity: 0; transform: translateY(30px); }
                    100% { opacity: 1; transform: translateY(0); }
                }
                @keyframes fadeIn {
                    0% { opacity: 0; }
                    100% { opacity: 1; }
                }
                @keyframes fadeInUp {
                    0% { opacity: 0; transform: translateY(20px); }
                    100% { opacity: 1; transform: translateY(0); }
                }

            </style>
          </head>
          <body>
            <div class='container'>
                <h1>Profile Saved Successfully</h1>
                <div class='success-message'>
                    Profile saved successfully! 
                    <a href='view_profiles.php'>View Profiles</a>
                </div>
            </div>
          </body>
          </html>";
} else {
    echo "Error: " . $sql_profiles . "<br>" . $conn->error;
    echo "Error: " . $sql_publications . "<br>" . $conn->error;
}

$conn->close();
?>
