<?php
require 'ai_helper.php'; // Include the AI function
require 'dbcreate.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $qualifications = $_POST['qualifications'];
    $researchInterests = $_POST['research_interests'];
    $publications = $_POST['publications'];

    $inputData = [
        'Name' => $name,
        'Designation' => $designation,
        'Qualifications' => $qualifications,
        'Research Interests' => $researchInterests,
        'Publications' => $publications,
    ];

    $profileSummary = generateProfileSummary($inputData);

    // Save to database
    $stmt = $conn->prepare("INSERT INTO faculty_profiles (name, designation, qualifications, research_interests, publications, profile_summary) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $designation, $qualifications, $researchInterests, $publications, $profileSummary);
    $stmt->execute();

    echo "<h1>Profile Generated Successfully</h1>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Designation:</strong> $designation</p>";
    echo "<p><strong>Qualifications:</strong> $qualifications</p>";
    echo "<p><strong>Research Interests:</strong> $researchInterests</p>";
    echo "<p><strong>Publications:</strong> $publications</p>";
    echo "<p><strong>Profile Summary:</strong> $profileSummary</p>";
}
?>
