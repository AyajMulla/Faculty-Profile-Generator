<?php
// Database connection
$conn = new mysqli('127.0.0.1:3307', 'root', '', 'faculty');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile by ID
$id = $_GET['id'];
$sql = "SELECT * FROM profiles WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Profile not found.");
}

// Fetch research publications by faculty_id
$faculty_id = $row['faculty_id'];
$sql_publications = "SELECT * FROM research_publications WHERE faculty_id = '$faculty_id'";
$publications_result = $conn->query($sql_publications);

$conn->close();

// Get selected template (default is 'default')
$template = isset($_GET['template']) ? $_GET['template'] : 'default';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?> - Faculty Profile</title>

    <!-- Dynamically include CSS based on selected template -->
    <link href="styles/<?php echo $template; ?>.css" rel="stylesheet">
    
    <style>
        /* Fade-in animation
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        } */

        /* Zoom-in animation
        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        } */

        /* Apply animation to the image section
        .profile-image img {
            animation: zoomIn 1s ease-in-out;
        } */

        /* Template-specific styles */
        .profile-container {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            max-width: 900px;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .header .profile-image {
            margin-bottom: 15px;
        }

        .header h1, .header h2 {
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }

        /* Template-specific styles */
        .profile-image img {
            width: 150px;
            height: 150px;
            border-radius: 10%;
        }
    </style>
</head>
<body>
    <!-- Template Selection -->
    <div style="text-align:center; margin: 20px;">
        <label for="template">Choose Template: </label>
        <select id="template" onchange="window.location.href='?id=<?php echo $id; ?>&template=' + this.value">
            <option value="default" <?php echo $template == 'default' ? 'selected' : ''; ?>>Default</option>
            <option value="modern" <?php echo $template == 'modern' ? 'selected' : ''; ?>>Modern</option>
            <option value="minimal" <?php echo $template == 'minimal' ? 'selected' : ''; ?>>Minimal</option>
        </select>
    </div>

    <div class="profile-container">
        <!-- Header Section -->
        <div class="header">
            <!-- Profile Image Section (animated) -->
            <div class="profile-image">
                <?php if (!empty($row['image']) && file_exists($row['image'])): ?>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Faculty Image">
                <?php else: ?>
                    <img src="default-image.jpg" alt="Default Faculty Image">
                <?php endif; ?>
            </div>

            <h1><?php echo $row['name']; ?></h1>
            <h2><?php echo $row['designation']; ?>, <?php echo $row['department']; ?></h2>
        </div>

        <!-- About Section -->
        <div class="section bio">
            <h3>About</h3>
            <p><?php echo nl2br($row['bio']); ?></p>
        </div>

        <!-- Expertise Section -->
        <div class="section expertise">
            <h3>Areas of Expertise</h3>
            <ul>
                <?php
                $expertise = explode(',', $row['expertise']);
                foreach ($expertise as $area) {
                    echo "<li>" . htmlspecialchars(trim($area)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <!-- Faculty ID Section -->
        <div class="section faculty-id">
            <h3>Faculty ID</h3>
            <p><?php echo $row['faculty_id']; ?></p>
        </div>

        <!-- Experience Section -->
        <div class="section experience">
            <h3>Experience</h3>
            <p><?php echo $row['experience']; ?></p>
        </div>

        <!-- Research Publications Section -->
        <div class="section research-publications">
            <h3>Research Publications</h3>
            <?php if ($publications_result->num_rows > 0): ?>
                <ul>
                    <?php while ($pub = $publications_result->fetch_assoc()): ?>
                        <li>
                            <strong>Publication Name:</strong> <?php echo htmlspecialchars($pub['publication_name']); ?><br>
                            <strong>Project Name:</strong> <?php echo htmlspecialchars($pub['project_name']); ?><br>
                            <strong>Description:</strong> <?php echo nl2br(htmlspecialchars($pub['description'])); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No research publications found.</p>
            <?php endif; ?>
        </div>

        <!-- Contact Information -->
        <div class="section contact">
            <h3>Contact Information</h3>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
        </div>

        <!-- Download Button -->
        <div class="section">
            <button onclick="window.location.href='download_profile.php?id=<?php echo $id; ?>&format=doc'" class="download-btn">
                Download as PDF
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; <?php echo date("Y"); ?> Faculty Profile Generator
    </div>
</body>
</html>
