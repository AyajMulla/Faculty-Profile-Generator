<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'faculty');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile based on the ID (using prepared statement to avoid SQL injection)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM profiles WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
    } else {
        die("Profile not found.");
    }
} else {
    die("Invalid ID.");
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM research_publications WHERE faculty_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $research_publications = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $research_publications = [];
    }
} else {
    die("Invalid ID.");
}

// Handle file upload and update profile information (using prepared statement for updating)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $faculty_id = $_POST['faculty_id'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $bio = $_POST['bio'];
    $expertise = $_POST['expertise'];
    $experience = $_POST['experience'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $image = $profile['image'];
    
    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_info = pathinfo($_FILES['image']['name']);
        $file_extension = strtolower($file_info['extension']);
        
        if (in_array($file_extension, $allowed_extensions)) {
            $upload_dir = 'uploads/';
            $file_name = uniqid() . '.' . $file_extension;
            $target_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $image = $target_path; // Update the image path
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }
    
    // Update the profile using prepared statements to avoid SQL injection
    $update_sql = "UPDATE profiles SET 
                    faculty_id = ?, 
                    name = ?, 
                    designation = ?, 
                    department = ?, 
                    bio = ?, 
                    expertise = ?, 
                    experience = ?, 
                    email = ?, 
                    phone = ?, 
                    image = ? 
                    WHERE id = ?";
    
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('ssssssssssi', $faculty_id, $name, $designation, $department, $bio, $expertise, $experience, $email, $phone, $image, $id);
    
    if ($stmt->execute()) {
        // Update research publications
        $delete_sql = "DELETE FROM research_publications WHERE faculty_id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param('i', $faculty_id);
        $stmt->execute();
        
        // Insert new research publications
        if (isset($_POST['publication_name']) && is_array($_POST['publication_name'])) {
            for ($i = 0; $i < count($_POST['publication_name']); $i++) {
                $publication_name = $_POST['publication_name'][$i];
                $project_name = $_POST['project_name'][$i];
                $description = $_POST['description'][$i];
                
                $insert_sql = "INSERT INTO research_publications (faculty_id, publication_name, project_name, description) 
                               VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param('isss', $faculty_id, $publication_name, $project_name, $description);
                $stmt->execute();
            }
        }
        
        // Redirect back to view_profile.php after successful update
        header("Location: view_profiles.php?id=" . $id);
        exit;  // Make sure to call exit after header to stop further execution
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Faculty Profile</title>
    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #495057;
            font-size: 16px;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ced4da;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #adb5bd;
            margin-top: 30px;
            font-style: italic;
        }

        .button-container {
            margin-top: 20px;
        }

        .image-preview {
            margin-top: 10px;
            text-align: center;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ced4da;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Update Faculty Profile</h1>
        
        <form action="update_profile.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="faculty_id">Faculty ID</label>
                <input type="text" name="faculty_id" id="faculty_id" value="<?php echo htmlspecialchars($profile['faculty_id']); ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($profile['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" name="designation" id="designation" value="<?php echo htmlspecialchars($profile['designation']); ?>" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" id="department" value="<?php echo htmlspecialchars($profile['department']); ?>" required>
            </div>

            <div class="form-group">
                <label for="bio">Short Bio</label>
                <textarea name="bio" id="bio" rows="4" required><?php echo htmlspecialchars($profile['bio']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="expertise">Areas of Expertise</label>
                <input type="text" name="expertise" id="expertise" value="<?php echo htmlspecialchars($profile['expertise']); ?>" required>
            </div>

            <div class="form-group">
                <label for="experience">Experience (in years)</label>
                <input type="text" name="experience" id="experience" value="<?php echo htmlspecialchars($profile['experience']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($profile['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($profile['phone']); ?>" required>
            </div>

            <!-- Image upload section -->
            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                <?php if (!empty($profile['image'])): ?>
                    <div class="image-preview">
                        <p>Current image:</p>
                        <img src="<?php echo htmlspecialchars($profile['image']); ?>" alt="Profile Image">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Publications Section -->
            <label for="publications">Research Publications</label>
            <div class="form-group">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="publication-rows">
                        <?php foreach ($research_publications as $publication): ?>
                        <tr>
                            <td><input type="text" name="publication_name[]" value="<?php echo htmlspecialchars($publication['publication_name']); ?>" required></td>
                            <td><input type="text" name="project_name[]" value="<?php echo htmlspecialchars($publication['project_name']); ?>" required></td>
                            <td><input type="text" name="description[]" value="<?php echo htmlspecialchars($publication['description']); ?>" required></td>
                            <td><button type="button" class="remove-row" onclick="removeRow(this)">Remove</button></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><input type="text" name="publication_name[]" placeholder="Publication Name" required></td>
                            <td><input type="text" name="project_name[]" placeholder="Project Name" required></td>
                            <td><input type="text" name="description[]" placeholder="Description" required></td>
                            <td><button type="button" class="remove-row" onclick="removeRow(this)">Remove</button></td>
                            <td><button type="button" onclick="addPublicationRow()">Add Publication</button><td>
                        </tr>
                    </tbody>
                </table>
                
            </div>

            <div class="button-container">
                <button type="submit" name="update">Update Profile</button>
            </div>
        </form>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Faculty Profiles
    </div>

    <script>
        function addPublicationRow() {
            var tableBody = document.getElementById("publication-rows");
            var newRow = tableBody.insertRow(tableBody.rows.length);
            
            newRow.innerHTML = `<td><input type="text" name="publication_name[]" placeholder="Publication Name" required></td>
                                <td><input type="text" name="project_name[]" placeholder="Project Name" required></td>
                                <td><input type="text" name="description[]" placeholder="Description" required></td>
                                <td><button type="button" class="remove-row" onclick="removeRow(this)">Remove</button></td>`;
        }

        function removeRow(button) {
            var row = button.closest("tr");
            row.remove();
        }
    </script>
</body>
</html>
