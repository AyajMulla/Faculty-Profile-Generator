<?php
// Database connection
$conn = new mysqli('127.0.0.1:3307', 'root', '', 'faculty');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all profiles
$sql = "SELECT id, name, designation, department FROM profiles";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profiles</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f4f4f4; /* Soft off-white background */
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: #fff; /* White background for content */
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            text-align: center;
            color: #2C3E50; /* Deep charcoal for header */
            font-size: 36px;
            margin-bottom: 40px;
        }
        .profile-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .profile-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0; /* Light grey border */
            transition: background-color 0.3s ease, transform 0.3s ease;
            animation: slideIn 0.5s ease-in-out;
        }
        .profile-item:hover {
            background-color: #f1f1f1; /* Soft grey hover effect */
            transform: translateX(5px); /* Slight movement */
        }
        .profile-item:last-child {
            border-bottom: none;
        }
        .profile-info {
            flex-grow: 1;
        }
        .profile-info h2 {
            font-size: 22px;
            margin: 0 0 5px;
            color: #2C3E50; /* Deep charcoal for name */
        }
        .profile-info p {
            margin: 0;
            font-size: 16px;
            color: #7F8C8D; /* Muted grey text for description */
        }
        .view-btn, .update-btn {
            text-decoration: none;
            background-color: #5D6D7E; /* Muted steel blue for buttons */
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-left: 10px;
        }
        .view-btn:hover, .update-btn:hover {
            background-color: #4A6072; /* Slightly darker shade of blue on hover */
            transform: scale(1.05);
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #7F8C8D;
            margin-top: 50px;
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Color for the header section */
        .header-section {
            background-color: #2C3E50; /* Deep charcoal background */
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header-section h2 {
            font-size: 24px;
            margin: 0;
        }
        .header-section p {
            font-size: 18px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-section">
            <h2>Faculty Directory</h2>
            <p>Browse through the profiles of our esteemed faculty members.</p>
        </div>
        <h1>Faculty Profiles</h1>
        <ul class="profile-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='profile-item'>
                            <div class='profile-info'>
                                <h2>" . htmlspecialchars($row['name']) . "</h2>
                                <p>" . htmlspecialchars($row['designation']) . ", " . htmlspecialchars($row['department']) . "</p>
                            </div>
                            <a class='view-btn' href='profile.php?id=" . $row['id'] . "'>View Profile</a>
                            <a class='update-btn' href='update_profile.php?id=" . $row['id'] . "'>Update Profile</a>
                          </li>";
                }
            } else {
                echo "<p>No profiles found.</p>";
            }
            ?>
        </ul>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Faculty Profiles
    </div>
</body>
</html>
